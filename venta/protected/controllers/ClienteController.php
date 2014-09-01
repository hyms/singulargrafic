<?php

class ClienteController extends Controller
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
		/*$venta = Venta::model()->findAll(array('select'=>'count(*) as max, idCliente','group'=>'`t`.idCliente'));
		$datos1 = CHtml::listData($venta,'idCliente','max');
		
		$venta = Venta::model()->findAll(array('select'=>'count(*) as max, idCliente','group'=>'`t`.idCliente','condition'=>'formaPago=1'));
		$datos2 = CHtml::listData($venta,'idCliente','max');
		
		$venta = Venta::model()->findAll(array('select'=>'montoCambio as max, idCliente','group'=>'`t`.idCliente','condition'=>'formaPago=1'));
		$datos3 = CHtml::listData($venta,'idCliente','max');
		
		//print_r($datos);
		$datos= array('compra'=>$datos1,'credito'=>$datos2,'deuda'=>$datos3);
		$criteria=new CDbCriteria();
		$count=Cliente::model()->count($criteria);
		$pages=new CPagination($count);
		// results per page
		$pages->pageSize=20;
		$pages->applyLimit($criteria);
		$cliente=Cliente::model()->findAll($criteria);
		
		$this->render("index",array('cliente'=>$cliente,'datos'=>$datos,'pages' => $pages));*/
		$this->render("index");
	}
	
	public function actionRegister()
	{
		$model=new Cliente;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Cliente']))
		{
			$model->attributes=$_POST['Cliente'];
			$tipoCliente = TiposClientes::model()->find('nombre="nuevo"');
			$model->idTiposClientes=$tipoCliente->idTiposClientes;
			$model->fechaRegistro=date("Y-m-d H:i:s");
			if($model->save())
				$this->redirect(array('index'));
		}
		
		$this->render("form",array('model'=>$model));
	}
	
	public function actionUpdate()
	{
		if($_GET['id'])
		{
			$model=$this->verifyModel(Cliente::model()->findByPk($_GET['id']));
	
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
	
			if(isset($_POST['Cliente']))
			{
				$model->attributes=$_POST['Cliente'];
				if($model->save())
					$this->redirect(array('index'));
			}
	
			$this->render('form',array(
					'model'=>$model,
			));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	public function actionDetail()
	{
		if(isset($_GET['id']))
		{
			$datos00=array();
			$cliente = Cliente::model()
									->with("ventas")
									->with("ventas.detalleVentas")
									->with("ventas.detalleVentas.idAlmacenProducto0")
									->with("ventas.detalleVentas.idAlmacenProducto0.idProducto0")
									->find(array('condition'=>'`t`.idVenta='.$_GET['id'].' and ventas.formaPago=0 and ventas.tipoVenta=0','group'=>'detalleVentas.idAlmacen','select'=>'* , count(detalleVentas.idAlmacen) as max'));
			$temp="";
			if(!empty($cliente))
			foreach ($cliente->ventas as $ventas)
			{
				foreach ($ventas->detalleVentas as $detalle)
				{
					$temp=array("nombre"=>$detalle->idAlmacenProducto0->idProducto0->material." ".$detalle->idAlmacenProducto0->idProducto0->color." ".$detalle->idAlmacenProducto0->idProducto0->detalle,"cant"=>$cliente->max);
					array_push($datos00, $temp);
				}
			}
			$datos01=array();
			$cliente = Cliente::model()
									->with("ventas")
									->with("ventas.detalleVentas")
									->with("ventas.detalleVentas.idAlmacenProducto0")
									->with("ventas.detalleVentas.idAlmacenProducto0.idProducto0")
									->find(array('condition'=>'`t`.idVenta='.$_GET['id'].' and ventas.formaPago=1 and ventas.tipoVenta=0','group'=>'detalleVentas.idAlmacen','select'=>'* , count(detalleVentas.idAlmacen) as max'));
			$temp="";
			if(!empty($cliente))
			foreach ($cliente->ventas as $ventas)
			{
				foreach ($ventas->Detalle as $detalle)
				{
					$temp=array("nombre"=>$detalle->idAlmacenProducto0->idProducto0->material." ".$detalle->idAlmacenProducto0->idProducto0->color." ".$detalle->idAlmacenProducto0->idProducto0->detalle,"cant"=>$cliente->max);
					array_push($datos01, $temp);
				}
			}
			$datos10=array();
			$cliente = Cliente::model()
									->with("ventas")
									->with("ventas.detalleVentas")
									->with("ventas.detalleVentas.idAlmacenProducto0")
									->with("ventas.detalleVentas.idAlmacenProducto0.idProducto0")
									->find(array('condition'=>'`t`.idVenta='.$_GET['id'].' and ventas.formaPago=0 and ventas.tipoVenta=1','group'=>'detalleVentas.idAlmacen','select'=>'* , count(detalleVentas.idAlmacen) as max'));
			$temp="";
			if(!empty($cliente))
			foreach ($cliente->ventas as $ventas)
			{
				foreach ($ventas->Detalle as $detalle)
				{
					$temp=array("nombre"=>$detalle->idAlmacenProducto0->idProducto0->material." ".$detalle->idAlmacenProducto0->idProducto0->color." ".$detalle->idAlmacenProducto0->idProducto0->detalle,"cant"=>$cliente->max);
					array_push($datos10, $temp);
				}
			}
			$datos11=array();
			$cliente = Cliente::model()
									->with("ventas")
									->with("ventas.detalleVentas")
									->with("ventas.detalleVentas.idAlmacenProducto0")
									->with("ventas.detalleVentas.idAlmacenProducto0.idProducto0")
									->find(array('condition'=>'`t`.idVenta='.$_GET['id'].' and ventas.formaPago=1	and ventas.tipoVenta=1','group'=>'detalleVentas.idAlmacen','select'=>'* , count(detalleVentas.idAlmacen) as max'));
			$temp="";
			if(!empty($cliente))
			foreach ($cliente->ventas as $ventas)
			{
				foreach ($ventas->Detalle as $detalle)
				{
					$temp=array("nombre"=>$detalle->idAlmacenProducto0->idProducto0->material." ".$detalle->idAlmacenProducto0->idProducto0->color." ".$detalle->idAlmacenProducto0->idProducto0->detalle,"cant"=>$cliente->max);
					array_push($datos11, $temp);
				}
			}
			
			$venta = Venta::model()
							->with("detalleVentas")
							->with("detalleVentas.idAlmacenProducto0")
							->with("detalleVentas.idAlmacenProducto0.idProducto0")
							->findAll(array('select'=>'montoCambio as max, *','group'=>'`t`.idCliente','condition'=>'estado=2 and `t`.idCliente='.$_GET['id']));
			$datosD = array();
			if(!empty($venta))
			foreach ($venta as $ventas)
			{
				foreach ($ventas->Detalle as $detalle)
				{
					$temp=array(
							"nombre"=>$detalle->idAlmacenProducto0->idProducto0->material." ".$detalle->idAlmacenProducto0->idProducto0->color." ".$detalle->idAlmacenProducto0->idProducto0->detalle,
							"fechaVenta"=>date("d-m-Y",strtotime($ventas->fechaVenta)),
							"fechaPlazo"=>date("d-m-Y",strtotime($ventas->fechaPlazo)),
							"monto"=>number_format($ventas->max, 2));
					array_push($datosD, $temp);
				}
			}
			
			$cliente = Cliente::model()->findByPk($_GET['id']);
			$datos = array("00"=>$datos00,"01"=>$datos01,"10"=>$datos10,"11"=>$datos11,"deuda"=>$datosD);
			$this->render("detail",array('cliente'=>$cliente,'datos'=>$datos));
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
}