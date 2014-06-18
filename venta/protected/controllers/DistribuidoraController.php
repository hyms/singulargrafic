<?php

class DistribuidoraController extends Controller
{
	
	public function filters()
	{
		return array( 'accessControl' ); // perform access control for CRUD operations
	}
	
	public function accessRules() {
		return array(
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						//'actions'=>array('index'),
						'expression'=>'isset($user->role) && ($user->role==="3")',
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'expression'=>'isset($user->role) && ($user->role==="1")',
				),
				array('deny',
						'users'=>array('*'),
				),
		);
	}
	
	public function actionIndex()
	{
		$ventas = new CActiveDataProvider('Venta',
					array('criteria'=>array(
								'group'=>'`t`.idCliente',
								'select'=>'count(*) as cantidad, `t`.`idCliente`',
								'order'=>'cantidad ASC',
								'with'=>array('idCliente0'=>array('select'=>'nitCi, apellido')),
							
								'limit'=>'5',
						),));
		$productos = new CActiveDataProvider('DetalleVenta',
					array('criteria'=>array(
							'with'=>array('idAlmacenProducto0'=>array('select'=>'*'),'idAlmacenProducto0.idProducto0'=>array('select'=>'*')),
							'group'=>'`t`.idAlmacenProducto',
							'select'=>'count(*) as cantidad, `t`.idAlmacenProducto',
							'order'=>'cantidad ASC',
							'limit'=>'5',
					),));
		$this->render('index',array("ventas"=>$ventas,"productos"=>$productos));
	}
	
	public function actionNotas()
	{
		$productos = new AlmacenProducto('searchDistribuidora');
		$cliente = new Cliente;
		$detalle = new DetalleVenta;
		$venta = new Venta;
		$caja = $this->verifyModel(CajaVenta::model()->find(array('condition'=>'idCaja=2 and idUser='.Yii::app()->user->id.' and fechaArqueo is NULL')));
		//Yii::app()->user->id;
		
		//init default values
		$row = Venta::model()->find(array("condition"=>"tipoVenta=1",'order'=>'fechaVenta Desc'));
		if(empty($row))
			$row=new Venta;
		if(empty($row->serie))
			$row->serie = 65;
		$venta->codigo = $row->codigo +1;
		if($row->codigo==1001)
		{
			$row->codigo;
			$row->serie++;
			if($row->serie==91)
				$row->serie = 65;
		}
		$venta->serie = $row->serie;
		$venta->fechaVenta = date("Y-m-d H:i:s");
		$venta->formaPago = 0;
		$venta->tipoVenta = 1;
		$venta->idCaja = $caja->idCajaVenta;
		//end default values
		
		//init filter
		$productos->unsetAttributes();
		if (isset($_GET['AlmacenProducto']))
		{
			$productos->attributes = $_GET['AlmacenProducto'];
			$productos->color = $_GET['AlmacenProducto']['color'];
			$productos->material = $_GET['AlmacenProducto']['material'];
			$productos->marca = $_GET['AlmacenProducto']['marca'];
			$productos->paquete = $_GET['AlmacenProducto']['paquete'];
			$productos->detalle = $_GET['AlmacenProducto']['detalle'];
			$productos->codigo = $_GET['AlmacenProducto']['codigo'];
		}
		//end filter
		
		$swc=0; $swv=0;
		if(isset($_POST['Cliente']))
		{
			$cliente = Cliente::model()->find('nitCi="'.$_POST['Cliente']['nitCi'].'"');
			if($cliente==null)
				$cliente = new Cliente;
		
			$cliente->attributes = $_POST['Cliente'];
			if(empty($cliente->fechaRegistro))
				$cliente->fechaRegistro = date("Y-m-d");
			if($cliente->save())
				$swc=1;
		}
		
		if(isset($_POST['Venta']))
		{
			$venta->attributes = $_POST['Venta'];
			$row = Venta::model()->find(array("condition"=>"tipoVenta=".$venta->tipoVenta,'order'=>'fechaVenta Desc'));
			if(empty($row))
				$row=new Venta;
			if(empty($row->serie) && $venta->tipoVenta==1)
				$row->serie = 65;
			$venta->codigo = $row->codigo +1;
			if($row->codigo==1001 && $venta->tipoVenta==1)
			{
				$row->codigo;
				$row->serie++;
				if($row->serie==91)
					$row->serie = 65;
			}
			$venta->serie = $row->serie;
			$venta->estado = 1;
			if($venta->formaPago==1)
			{
				$venta->estado = 2;
				if(!empty($_POST['Venta']['fechaPlazo']))
					$venta->fechaPlazo = date("Y-m-d",strtotime($_POST['Venta']['fechaPlazo']));
				if(empty($venta->fechaPlazo)||$venta->fechaPlazo=="")
					$venta->addError('fechaPlazo', 'La <b>fechaPlazo</b> no puede estar vacia');
			}
			if($venta->validate())
				$swv=1;
		}
		
		if(isset($_POST['DetalleVenta']))
		{
			$detalle = array();
			$i=0;
			$det=count($_POST['DetalleVenta']);
			foreach ($_POST['DetalleVenta'] as $item)
			{
				array_push($detalle,new DetalleVenta);
				$detalle[$i]->attributes = $item;
				if($detalle[$i]->validate())
				{
					$det--;
				}
				$i++;
			}
		}
		
		if($swc==1 && $swv==1 && $det==0)
		{
			$venta->idCliente = $cliente->idCliente;
				
			if($venta->save())
			{
				$det=count($detalle);
				$almacenes=array();	$i=0;
				foreach($detalle as $item)
				{
					$item->idVenta = $venta->idVenta;
					if($item->validate())
					{
						array_push($almacenes,AlmacenProducto::model()->with('idProducto0')->findByPk($item->idAlmacenProducto));
						$almacenes[$i]->stockU = $almacenes[$i]->stockU - $item->cantidadU;
						if($almacenes[$i]->stockU<0)
						{
							$almacenes[$i]->stockP = $almacenes[$i]->stockP - 1;
							$almacenes[$i]->stockU = $almacenes[$i]->stockU + $almacenes[$i]->idProducto0->cantXPaquete;
						}
						$almacenes[$i]->stockP = $almacenes[$i]->stockP - $item->cantidadP;
						if($almacenes[$i]->stockP<0)
						{
							$venta->addError('obs', 'No existen suficientes Insumos');
							$venta->delete();
							break;
						}
						else
						{
							$det--; $i++;
						}
					}
					else
					{
						$venta->delete();
						break;
					}
				}
		
				if($det==0)
				{
					$i=0;
					foreach ($detalle as $item)
					{
						if($item->save())
						{
							$almacenes[$i]->save();
						}
						$i++;
					}
					if($venta->formaPago==0)
						$caja->saldo = $caja->saldo+($venta->montoPagado-$venta->montoCambio);
						
					if($venta->formaPago==1)
						$caja->saldo = $caja->saldo+$venta->montoPagado;
					if($caja->save())
						$this->redirect(array('preview','id'=>$venta->idVenta));
				}
				else
				{
					$venta->delete();
				}
				//finish section for save datas
			}
		}
		
		
		$this->render('notas',array(
				'productos'=>$productos,
				'cliente'=>$cliente,
				'detalle'=>$detalle,
				'venta'=>$venta,
		));
		
	}
	
	public function actionFactura()
	{
		Yii::app()->user->id;
		
		$productos = new AlmacenProducto('searchDistribuidora');
		$cliente = new Cliente;
		$detalle = array();
		$venta = new Venta;
		
		//init seccion on filter
	
		$productos->unsetAttributes();
		if (isset($_GET['AlmacenProducto']))
		{
			$productos->attributes = $_GET['AlmacenProducto'];
			$productos->color = $_GET['AlmacenProducto']['color'];
			$productos->material = $_GET['AlmacenProducto']['material'];
			$productos->marca = $_GET['AlmacenProducto']['marca'];
			$productos->paquete = $_GET['AlmacenProducto']['paquete'];
			$productos->detalle = $_GET['AlmacenProducto']['detalle'];
			$productos->codigo = $_GET['AlmacenProducto']['codigo'];
		}
		
		if(isset($_POST['Cliente']))
		{
			$cliente->attributes = $_POST['Cliente'];
		}
		if(isset($_POST['Venta']))
		{
			$venta->attributes = $_POST['Venta'];
			if(isset($_POST['Venta']['fechaPlazo']))
				$venta->fechaPlazo = $_POST['Venta']['fechaPlazo'];
			$row = Venta::model()->find(array("condition"=>"tipoVenta=".$venta->tipoVenta,'order'=>'fechaVenta Desc'));
			if(empty($row))
				$row=new Venta;
			if(empty($row->serie) && $venta->tipoVenta==1)
				$row->serie = 65;
			$venta->codigo = $row->codigo +1;
			if($row->codigo==1001 && $venta->tipoVenta==1)
			{
				$row->codigo;
				$row->serie++;
				if($row->serie==91)
					$row->serie = 65;
			}
			$venta->serie = $row->serie;
			$venta->fechaVenta = date("Y-m-d H:i:s");
			$total=0;
			if(isset($_POST['DetalleVenta']))
			{
				$i=0;
					
				foreach ($_POST['DetalleVenta'] as $item)
				{
					array_push($detalle,new DetalleVenta);
					$detalle[$i]->attributes = $item;
					$almacen = AlmacenProducto::model()->with('idProducto0')->findByPk($detalle[$i]->idAlmacenProducto);
					if($venta->tipoVenta==0)
					{
						$detalle[$i]->costoTotal=($almacen->idProducto0->precioCFU*$detalle[$i]->cantidadU)+($almacen->idProducto0->precioCFP*$detalle[$i]->cantidadP)+$detalle[$i]->costoAdicional;
						$detalle[$i]->costoP = $almacen->idProducto0->precioCFP;
						$detalle[$i]->costoU = $almacen->idProducto0->precioCFU;
					}
					else
					{
						$detalle[$i]->costoTotal=($almacen->idProducto0->precioSFU*$detalle[$i]->cantidadU)+($almacen->idProducto0->precioSFP*$detalle[$i]->cantidadP)+$detalle[$i]->costoAdicional;
						$detalle[$i]->costoP = $almacen->idProducto0->precioSFP;
						$detalle[$i]->costoU = $almacen->idProducto0->precioSFU;
					}
					$total=$total+$detalle[$i]->costoTotal;
					$i++;
				}
			}	
			
			$venta->montoVenta=$total;
			if($venta->montoDescuento!=null)
			{
				$venta->montoVenta=$venta->montoVenta-$venta->montoDescuento;
			}
			$venta->montoCambio=$venta->montoPagado - $venta->montoVenta;
		}
		
		$almacen = new Almacen;
		
		$this->render('notas',array(
				'cliente'=>$cliente,
				'venta'=>$venta,
				'productos'=>$productos,
				'detalle'=>$detalle,
		));
	}
	
	public function actionBuscar()
	{
		$ventas = new Venta('searchVenta');
		$ventas->unsetAttributes();
		if (isset($_GET['Venta']))
		{
			$ventas->attributes = $_GET['Venta'];
			$ventas->codigos = $_GET['Venta']['codigos'];
			$ventas->nit = $_GET['Venta']['nit'];
			$ventas->apellido = $_GET['Venta']['apellido'];
		}
		$this->render('buscar',array('ventas'=>$ventas));
	}
	
	public function actionModificar()
	{
		if(isset($_POST['Venta']['idVenta']))
			$_GET['id']=$_POST['Venta']['idVenta'];
		
		if(isset($_GET['id']))
		{
			$venta = $this->verifyModel(Venta::model()->with('idCliente0')->findByPk($_GET['id']));
			$cliente = $venta->idCliente0;
			$detalle = DetalleVenta::model()->findAll('idVenta='.$venta->idVenta);
			//print_r($detalle);
			$productos = new AlmacenProducto('searchDistribuidora');
			$caja = CajaVenta::model()->findByPk($venta->idCaja);
			//init seccion on filter
			
			$productos->unsetAttributes();
			if (isset($_GET['AlmacenProducto']))
			{
				$productos->attributes = $_GET['AlmacenProducto'];
				$productos->color = $_GET['AlmacenProducto']['color'];
				$productos->material = $_GET['AlmacenProducto']['material'];
				$productos->marca = $_GET['AlmacenProducto']['marca'];
				$productos->paquete = $_GET['AlmacenProducto']['paquete'];
				$productos->detalle = $_GET['AlmacenProducto']['detalle'];
				$productos->codigo = $_GET['AlmacenProducto']['codigo'];
			}
			$swc=0;
			if(isset($_POST['Cliente']))
			{
				$cliente->attributes = $_POST['Cliente'];
				if($cliente->save())
					$swc=1;
			}
			$swv=0;
			if(isset($_POST['Venta']))
			{
				$venta->attributes = $_POST['Venta'];
				$venta->estado = 1;
				if($venta->formaPago==1)
				{
					$venta->estado = 2;
					if(!empty($_POST['Venta']['fechaPlazo']))
						$venta->fechaPlazo = date("Y-m-d",strtotime($_POST['Venta']['fechaPlazo']));
					if(empty($venta->fechaPlazo)||$venta->fechaPlazo=="")
						$venta->addError('fechaPlazo', 'La <b>fechaPlazo</b> no puede estar vacia');
				}
				$ventabkp = Venta::model()->findByPk($_GET['id']);
				if($venta->validate())
				{
					$saldo1=0;$saldo2=0;
					if($venta->formaPago==0)
					{
						$saldo1=$venta->montoPagado-$venta->montoCambio;
						$saldo2=$ventabkp->montoPagado-$ventabkp->montoCambio;
					}
					else
					{
						$saldo1=$venta->montoPagado;
						$saldo2=$ventabkp->montoPagado;
					}
					
					if($saldo1!=$saldo2)
					{
						$caja->saldo = $caja->saldo - $saldo2 + $saldo1;
						
					}
					if($venta->save())
						$caja->save();
					$swv=1;
				}	
			}
			$det=1;
			if(isset($_POST['DetalleVenta']))
			{
				$detalle2 = array();
				$i=0;
				$det=count($_POST['DetalleVenta']);
				foreach ($_POST['DetalleVenta'] as $item)
				{
					array_push($detalle2,new DetalleVenta);
					$detalle2[$i]->attributes = $item;
					if($detalle2[$i]->validate())
					{
						$det--;
					}
					$i++;
				}
			}
			
			if($swv==1 && $det==0)
			{
				foreach ($detalle as $item)
				{
					$almacenes = AlmacenProducto::model()->with('idProducto0')->findByPk($item->idAlmacenProducto);
					$almacenes->stockU = $almacenes->stockU + $item->cantidadU;
					if($almacenes->stockU>$almacenes->idProducto0->cantXPaquete)
					{
						$almacenes->stockP = $almacenes->stockP + 1;
						$almacenes->stockU = $almacenes->stockU - $almacenes->idProducto0->cantXPaquete;
					}
					$almacenes->stockP = $almacenes->stockP + $item->cantidadP;
					if($item->delete())
					{
						$almacenes->save();
					}
				}
				foreach ($detalle2 as $item)
				{
					$item->idVenta = $venta->idVenta;
					$almacenes = AlmacenProducto::model()->with('idProducto0')->findByPk($item->idAlmacenProducto);
					$almacenes->stockU = $almacenes->stockU - $item->cantidadU;
					if($almacenes->stockU<0)
					{
						$almacenes->stockP = $almacenes->stockP - 1;
						$almacenes->stockU = $almacenes->stockU + $almacenes->idProducto0->cantXPaquete;
					}
					$almacenes->stockP = $almacenes->stockP - $item->cantidadP;
					if($item->save())
					{
						$almacenes->save();
					}
				}
				$this->redirect(array('preview',"id"=>$venta->idVenta));		
			}
			
			$this->render('notas',array(
				'productos'=>$productos,
				'cliente'=>$cliente,
				'detalle'=>$detalle,
				'venta'=>$venta,
			));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	public function actionPreview()
	{
		if(isset($_GET['id']))
		{
			$ventas = Venta::model()
			->with("idCliente0")
			->with("detalleVentas")
			->with("detalleVentas.idAlmacenProducto0")
			->with("detalleVentas.idAlmacenProducto0.idProducto0")
			->with("idCaja0")
			->with("idCaja0.idUser0")
			->with("idCaja0.idUser0.idEmpleado0")
			->findByPk($_GET['id']);
			if($ventas!=null)
				$this->render('preview',array('venta'=>$ventas));
			else
				$this->redirect('index');
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	public function actionDeudores()
	{
		$deudores = new CActiveDataProvider('Venta',
										array('criteria'=>array(
											'condition'=>'montoVenta>montoPagado',
											'with'=>array('idCliente0'),
											'order'=>'fechaPlazo ASC',
										),
											'pagination'=>array(
													'pageSize'=>20,
										),));
		$this->render('deudores',array('deudores'=>$deudores));
	}
	
	public function actionMovimientos()
	{
		$ventas="";
		$cond1="";
		$cond2="";
		$cond3="";
		$factura="";
		$f="";
		if(isset($_GET['f']))
		{
			$f=$_GET['f'];
			if($_GET['f']==0)
			{
				$factura=" tipoVenta=0"; 
			}
			else
			{
				$factura=" tipoVenta=1";
			}
		}
		if(isset($_GET['d']) || isset($_GET['m']))
		{
			if($factura!="")
				$factura=" and ".$factura;
			$d=date("d");
			$m=date("m");
			$y=date("Y");
			$start=date("Y-m-d H:i:s"); $end=date("Y-m-d H:i:s");
			
			if(isset($_GET['d']))
			{
				$cond1=array("distribuidora/movimientos","f"=>0,"d"=>$_GET['d']);
				$cond2=array("distribuidora/movimientos","f"=>1,"d"=>$_GET['d']);
				$cond3=array("distribuidora/previewDay","f"=>$f,"d"=>$_GET['d']);
				$d=$_GET['d'];
				if($d==0)
				{
					$m--;
					$d=$this->getUltimoDiaMes($y, $m);
				}
				$start=$y."-".$m."-".$d." 00:00:00";
				$end=$y."-".$m."-".$d." 23:59:59";
			}
			if(isset($_GET['m']))
			{
				$cond1=array("distribuidora/movimientos","f"=>0,"m"=>$_GET['m']);
				$cond2=array("distribuidora/movimientos","f"=>1,"m"=>$_GET['m']);
				$cond3=array("distribuidora/previewDay","f"=>$f,"m"=>$_GET['m']);
				$m=$_GET['m'];
				$d=$this->getUltimoDiaMes($y, $m);
				$start=$y."-".$m."-1 00:00:00";
				$end=$y."-".$m."-".$d." 23:59:59";
			}
			$condition="'".$start."'<=fechaVenta AND fechaVenta<='".$end."'";
			$ventas = new CActiveDataProvider('Venta',
					array('criteria'=>array(
							'condition'=>$condition.$factura,
							'with'=>array('idCliente0'),
							'order'=>'fechaVenta ASC',
					),
							'pagination'=>array(
									'pageSize'=>20,
							),));
			
		}
		else 
		{
			$cond1=array("distribuidora/movimientos","f"=>0);
			$cond2=array("distribuidora/movimientos","f"=>1);
			
			if($factura=="")
			{
			$ventas = new CActiveDataProvider('Venta',
					array('criteria'=>array(
							'with'=>array('idCliente0'),
							'order'=>'fechaVenta ASC',
					),
							'pagination'=>array(
									'pageSize'=>20,
							),));
				$cond3=array("distribuidora/previewDay");
			}
			else{
				$ventas = new CActiveDataProvider('Venta',
						array('criteria'=>array(
								'with'=>array('idCliente0'),
								'condition'=>$factura,
								'order'=>'fechaVenta ASC',
						),
								'pagination'=>array(
										'pageSize'=>20,
								),));
				$cond3=array("distribuidora/previewDay","f"=>$f);
			}
					
		}
		$this->render('movimientos',array('ventas'=>$ventas,'cond1'=>$cond1,'cond2'=>$cond2,'cond3'=>$cond3));
	}
	
	public function actionPreviewDay()
	{
		$fact="";$cond="";
		if(isset($_GET['f']))
		{
			if($_GET['f']!=""){
			if($_GET['f']==0)
			{
				$fact=" and tipoVenta=0";
			}
			else
			{
				$fact=" and tipoVenta=1";
			}}
		}
		else
		{
			
		}
		if(isset($_GET['d']) || isset($_GET['m']))
		{
			$d=date("d");
			$m=date("m");
			$y=date("Y");
			$start=date("Y-m-d H:i:s"); $end=date("Y-m-d H:i:s");
	
			if(isset($_GET['d']))
			{
				$d=$_GET['d'];
				if($d==0)
				{
					$m--;
					$d=$this->getUltimoDiaMes($y, $m);
				}
				$start=$y."-".$m."-".$d." 00:00:00";
				$end=$y."-".$m."-".$d." 23:59:59";
			}
			if(isset($_GET['m']))
			{
				$m=$_GET['m'];
				$d=$this->getUltimoDiaMes($y, $m);
				$start=$y."-".$m."-1 00:00:00";
				$end=$y."-".$m."-".$d." 23:59:59";
			}
			$cond=" and '".$start."'<=fechaVenta AND fechaVenta<='".$end."'";
		}
		$caja = $this->verifyModel(CajaVenta::model()
				->with('ventas')
				->with('ventas.idCliente0')
				->with('ventas.detalleVentas')
				->with('ventas.detalleVentas.idAlmacenProducto0')
				->with('ventas.detalleVentas.idAlmacenProducto0.idProducto0')
				->find(array('condition'=>'`t`.idCaja=2 '.$fact.$cond)));
		/*$caja = $this->verifyModel(Caja::model()
		->with('cajaVentas')
		->with('cajaVentas.ventas')
		->with('cajaVentas.ventas.idCliente0')
		->with('cajaVentas.ventas.detalleVentas')
		->with('cajaVentas.ventas.detalleVentas.idAlmacenProducto0')
		->with('cajaVentas.ventas.detalleVentas.idAlmacenProducto0.idProducto0')
		->find(array('condition'=>'`t`.idCaja=2 '.$fact.$cond)));
		//print_r($caja);*/
		$tabla = $caja->ventas;
		$this->render("previewVentas",array('tabla'=>$tabla,));
	}
	
	public function actionAjaxCliente()
	{
		if(Yii::app()->request->isAjaxRequest && isset($_GET['nitCi']))
		//if(isset($_GET['nitCi']))
		{
			$cliente = $this->verifyModel(Cliente::model()->with('ventas')->find('nitCi='.$_GET['nitCi']));
			$deuda=false;
			foreach ($cliente->ventas as $item)
			{
				if($item->montoVenta > $item->montoPagado)
				{
					$deuda=true;
					break;
				}
			}
			$cliente = CJSON::encode($cliente);
			$cliente = array('cliente'=>$cliente,'deuda'=>$deuda);
			echo CJSON::encode($cliente);
		}
	}
	
	public function actionAddDetalle()
	{
		//if(Yii::app()->request->isAjaxRequest && isset($_GET['index']))
		if(isset($_GET['index']))
		{
			$detalle = new DetalleVenta;
			$almacen = new AlmacenProducto;
			if(isset($_GET['al']))
			{
				$almacen = AlmacenProducto::model()
							->with("idProducto0")
							->findByPk($_GET['al']);	
	
			}
			
			$detalle->idAlmacenProducto = $almacen->idAlmacenProducto;
			if(isset($_GET['factura']))
			{
				if($_GET['factura']==0)
				{
					$detalle->costoP = $almacen->idProducto0->precioCFP;
					$detalle->costoU = $almacen->idProducto0->precioCFU;
				}
				else
				{
					$detalle->costoP = $almacen->idProducto0->precioSFP;
					$detalle->costoU = $almacen->idProducto0->precioSFU;
				}
			}
				
			$this->renderPartial('_newRowDetalleVenta', array(
					'model'=>$detalle,
					'index'=>$_GET['index'],
					'almacen'=>$almacen,
			));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	
	
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
	
		return $model;
	}
	
	protected function getRemoveLinkAndIndexInput($index)
	{
		$removeLink=CHtml::link('Quitar', '#', array('class'=>'btn btn-danger tabular-input-remove')).'<input type="hidden" class="tabular-input-index" value="'.$index.'" />';
		$removeLink=strtr("<td>{link}</td>", array('{link}'=>$removeLink));
		return $removeLink;
	}
	
	protected function getUltimoDiaMes($elAnio,$elMes) {
		return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
	}
}
