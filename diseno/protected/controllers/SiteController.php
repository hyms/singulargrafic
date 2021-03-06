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
                'actions'=>array('index','logout','dates'),
                'users'=>array('@'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }
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
        //print_r(Yii::app()->user->getState('idSucursal'));
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
            {
                $this->redirect(Yii::app()->user->returnUrl);
            }
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
        //$this->redirect(array("index"));
    }

    public function actionDates()
    {
        if(isset($_GET['id']))
        {
            $model = User::model()->findByPk($_GET['id']);

            // uncomment the following code to enable ajax-based validation
            /*
            if(isset($_POST['ajax']) && $_POST['ajax']==='users-formDate-form')
            {
            echo CActiveForm::validate($model);
            Yii::app()->end();
            }
            */

            $empleado = Empleado::model()->findByPk($model->idEmpleado);

            if(isset($_POST['User']))
            {
                $model->attributes = $_POST['User'];
                $model->password = $_POST['User']['password'];
                if($model->idUser!=null)
                {
                    $userBpk = User::model()->findByPk($model->idUser);
                    if($userBpk->password != $model->password)
                        $model->password = md5($model->password);
                }
                else
                {
                    $model->password = md5($model->password);
                }

                if($model->save())
                    $this->redirect(array('index'));
            }
            $this->render('formDate',array('model'=>$model,'empleado'=>$empleado));
        }
        else
            throw new CHttpException(400,'La Respuesta de la pagina no Existe.');
    }
}