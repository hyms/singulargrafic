<?php

class AlmacenController extends Controller
{
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Almacen;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Almacen']))
		{
			$model->attributes=$_POST['Almacen'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Almacen');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
				'criteria'=>array(
					'with'=>'TipoAlmacen',
					'with'=>'Producto',
					'with'=>'Producto.Color',
					'with'=>'Producto.Material',
				),
				
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Almacen the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Almacen::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Almacen $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='almacen-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionTipoAlmacen($id=null)
	{
		$model=new TipoAlmacen;
		if($id!=null)
			$model=TipoAlmacen::model()->findByPk($id);
			
		$tipos=TipoAlmacen::model()->findall();
		
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['TipoAlmacen']))
		{
			$model->attributes=$_POST['TipoAlmacen'];
				
			if($model->save())
			{
				$this->redirect('tipoAlmacen');
			}
			else
			{
				$this->render('tipoAlmacen',array('model'=>$model,'tipos'=>$tipos,'new'=>$new));
			}
		}
		else
		{
			$this->render('tipoAlmacen',array('model'=>$model,'tipos'=>$tipos,'new'=>$new));
		}
	}
	
	public function actionAdd_reduce()
	{
		$model=new Almacen;
		$model=new MovimientoAlmacen;
		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='almacen-add_reduce-form')
		{
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
	
		if(isset($_POST['Almacen']))
		{
			$model->attributes=$_POST['Almacen'];
			if($model->validate())
			{
				// form inputs are valid, do something here
				return;
			}
		}
		$dataProvider=new CActiveDataProvider('Almacen');
		$this->render('add_reduce',array(
				'dataProvider'=>$dataProvider,
				'criteria'=>array(
						'with'=>'TipoAlmacen',
						'with'=>'Producto',
						'with'=>'Producto.Color',
						'with'=>'Producto.Material',
				),
		
				'pagination'=>array(
						'pageSize'=>20,
				),
				'model'=>$model));
		//$this->render('add_reduce',array('model'=>$model));
	}
}
