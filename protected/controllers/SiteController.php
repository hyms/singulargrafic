<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$banner = Banner::model()->findAll(array('order'=>'`order` ASC'));
		$this->render('index',array('model'=>$banner));
	}

	public function actionImprenta()
	{
		//$page = new Pages();
		$imprenta = Pages::model()->find("nombre='imprenta'");
		//print_r($imprenta);
		$this->render('pages',array('model'=>$imprenta));
	}
	
	public function actionCtp()
	{
		//$page = new Pages();
		$imprenta = Pages::model()->find("nombre='ctp'");
		//print_r($imprenta);
		$this->render('pages',array('model'=>$imprenta));
	}
	
	public function actionEditorial()
	{
		//$page = new Pages();
		$imprenta = Pages::model()->find("nombre='editorial'");
		//print_r($imprenta);
		$this->render('pages',array('model'=>$imprenta));
	}
	
	public function actionDistribuidora()
	{
		//$page = new Pages();
		$imprenta = Pages::model()->find("nombre='distribuidora'");
		//print_r($imprenta);
		$this->render('pages',array('model'=>$imprenta));
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$imprenta = Pages::model()->find("nombre='contacto'");
		$this->render('contact',array('model'=>$imprenta));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}