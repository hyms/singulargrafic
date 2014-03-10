<?php

class WebpageController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	//controller
	function init(){
	  if(isset($_POST['SESSION_ID'])){
	    $session=Yii::app()->getSession();
	    $session->close();
	    $session->sessionID = $_POST['SESSION_ID'];
	    $session->open();
	  }
	}
	function actionUpload(){
	  if(isset($_POST['myPicture'])){
	    $myPicture=CUploadedFile::getInstanceByName('myPicture');
	    if(!$myPicture->saveAs('someFile.jpg'))
	      throw new CHttpException(500);
	    echo 1;
	    Yii::app()->end();
	  }
	}
	
	public function actionPages($id = NULL)
	{
		$pages = new Pages;
		$paginas = $pages->nombres();
		
		if($id != null)
			$pages=Pages::model()->findByPk($id);
		
		if(isset($_POST['Pages']))
		{
			
			
			$pages->nombre=$_POST['Pages']['nombre'];
			$pages->contenido=$_POST['contenido'];
			if($_POST['Pages']['enable'])
				$pages->enable=1;
			else
				$pages->enable=0;
			$pages->order=$_POST['Pages']['order'];
			$pages->fecha=date("Y-m-d H:i:s");
			
			if($pages->save())
			{
				$this->redirect(array('webpage/pages'));
			}
			else 
			{
				$this->render('pages',array('model'=>$pages, 'paginas'=>$paginas));
			}
		}
		else
		{
			$this->render('pages',array('model'=>$pages, 'paginas'=>$paginas));
		}
	} 
	
	public function actionBanner($id = NULL)
	{
		$dataProvider=new CActiveDataProvider('Banner');
		$this->render('banner/index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionBannerCreate()
	{
		$model=new Banner;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Banner']))
		{
			if(!empty($_FILES['Banner']['name']['imagen']))
			{
				$imagen = CUploadedFile::getInstance($model, 'imagen');
				$model->imagen = $imagen->getName();
				$imagen->saveAs('images/banner/'.$imagen);
				$imagen->saveAs('../images/'.$imagen);
			}
			else 
			{
				$model->imagen="";
			}
			$model->fecha = date("Y-m-d H:i:s");
			$model->order = $_POST['Banner']['order'];
			$model->texto = $_POST['texto'];
			
			if($model->save())
			{
				$this->redirect(array('webpage/banner'));
			}
			else 
			{
				$this->render('banner/create',array('model'=>$model));
			}
		}
		else
		{
			$this->render('banner/create',array('model'=>$model));
		}

	}
	
	public function actionBannerUpdate($id)
	{
		$model=Banner::model()->find($id);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Banner']))
		{	
			if(!empty($_FILES['Banner']['name']['imagen']))
			{
				$imagen = CUploadedFile::getInstance($model, 'imagen');
				$model->imagen = $imagen->getName();
				$imagen->saveAs('images/banner/'.$imagen);
				$imagen->saveAs('images/'.$imagen);
			}
			$model->fecha = date("Y-m-d H:i:s");
			$model->order = $_POST['Banner']['order'];
			$model->texto = $_POST['texto'];
			if($model->save())
			{
				$this->redirect(array('webpage/banner'));
			}
			else 
			{
				$this->render('banner/update',array('model'=>$model));
			}
		}
		else
		{
			$this->render('banner/update',array('model'=>$model));
		}
	}
	
	public function actions() {
		return array(
				'upload'=>'application.controllers.upload.UploadFileAction',
		);
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