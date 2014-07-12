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
		if(isset($_GET['id']))
		{
			$ctp = CTP::model()
				->with('detalleCTPs')
				->with('idCliente0')
				->findByPk($_GET['id']);
			$this->render('orden',array('ctp'=>$ctp,'detalle'=>$ctp->detalleCTPs,'cliente'=>$ctp->idCliente0));
		}
		else
			throw new CHttpException(400,'Petición no válida.');	
	}
	
	public function actionFactura()
	{
		if(isset($_GET['id']))
		{
			$ctp = CTP::model()
			->with('detalleCTPs')
			->with('idCliente0')
			->findByPk($_GET['id']);
			
			$ctp->attributes = $_POST['CTP'];
			
			$row = CTP::model()->find(array("condition"=>"tipoOrden=".$ctp->tipoOrden,'order'=>'fechaOrden Desc'));
			if(empty($row))
				$row=new CTP;
			if(empty($row->serie))
				$row->serie = 65;
			$ctp->numero = $row->numero +1;
			if($row->numero==1001)
			{
				$row->numero=1;
				$row->serie++;
				if($row->serie==91)
					$row->serie = 65;
			}
			$ctp->serie = $row->serie;
			
			if($ctp->tipoOrden==1)
				$ctp->codigo = chr($ctp->serie)."C-".$ctp->numero."-".date("y");
			else
				$ctp->codigo = $ctp->numero."-P";
			
			$this->render('orden',array('ctp'=>$ctp,'detalle'=>$ctp->detalleCTPs,'cliente'=>$ctp->idCliente0));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
}