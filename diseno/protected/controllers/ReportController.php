<?php

class ReportController extends CController
{
    protected $sucursal;
    protected $almacen;

    public function init()
    {
        $this->sucursal =  Yii::app()->user->getState('idSucursal');
        if(!empty($this->sucursal))
        {
            $this->almacen = Almacen::model()->find('idSucursal='.$this->sucursal.' and nombre like "CTP%"');
            if(!empty($this->almacen))
                $this->almacen = $this->almacen->idAlmacen;
            else
                throw new CHttpException(500,'Page not found.');
        }
        parent::init();
    }

    public function filters()
    {
        return array( 'accessControl' ); // perform access control for CRUD operations
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                //'actions'=>array('index'),
                'expression'=>'isset($user->role) && ($user->role==4)',
            ),
           array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'expression'=>'isset($user->role) && ($user->role<=2)',
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $this->render('index',array('render'=>''));
    }

    public function actionOrdenes()
    {

        $ordenes = new CTP('searchReport');
        $ordenes->unsetAttributes();
        $ordenes->idSucursal = $this->sucursal;
        if(isset($_GET['CTP']))
        {
            $ordenes->attributes = $_GET['CTP'];
        }
        $this->render('index',array('render'=>'ordenes','ordenes'=>$ordenes));
    }

    public function actionPlacas()
    {
        $placas = new DetalleCTP('searchPlacas');
        $placas->unsetAttributes();
        $placas->sucursal = $this->sucursal;
        if(isset($_GET['DetalleCTP']))
        {
            $placas->attributes = $_GET['DetalleCTP'];
        }
        $this->render('index',array('render'=>'placas','placas'=>$placas));
    }
}