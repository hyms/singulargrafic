<?php

class SiteController extends Controller
{
	public function filters()
	{
		return array( 'accessControl' ); // perform access control for CRUD operations
	}
	
	public function accessRules() {
		return array(
				array('allow',
						'actions'=>array('login','error'),
						'users'=>array('*')
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'expression'=>'isset($user->role) && ($user->role==="1")',
				),
				array('deny',
						'users'=>array('*'),
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
		$this->render('index');
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
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout = 'loginLayout';
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
				$this->redirect(Yii::app()->homeUrl);
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
	
	public static function backupDb($filepath, $tables = '*') {
		if ($tables == '*') {
			$tables = array();
			$tables = Yii::app()->db->schema->getTableNames();
		} else {
			$tables = is_array($tables) ? $tables : explode(',', $tables);
		}
		$return = '';
	
		foreach ($tables as $table) {
			$result = Yii::app()->db->createCommand('SELECT * FROM ' . $table)->query();
			//$return.= 'DROP TABLE IF EXISTS ' . $table . ';';
			$row2 = Yii::app()->db->createCommand('SHOW CREATE TABLE ' . $table)->queryRow();
			$return.= "\n\n" . $row2['Create Table'] . ";\n\n";
			foreach ($result as $row) {
				$return.= 'INSERT INTO ' . $table . ' VALUES(';
				foreach ($row as $data) {
					$data = addslashes($data);
	
					// Updated to preg_replace to suit PHP5.3 +
					$data = preg_replace("/\n/", "\\n", $data);
					if (isset($data)) {
						$return.= '"' . $data . '"';
					} else {
						$return.= '""';
					}
					$return.= ',';
				}
				$return = substr($return, 0, strlen($return) - 1);
				$return.= ");\n";
			}
			$return.="\n\n\n";
		}
		//save file
		$handle = fopen($filepath, 'w+');
		fwrite($handle, $return);
		fclose($handle);
	}
}