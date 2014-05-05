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
		$venta = Venta::model()->findAll(array('select'=>'count(*) as max, idCliente','group'=>'`t`.idCliente'));
		$datos1 = CHtml::listData($venta,'idCliente','max');
		$venta = Venta::model()->findAll(array('select'=>'count(*) as max, idCliente','group'=>'`t`.idCliente','condition'=>'formaPago=1'));
		$datos2 = CHtml::listData($venta,'idCliente','max');
		$venta = Venta::model()->with('Credito')->findAll(array('select'=>'MIN(Credito.saldo) as max, idCliente','group'=>'`t`.idCliente','condition'=>'formaPago=1'));
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
		
		$this->render("index",array('cliente'=>$cliente,'datos'=>$datos,'pages' => $pages));
	}
	
	public function actionRegister()
	{
		$cliente = new Cliente;
		$cliente->fechaRegistro = date("Y-m-d"); 
		$this->render("form",array('model'=>$cliente));
	}
	
	public function actionDetail()
	{
		if(isset($_GET['id']))
		{
			$datos00=array();$datos01=array();$datos10=array();$datos11=array();
			
			$cliente = Cliente::model()
									->with("Venta")
									->with("Venta.Detalle")
									->with("Venta.Detalle.Almacen")
									->with("Venta.Detalle.Almacen.Producto")
									->with("Venta.Detalle.Almacen.Producto.Color")
									->with("Venta.Detalle.Almacen.Producto.Material")
									->with("Venta.Credito")
									->find(array('condition'=>'`t`.id='.$_GET['id'].' and Venta.formaPago=0 and Venta.tipoPago=0','group'=>'Detalle.idAlmacen','select'=>'* , count(Detalle.idAlmacen) as max'));
			$temp="";
			if(!empty($cliente))
			foreach ($cliente->Venta as $ventas)
			{
				foreach ($ventas->Detalle as $detalle)
				{
					$temp=array("nombre"=>$detalle->Almacen->Producto->Material->nombre." ".$detalle->Almacen->Producto->Color->nombre." ".$detalle->Almacen->Producto->peso." ".$detalle->Almacen->Producto->dimension.", ".$detalle->Almacen->Producto->procedencia,"cant"=>$cliente->max);
					array_push($datos00, $temp);
				}
			}
			$cliente = Cliente::model()
			->with("Venta")
			->with("Venta.Detalle")
			->with("Venta.Detalle.Almacen")
			->with("Venta.Detalle.Almacen.Producto")
			->with("Venta.Detalle.Almacen.Producto.Color")
			->with("Venta.Detalle.Almacen.Producto.Material")
			->with("Venta.Credito")
			->find(array('condition'=>'`t`.id='.$_GET['id'].' and Venta.formaPago=1 and Venta.tipoPago=0','group'=>'Detalle.idAlmacen','select'=>'* , count(Detalle.idAlmacen) as max'));
			$temp="";
			if(!empty($cliente))
			foreach ($cliente->Venta as $ventas)
			{
				foreach ($ventas->Detalle as $detalle)
				{
					$temp=array("nombre"=>$detalle->Almacen->Producto->Material->nombre." ".$detalle->Almacen->Producto->Color->nombre." ".$detalle->Almacen->Producto->peso." ".$detalle->Almacen->Producto->dimension.", ".$detalle->Almacen->Producto->procedencia,"cant"=>$cliente->max);
					array_push($datos01, $temp);
				}
			}
			$cliente = Cliente::model()
			->with("Venta")
			->with("Venta.Detalle")
			->with("Venta.Detalle.Almacen")
			->with("Venta.Detalle.Almacen.Producto")
			->with("Venta.Detalle.Almacen.Producto.Color")
			->with("Venta.Detalle.Almacen.Producto.Material")
			->with("Venta.Credito")
			->find(array('condition'=>'`t`.id='.$_GET['id'].' and Venta.formaPago=0 and Venta.tipoPago=1','group'=>'Detalle.idAlmacen','select'=>'* , count(Detalle.idAlmacen) as max'));
			$temp="";
			if(!empty($cliente))
			foreach ($cliente->Venta as $ventas)
			{
				foreach ($ventas->Detalle as $detalle)
				{
					$temp=array("nombre"=>$detalle->Almacen->Producto->Material->nombre." ".$detalle->Almacen->Producto->Color->nombre." ".$detalle->Almacen->Producto->peso." ".$detalle->Almacen->Producto->dimension.", ".$detalle->Almacen->Producto->procedencia,"cant"=>$cliente->max);
					array_push($datos10, $temp);
				}
			}
			$cliente = Cliente::model()
			->with("Venta")
			->with("Venta.Detalle")
			->with("Venta.Detalle.Almacen")
			->with("Venta.Detalle.Almacen.Producto")
			->with("Venta.Detalle.Almacen.Producto.Color")
			->with("Venta.Detalle.Almacen.Producto.Material")
			->with("Venta.Credito")
			->find(array('condition'=>'`t`.id='.$_GET['id'].' and Venta.formaPago=1	and Venta.tipoPago=1','group'=>'Detalle.idAlmacen','select'=>'* , count(Detalle.idAlmacen) as max'));
			$temp="";
			if(!empty($cliente))
			foreach ($cliente->Venta as $ventas)
			{
				foreach ($ventas->Detalle as $detalle)
				{
					$temp=array("nombre"=>$detalle->Almacen->Producto->Material->nombre." ".$detalle->Almacen->Producto->Color->nombre." ".$detalle->Almacen->Producto->peso." ".$detalle->Almacen->Producto->dimension.", ".$detalle->Almacen->Producto->procedencia,"cant"=>$cliente->max);
					array_push($datos11, $temp);
				}
			}
			
			$venta = Venta::model()
							->with('Credito')
							->with("Detalle")
							->with("Detalle.Almacen")
							->with("Detalle.Almacen.Producto")
							->with("Detalle.Almacen.Producto.Color")
							->with("Detalle.Almacen.Producto.Material")
							->findAll(array('select'=>'MIN(Credito.saldo) as max, *','group'=>'`t`.idCliente','condition'=>'estado=2 and `t`.idCliente='.$_GET['id']));
			$datosD = array();
			if(!empty($venta))
			foreach ($venta as $ventas)
			{
				foreach ($ventas->Detalle as $detalle)
				{
					$temp=array(
							"nombre"=>$detalle->Almacen->Producto->Material->nombre." ".$detalle->Almacen->Producto->Color->nombre." ".$detalle->Almacen->Producto->peso." ".$detalle->Almacen->Producto->dimension.", ".$detalle->Almacen->Producto->procedencia,
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
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		return $model;
	}
}