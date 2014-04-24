<?php

class RecibosController extends Controller
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

	public function actionIngreso()
	{
		$cliente = new Cliente;
		$recibo = new Recibo;
		
		$row = Recibo::model()->find('tipo=1',array("select"=>"count(*) as `max`"));
		
		$recibo->fecha=date("Y-m-d h:m:s");
		$recibo->codigo = "I-".date("m")."-".($row['max']+1);
		$recibo->tipo=1;
		
		if(isset($_POST['Recibo']))
		{
			$recibo->attributes=$_POST['Recibo'];
			$recibo->validate();	
		}	 
		$this->render("ingreso",array(
									'cliente'=>$cliente,
									'recibo'=>$recibo,
					
									));
	}
	
	public function actionEgreso()
	{
		$cliente = new Cliente;
		$recibo = new Recibo;
		
		$row = Recibo::model()->find('tipo=0',array("select"=>"count(*) as `max`"));
		
		$recibo->fecha=date("Y-m-d h:m:s");
		$recibo->codigo = "E-".date("m")."-".($row['max']+1);
		$recibo->tipo=0;
		$recibo->responsable="Miriam Martinez";
		
		if(isset($_POST['Recibo']))
		{
			$recibo->attributes=$_POST['Recibo'];
			$recibo->validate();
		}
		$this->render("egreso",array(
				'cliente'=>$cliente,
				'recibo'=>$recibo,
					
		));
	}
	
	public function actionIndex()
	{
	
		$this->render("index");
	}
	
	public function actionPreview()
	{
		
	}
	
	public function actionLlenado()
	{
		if(Yii::app()->request->isAjaxRequest && isset($_GET['nitCi']))
		{
			$cliente = $this->verifyModel(Cliente::model()->find('nitCi='.$_GET['nitCi']));
			echo CJSON::encode($cliente);
		}
	}
	
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		return $model;
	}
}