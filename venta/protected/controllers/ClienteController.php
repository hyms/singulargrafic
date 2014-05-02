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
			$cliente = Cliente::model()
									->with("Venta")
									->with("Venta.Credito")
									->find('`t`.id='.$_GET['id']);
			$this->render("detail",array('cliente'=>$cliente));
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