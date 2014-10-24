<?php
class ConfigurationController extends Controller
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

    public function actionIndex()
    {
        $this->render('index',array('render'=>''));
    }
    public function actionSucursales()
    {
        //$sucursales = Sucursal::model()->findAll();
        $sucursales = new CActiveDataProvider('Sucursal');
        $this->render('index',array('render'=>'sucursal','sucursales'=>$sucursales));
    }

    public function actionSucursal()
    {
        $sucursal = new Sucursal;
        if(isset($_GET['id']))
        {
            $sucursal= Sucursal::model()->findByPk($_GET['id']);
        }
        if(isset($_POST['Sucursal']))
        {
            $sucursal->attributes = $_POST['Sucursal'];
            if($sucursal->validate() and !empty($sucursal->nombre))
            {
                if($sucursal->save())
                {
                    $this->redirect(array('configuration/sucursales'));
                }
            }
        }
        $this->renderPartial('forms/sucursal',array('model'=>$sucursal));
    }

    public function actionAlmacenes()
    {
        //$sucursales = Sucursal::model()->findAll();
        $almacenes = new CActiveDataProvider('Almacen');
        $this->render('index',array('render'=>'almacen','almacenes'=>$almacenes));
    }
    public function actionAlmacen()
    {
        $almacen = new Almacen;
        if(isset($_GET['id']))
        {
            $almacen= Almacen::model()->findByPk($_GET['id']);
        }
        if(isset($_POST['Almacen']))
        {
            $almacen->attributes = $_POST['Almacen'];
            if($almacen->validate() and !empty($almacen->nombre))
            {
                if($almacen->save())
                {
                    $this->redirect(array('configuration/almacenes'));
                }
            }
        }
        $this->renderPartial('forms/almacen',array('model'=>$almacen));
    }
    public function actionCajas()
    {
        //$sucursales = Sucursal::model()->findAll();
        $cajas = new CActiveDataProvider('Caja');
        $this->render('index',array('render'=>'caja','cajas'=>$cajas));
    }

    public function actionCaja()
    {
        $caja = new Caja;
        if(isset($_GET['id']))
        {
            $caja= Caja::model()->findByPk($_GET['id']);
        }
        if(isset($_POST['Caja']))
        {
            $caja->attributes = $_POST['Caja'];
            if($caja->isNewRecord)
                $caja->saldo=0;
            if($caja->validate() and !empty($caja->nombre))
            {
                if($caja->save())
                {
                    $this->redirect(array('configuration/cajas'));
                }
            }
        }
        $this->renderPartial('forms/caja',array('model'=>$caja));
    }

    public function verifyModel($model)
    {
        if($model===null)
            throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
        return $model;
    }
}