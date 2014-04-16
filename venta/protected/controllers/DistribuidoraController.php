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
		//print_r(Yii::app()->user->id);
		$cliente = new Cliente;
		$empleado = Empleado::model()->findByPk(Yii::app()->user->id);
		$almacen = new Almacen;
		$productos = new Producto('searchAll');
		$venta = new Venta;
		$detalle = new DetalleVenta;

		//new venta
		$row = Venta::model()->find(array("select"=>"count(*) as `max`"));
		$venta->codigo= ($row['max']+1)."-".date("m")."-".date("y");
		$venta->fechaVenta = date("Y-m-d H:i:s");
		//date("Y-m-d", strtotime($model->fechaIngreso))
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
		
		
		$factura=0;
		$formaPago=0;
		if(isset($_POST['factura']))
		{
			$factura=$_POST['factura'];
		}
		if(isset($_POST['formaPago']))
		{
			$formaPago=$_POST['formaPago'];
		}
		
		//init seccion for save datas
		$save=0;
		if(isset($_POST['Cliente']))
		{
			$cliente = Cliente::model()->find('nitCi="'.$_POST['Cliente']['nitCi'].'"');
			if($cliente==null)
				$cliente = new Cliente;
			
			$cliente->attributes = $_POST['Cliente'];
			$cliente->fechaRegistro = date("Y-m-d");
			if($cliente->validate())
			{
				if($cliente->save())
					$save++;
			}
		}
		
		if(isset($_POST['Venta']))
		{
			$venta->attributes = $_POST['Venta'];
			$venta->idCliente = $cliente->id;
			$venta->idTipoPago = $formaPago;
			$venta->estado = 1;
			$venta->idEmpleado = 1;
			
			if(isset($_POST['Venta']['fechaPlazo']))
				$venta->fechaPlazo = $_POST['Venta']['fechaPlazo'];
			if($venta->validate())
			{
				if($venta->save())
					$save++;
			}
			if($formaPago==1)
			{
				$credito = new Credito;
				$credito->idVenta=$venta->id;
				$credito->idcliente=$venta->idCliente;
				$credito->fechaPago=$venta->fechaVenta;
				$credito->monto=$venta->montoPagado;
				$credito->save();
			}
		}
		
		if(isset($_POST['DetalleVenta']))
		{
			$detalle = array();
			$i=0;
			
			foreach ($_POST['DetalleVenta'] as $item)
			{
				array_push($detalle,new DetalleVenta);
				$detalle[$i]->attributes = $item;
				$detalle[$i]->idVenta = $venta->id;
				
				if($detalle[$i]->validate())
				{	
					if($detalle[$i]->save())
					{
						$save++;
						$almacenes->save();
					}
				}
				$i++;
			}
		}
		//finish section for save datas
		
		//print_r($venta);
		if($save>=3)
		{
			$this->redirect(array('venta'));
		}
		
		$this->render('index',array(
				//'dataProvider'=>$dataProvider,
				'cliente'=>$cliente,
				'empleado'=>$empleado,
				'venta'=>$venta,
				'almacen'=>$almacen,
				'productos'=>$productos,
				'detalle'=>$detalle,
				'factura'=>$factura,
				'formaPago'=>$formaPago,
				
				'pagination'=>array(
						'pageSize'=>5,
				),
		));
		
		
	}
	
	public function actionFactura()
	{
		$empleado = Empleado::model()->findByPk('1');
		
		$productos=new Producto('searchAll');
		$cliente = new Cliente;
		$detalle = array();
		$venta = new Venta;
		
		$factura=0;
		$formaPago=0;
		if(isset($_POST['factura']))
		{
			$factura=$_POST['factura'];
		}
		if(isset($_POST['formaPago']))
		{
			$formaPago=$_POST['formaPago'];
		}
		
		if(isset($_POST['Cliente']))
		{
			$cliente->attributes = $_POST['Cliente'];
		}
		
		$total=0;
		if(isset($_POST['DetalleVenta']))
		{
			$i=0;
				
			foreach ($_POST['DetalleVenta'] as $item)
			{
				array_push($detalle,new DetalleVenta);
				$detalle[$i]->attributes = $item;
				
				$almacen = Almacen::model()->with('Producto')->findByPk($detalle[$i]->idAlmacen);
				if($factura==0)
				{
					$detalle[$i]->costoTotal=($almacen->Producto->costoCFUnidad*$detalle[$i]->cantUnidad)+($almacen->Producto->costoCF*$detalle[$i]->cantPaquete);
				}
				else
				{
					$detalle[$i]->costoTotal=($almacen->Producto->costoSFUnidad*$detalle[$i]->cantUnidad)+($almacen->Producto->costoSF*$detalle[$i]->cantPaquete);
				}
				$total=$total+$detalle[$i]->costoTotal;
				$i++;
			}
		}
			
		if(isset($_POST['Venta']))
		{
			$venta->attributes = $_POST['Venta'];
			if(isset($_POST['Venta']['fechaPlazo']))
				$venta->fechaPlazo = $_POST['Venta']['fechaPlazo'];
			$venta->montoTotal=$total;
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
				'factura'=>$factura,
				'formaPago'=>$formaPago,
				
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
										    ),
										    'pagination'=>array(
										        'pageSize'=>20,
										    ),));
		$this->render('venta',array('ventas'=>$ventas,'titulo'=>"Ventas por Confirmar"));
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
						->findByPk($_GET['id']);
			
			if($ventas!=null)
				$this->render('preview',array('venta'=>$ventas));
			else
				$this->redirect(array('venta'));
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
			
			foreach ($venta->Detalle as $detalle)
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
			$venta->fechaVenta = date("Y-m-d H:i:s");
			$venta->save();
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		
	}
	
	public function actionCredito()
	{
		$ventas = new CActiveDataProvider('Venta',array('criteria'=>array(
				'condition'=>'estado=2',
				'with'=>array('Cliente'),
		),
				'pagination'=>array(
						'pageSize'=>20,
				),));
		$this->render('venta',array('ventas'=>$ventas,'titulo'=>"Ventas a Credito"));
	} 
	
	public function actionVentas()
	{
		$ventas = new CActiveDataProvider('Venta',array('criteria'=>array(
				'condition'=>'estado=0',
				'with'=>array('Cliente'),
		),
				'pagination'=>array(
						'pageSize'=>20,
				),));
		$this->render('venta',array('ventas'=>$ventas,'titulo'=>"Ventas Realizadas"));
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
			$venta->save();
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		
	}
	
	public function actionAjaxCliente($nitCi)
	{
		if(Yii::app()->request->isAjaxRequest)
		{
			$cliente = $this->verifyModel(Cliente::model()->find('nitCi='.$nitCi));
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