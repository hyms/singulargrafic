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
		$this->render('index');
	}
	
	public function actionNotas()
	{
		$productos = new AlmacenProducto('searchDistribuidora');
		$cliente = new Cliente;
		$detalle = new DetalleVenta;
		$venta = new Venta;
		$caja = CajaVenta::model()->find(array('condition'=>'idCaja=2 and idUser='.Yii::app()->user->id));
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
			if($cliente->validate())
				$swc=1;
		}
		
		if(isset($_POST['Venta']))
		{
			$venta->attributes = $_POST['Venta'];
			$row = Venta::model()->find(array("condition"=>"tipoVenta=".$venta->tipoVenta,'order'=>'fechaVenta Desc'));
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
				
			if($venta->formaPago==1)
			{
				$venta->estado = 2;
			}
				
			if($venta->save())
			{
				$det=count($detalle);
				$almacenes=array();	$i=0;
				foreach($detalle as $item)
				{
					$item->idVenta = $venta->idVenta;
					if($item->validate())
					{
						$almacenes = array_push($almacenes,AlmacenProducto::model()->with('idProducto0')->findByPk($item->idAlmacenProducto));
						$almacenes[$i]->stockU = $almacenes[$i]->stockU - $item->cantidadU;
						if($almacenes[$i]->stockU<0)
						{
							$almacenes[$i]->stockP = $almacenes[$i]->stockP - 1;
							$almacenes[$i]->stockU = $almacenes[$i]->stockU + $almacenes[$i]->idProducto0->cantXPaquete;
						}
						$almacenes[$i]->stockP = $almacenes[$i]->stockP - $item->cantidadP;
						if($almacenes[$i]->stockU<0 && $almacenes[$i]->stockP<0)
						{
							$venta->addError('montoTotal', 'No existen suficientes Insumos');
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
						$this->redirect(array('index'));
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
						$detalle[$i]->costoTotal=($almacen->idProducto0->precioSFP*$detalle[$i]->cantidadU)+($almacen->idProducto0->precioCFP*$detalle[$i]->cantidadP)+$detalle[$i]->costoAdicional;
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
		if(isset($_GET['id']))
		{
			$venta = $this->verifyModel(Venta::model()->with('idCliente0')->findByPk($_GET['id']));
			$cliente = $venta->idCliente0;
			$detalle = DetalleVenta::model()->findAll($venta->idVenta);
			$productos = new AlmacenProducto('searchDistribuidora');
			
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
	
	/*public function actionVenta()
	{
		$ventas = new CActiveDataProvider('Venta',array('criteria'=>array(
												        'condition'=>'estado=1',
												        'with'=>array('Cliente'),
														'order'=>'fechaVenta DESC',
												    ),
												    'pagination'=>array(
												        'pageSize'=>20,
										    ),));
		$this->render('venta',array('ventas'=>$ventas,'titulo'=>"Ventas por Confirmar",'estado'=>"1"));
	}*/
	
	
	/*public function actionCredito()
	{
		$ventas = new CActiveDataProvider('Venta',
									array('criteria'=>array(
											'condition'=>'estado=2',
											'with'=>array('Cliente'),
									),
									'pagination'=>array(
									'pageSize'=>20,
									),));
		$this->render('credito',array('ventas'=>$ventas,'titulo'=>"Ventas a Credito",'estado'=>"2"));
	} */
	
	public function actionVentas()
	{
		$tiempo="";
		if (isset($_GET['d']))
		{
			$date = date("Y-m")."-".$_GET['d'];
			$tiempo=" and fechaVenta between '".$date." 00:00:00' and '".$date." 23:59:59'";
		}
		if (isset($_GET['m']))
		{
			$date1 = date("Y")."-".$_GET['m']."-1";
			$date2 = date("Y")."-".($_GET['m']+1)."-1";
			$tiempo=" and fechaVenta between '".$date1."' and '".$date2."'";
		}
		$ventas = new CActiveDataProvider('Venta',
				array('criteria'=>array(
						'condition'=>'estado=0'.$tiempo,
						'with'=>array('Cliente'),),
						'pagination'=>array(
						'pageSize'=>20,
				),));
		$this->render('venta',array('ventas'=>$ventas,'titulo'=>"Ventas Realizadas",'estado'=>"0"));
	}
	
	public function actionPreview()
	{
		if(isset($_GET['id']))
		{
			$ventas = Venta::model()
							->with("Cliente")
							->with("Detalle")
							->with("Detalle.Almacen")
							->with("Detalle.Almacen.Producto")
							->with("Detalle.Almacen.Producto.Color")
							->with("Detalle.Almacen.Producto.Material")
							->with("Empleado")
							->findByPk($_GET['id']);
				
			if($ventas!=null)
				$this->render('preview',array('venta'=>$ventas));
			else
				$this->redirect('venta');
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	/*public function actionConfirm()
	{
		if(Yii::app()->request->isAjaxRequest && isset($_GET['id']))
		{
			$venta = Venta::model()
							->with("Detalle")
							->with("Detalle.Almacen")
							->findByPk($_GET['id']);
			$caja = Caja::model()->findByPk($venta->idCaja);	
			if(isset($_GET['factura']))
				$venta->factura=$_GET['factura'];
			if($venta->formaPago==0)
				$caja->saldo = $caja->saldo+($venta->montoPagado-$venta->montoCambio);
			
			if($venta->formaPago==1)
				$caja->saldo = $caja->saldo+$venta->montoPagado;
			/*foreach ($venta->Detalle as $detalle)
			{
				$almacenes = Almacen::model()->with('Producto')->findByPk($detalle->idAlmacen);
				$almacenes->stockUnidad = $almacenes->stockUnidad - $detalle->cantUnidad;
				if($almacenes->stockUnidad<0)
				{
					$almacenes->stockPaquete = $almacenes->stockPaquete - 1;
					$almacenes->stockUnidad = $almacenes->stockUnidad + $almacenes->Producto->cantidad;
				}
				$almacenes->stockPaquete = $almacenes->stockPaquete - $detalle->cantPaquete;
	
				$almacenes->save();
			}
			
			$venta->estado = 0;
			if($venta->formaPago==1)
				$venta->estado = 2;
			
			$venta->save();
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	
	}*/
	
	/*public function actionCancelar()
	{
		if(Yii::app()->request->isAjaxRequest && isset($_GET['id']))
		{
			$venta = Venta::model()
						->findByPk($_GET['id']);
			$venta->estado = -1;
			$venta->obs = $_GET['obs'];
			$venta->fechaVenta = date("Y-m-d H:i:s");
			if($venta->save())
			{
				$venta = Venta::model()
								->with("Detalle")
								->findByPk($venta->id);
				foreach ($venta->Detalle as $detalle)
				{
					$almacenes = Almacen::model()->with('Producto')->findByPk($detalle->idAlmacen);
					$almacenes->stockUnidad = $almacenes->stockUnidad + $detalle->cantUnidad;
					if($almacenes->stockUnidad>$almacenes->Producto->cantidad)
					{
						$almacenes->stockPaquete = $almacenes->stockPaquete + 1;
						$almacenes->stockUnidad = $almacenes->stockUnidad - $almacenes->Producto->cantidad;
					}
					$almacenes->stockPaquete = $almacenes->stockPaquete + $detalle->cantPaquete;
					$almacenes->save();
				}
			}
		}
		else
			throw new CHttpException(400,'Petición no válida.');
		
	}*/
	
	public function actionAjaxCliente()
	{
		if(Yii::app()->request->isAjaxRequest && isset($_GET['nitCi']))
		{
			$cliente = $this->verifyModel(Cliente::model()->find('nitCi='.$_GET['nitCi']));
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
}
