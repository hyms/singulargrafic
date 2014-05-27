<?php

class CajaController extends Controller
{
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/*$dataProvider=new CActiveDataProvider('Caja',
				array(	
						'criteria'=>array(
							'with'=>array('cajaVentas','cajaVentas.idUser0'),
						),
						'pagination'=>array(
						'pageSize'=>'20',
				),));*/
		$cajas = Caja::model()->with('cajaVentas')->with('cajaVentas.idUser0')->findAll();
		$this->render('index',array('cajas'=>$cajas));
	}
	
	public function actionCaja()
	{
		$model=new Caja;
		
		if(isset($_GET['id']))
			$model=Caja::model()->findByPk($_GET['id']);
	
		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='caja-cajaForm-form')
		{
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
	
		if(isset($_POST['Caja']))
		{
			$model->attributes=$_POST['Caja'];
			if($model->save())
			{
			// form inputs are valid, do something here
				$this->redirect(array('index'));
			}
		}
		$this->render('cajaForm',array('model'=>$model));
	}
			
	public function actionAssign()
	{
		if(isset($_GET['id']))
		{
			
			$users = new CActiveDataProvider('Users',
					array(	
							'pagination'=>array(
								'pageSize'=>'20',
							),
						));
			$this->render('assign',array('users'=>$users));
		}
		else
			throw new CHttpException(400,'Petición no válida.');	
	} 	
	
	public function actionAdd()
	{
		
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param Caja $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='Caja-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
	
		return $model;
	}
}
