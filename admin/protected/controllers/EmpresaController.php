<?php

class EmpresaController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionSucursal($id=null)
	{
		$model=new Empresa;
		if($id!=null)
			$model=Empresa::model()->findByPk($id);
		$sucursal=Empresa::model()->findall();
		
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['Empresa']))
		{
			$model->attributes=$_POST['Empresa'];
			$model->ciudad=$_POST['ciudad']; 
			if($model->save())
			{
				$this->redirect('sucursal');
			}
			else 
			{
				$this->render('empresa',array('model'=>$model,'sucursal'=>$sucursal,"new"=>$new));
			}
		}
		else 
		{
			$this->render('empresa',array('model'=>$model,'sucursal'=>$sucursal,"new"=>$new));
		}
	}
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}