<?php
class CtpController extends Controller
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
	
	public function actionOrdenes()
	{
		$ordenes=new CActiveDataProvider('CTP',array(
				'criteria'=>array(
					'with'=>array('idCliente0'),
				),
				'pagination'=>array(
						'pageSize'=>'20',
				),));
		$this->render('ordenes',array('ordenes'=>$ordenes));
	}
	
	public function actionOrden()
	{
		$this->render('orden');
	}
}