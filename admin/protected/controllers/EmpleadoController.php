<?php

class EmpleadoController extends Controller
{
	public function filters()
	{
		return array( 'accessControl' ); // perform access control for CRUD operations
	}
	
	public function accessRules() {
		return array(
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'expression'=>'isset($user->role) && ($user->role==="1")',
				),
				array('deny',
						'users'=>array('*'),
				),
		);
	}

	public function actionCreate()
	{
		$model=new Empleado;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Empleado']))
		{
			$model->attributes=$_POST['Empleado'];
			$model->fechaRegistro=date("Y-m-d H:i:s");
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('index',array(
            'render'=>'new',
			'model'=>$model,
		));
	}

	public function actionUpdate()
	{
		if($_GET['id'])
		{
			$model=$this->verifyModel(Empleado::model()->findByPk($_GET['id']));
		
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
		
			if(isset($_POST['Empleado']))
			{
				$model->attributes=$_POST['Empleado'];
				if($model->save())
					$this->redirect(array('index'));
			}
		
			$this->render('index',array(
                'render'=>'update',
                'model'=>$model,
			));
		}
		else
			throw new CHttpException(400,'La Respuesta de la pagina no Existe.');
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

    public function actionEmpleados()
    {
        $dataProvider=new CActiveDataProvider('Empleado',
            array('pagination'=>array(
                'pageSize'=>'20',
            ),));
        $this->render('index',array(
            'render'=>'list',
            'dataProvider'=>$dataProvider
        ));
    }

	public function actionIndex()
	{
		$this->render('index',array(
		    'render'=>'index'
		));
	}
	
	
	public function actionDates()
	{
		if(isset($_GET['id']))
		{
			$model = Users::model()->find('idEmpleado='.$_GET['id']);
			if(empty($model))
			{
				$model = new Users;
				$model->idEmpleado = $_GET['id'];
			}
			
			// uncomment the following code to enable ajax-based validation
			/*
			if(isset($_POST['ajax']) && $_POST['ajax']==='users-formDate-form')
			{
				echo CActiveForm::validate($model);
			    Yii::app()->end();
			}
			*/
			//print_r($model);
			$empleado = Empleado::model()->findByPk($model->idEmpleado);
			
			if(isset($_POST['Users']))
			{
				$model->attributes = $_POST['Users'];
				$model->password = $_POST['Users']['password'];
				if(!empty($model->idUser))
				{
					$userBpk = Users::model()->findByPk($model->idUser);
					//print_r($userBpk->password." ".$model->password);
					if($userBpk->password !== $model->password)
						$model->password = md5($model->password);
				}
				else 
				{
					$model->password = md5($model->password);
				}
				
				
				//$model->validate();
				if($model->save())
				{
					$this->redirect(array('index'));
				}
			}

			$this->render('index',array('render'=>'dates','model'=>$model,'empleado'=>$empleado));
		}
		else
			throw new CHttpException(400,'La Respuesta de la pagina no Existe.');
	}
		
	public function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='empleado-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
