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
						'expression'=>'isset($user->role) && ($user->role==="ventas")',
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'expression'=>'isset($user->role) && ($user->role==="admin")',
				),
				array('deny',
						'users'=>array('*'),
				),
		);
	}
	
	public function actionIndex()
	{
		
		$cliente = new Cliente;
		$empleado = Empleado::model()->with('Users')->find('idUsers='.Yii::app()->user->id);
		$almacen = new Almacen;
		$productos = new Producto('searchAll');
		$venta = new Venta;
		$caja = Caja::model()->find(array('condition'=>'arqueo=0 and entregado=0 and nombre like "papeles"','order'=>'id Desc'));
		$venta->idCaja = $caja->id;
		$detalle = new DetalleVenta;
		$credito = "";
		//new venta
		$row = Venta::model()->find(array("condition"=>"tipoPago=1",'order'=>'fechaVenta Desc'));
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
		$venta->tipoPago = 1;
		
		//init seccion on filter
		$productos->unsetAttributes();
		$dist = $this->verifyModel(TipoAlmacen::model()->find('nombre like "%distribuidora%"'));
		$productos->almacen = $dist->id;
		if (isset($_GET['Producto']))
		{
			$productos->attributes = $_GET['Producto'];
			$productos->color = $_GET['Producto']['color'];
			$productos->material = $_GET['Producto']['material'];
			$productos->industria = $_GET['Producto']['industria'];
			//$productos->almacen = $_GET['Producto']['almacen'];
		}
		//finish filter seccion
		
		//init seccion for save datas
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
			$row = Venta::model()->find(array("condition"=>"tipoPago=".$venta->tipoPago,'order'=>'fechaVenta Desc'));
			if(empty($row->serie) && $venta->tipoPago==1)
				$row->serie = 65;
			$venta->codigo = $row->codigo +1;
			if($row->codigo==1001 && $venta->tipoPago==1)
			{
				$row->codigo;
				$row->serie++;
				if($row->serie==91)
					$row->serie = 65;
			}
			$venta->serie = $row->serie;
			$venta->estado = 1;
			$venta->idEmpleado = $empleado->id;
			if($venta->formaPago==1)
			{
				if(($_POST['Venta']['fechaPlazo'])!="")
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
			$venta->idCliente = $cliente->id;
			
			if($venta->formaPago==1)
			{
				$credito = new Credito;
				$credito->idVenta=$venta->id;
				$credito->idCliente=$venta->idCliente;
				$credito->fechaPago=$venta->fechaVenta;
				$credito->monto=$venta->montoPagado;
				$credito->saldo=$venta->montoCambio*(-1);
				$credito->save();
				$venta->estado = 2;
			}
			
			if($venta->save())
			{			
				$det=count($detalle);
				$almacenes=array();	$i=0;
				foreach($detalle as $item)
				{
					$item->idVenta = $venta->id;
					if($item->validate())
					{	
						$almacenes = array_push($almacenes,Almacen::model()->with('Producto')->findByPk($item->idAlmacen));
						$almacenes[$i]->stockUnidad = $almacenes[$i]->stockUnidad - $item->cantUnidad;
						if($almacenes[$i]->stockUnidad<0)
						{
							$almacenes[$i]->stockPaquete = $almacenes[$i]->stockPaquete - 1;
							$almacenes[$i]->stockUnidad = $almacenes[$i]->stockUnidad + $almacenes[$i]->Producto->cantidad;
						}
						$almacenes[$i]->stockPaquete = $almacenes[$i]->stockPaquete - $item->cantPaquete;
						if($almacenes[$i]->stockUnidad<0 && $almacenes[$i]->stockPaquete<0)
						{
							$venta->addError('montoTotal', 'No existen suficientes Insumos');
							if($venta->formaPago==1)
							{
								$credito->delete();
							}
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
					$this->redirect('venta');
				}
				//finish section for save datas
			}
		}
	
		$this->render('index',array(
				'cliente'=>$cliente,
				'empleado'=>$empleado,
				'venta'=>$venta,
				'almacen'=>$almacen,
				'productos'=>$productos,
				'detalle'=>$detalle,
				
				'pagination'=>array(
						'pageSize'=>5,
				),
		));
	}
	
	public function actionFactura()
	{
		$empleado = Empleado::model()->with('Users')->find('idUsers='.Yii::app()->user->id);
		
		$productos=new Producto('searchAll');
		$cliente = new Cliente;
		$detalle = array();
		$venta = new Venta;
		
		//init seccion on filter
		$productos->unsetAttributes();
		$dist = $this->verifyModel(TipoAlmacen::model()->find('nombre like "%distribuidora%"'));
		$productos->almacen = $dist->id;
		if (isset($_GET['Producto']))
		{
			$productos->attributes = $_GET['Producto'];
			$productos->color = $_GET['Producto']['color'];
			$productos->material = $_GET['Producto']['material'];
			$productos->industria = $_GET['Producto']['industria'];
			//$productos->almacen = $_GET['Producto']['almacen'];
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
			$row = Venta::model()->find(array("condition"=>"tipoPago=".$venta->tipoPago,'order'=>'fechaVenta Desc'));
			if(empty($row))
				$row=new Venta;
			if(empty($row->serie) && $venta->tipoPago==1)
				$row->serie = 65;
			$venta->codigo = $row->codigo +1;
			if($row->codigo==1001 && $venta->tipoPago==1)
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
					
					$almacen = Almacen::model()->with('Producto')->findByPk($detalle[$i]->idAlmacen);
					if($venta->tipoPago==0)
					{
						$detalle[$i]->costoTotal=($almacen->Producto->costoCFUnidad*$detalle[$i]->cantUnidad)+($almacen->Producto->costoCF*$detalle[$i]->cantPaquete)+$detalle[$i]->adicional;
					}
					else
					{
						$detalle[$i]->costoTotal=($almacen->Producto->costoSFUnidad*$detalle[$i]->cantUnidad)+($almacen->Producto->costoSF*$detalle[$i]->cantPaquete)+$detalle[$i]->adicional;
					}
					$total=$total+$detalle[$i]->costoTotal;
					$i++;
				}
			}	
			
			$venta->montoTotal=$total;
			if($venta->montoDescuento!=null)
			{
				$venta->montoTotal=$venta->montoTotal-$venta->montoDescuento;
			}
			$venta->montoCambio=$venta->montoPagado - $venta->montoTotal;
		}
		
		$almacen = new Almacen;
		
		$this->render('index',array(
				//'dataProvider'=>$dataProvider,
				'cliente'=>$cliente,
				'empleado'=>$empleado,
				'venta'=>$venta,
				'almacen'=>$almacen,
				'productos'=>$productos,
				'detalle'=>$detalle,
				
				'pagination'=>array(
						'pageSize'=>5,
				),
		));
	}
	
	public function actionVenta()
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
	}
	
	public function actionCredito()
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
	} 
	
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
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	public function actionConfirm()
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
			*/
			$venta->estado = 0;
			if($venta->formaPago==1)
				$venta->estado = 2;
			
			$venta->save();
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	
	}
	
	public function actionCancelar()
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
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		
	}
	
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
		if(Yii::app()->request->isAjaxRequest && isset($_GET['index']))
		{
			$detalle = new DetalleVenta;
			$almacen = new Almacen;
			if(isset($_GET['al']))
			{
				$almacen = Almacen::model()	->with("Producto")
				->with("Producto.Color")
				->with("Producto.Material")
				//->with("Producto.Industria")
				->findByPk($_GET['al']);
	
			}
			$detalle->idAlmacen = $almacen->id;
			$this->renderPartial('_newRowDetalleVenta', array(
					'model'=>$detalle,
					'index'=>$_GET['index'],
					'factura'=>$_GET['factura'],
					'almacen'=>$almacen,
					'costos'=>array(),
			));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
	
		return $model;
	}
	
	protected function getRemoveLinkAndIndexInput($index)
	{
		$removeLink=CHtml::link('Quitar', '#', array('class'=>'btn btn-danger tabular-input-remove')).'<input type="hidden" class="tabular-input-index" value="'.$index.'" />';
		$removeLink=strtr("<td>{link}</td>", array('{link}'=>$removeLink));
		return $removeLink;
	}
}
