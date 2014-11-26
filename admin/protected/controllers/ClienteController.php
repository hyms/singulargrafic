<?php

class ClienteController extends Controller
{
    public function filters()
    {
        return array('accessControl'); // perform access control for CRUD operations
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'expression' => 'isset($user->role) && ($user->role==="1")',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionCreate()
    {
        $model = new Cliente;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Cliente'])) {
            $model->attributes = $_POST['Cliente'];
            $model->fechaRegistro = date("Y-m-d H:i:s");
            if (!empty($model->nitCi) && !empty($model->apellido)) {
                if ($model->save())
                    $this->redirect(array('index'));
            } else {
                if (empty($model->nitCi))
                    $model->addError('nitCi', 'Nit Ci no puede estar vacio');
                if (empty($model->apellido))
                    $model->addError('apellido', 'Apellido no puede estar vacio');
            }
        }

        $this->render('index', array(
            'render' => 'new',
            'model' => $model,
        ));
    }

    public function actionUpdate()
    {
        if ($_GET['id']) {
            $model = $this->verifyModel(Cliente::model()->findByPk($_GET['id']));

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Cliente'])) {
                $model->attributes = $_POST['Cliente'];
                if ($model->save())
                    $this->redirect(array('index'));
            }

            $this->render('index', array(
                'render' => 'update',
                'model' => $model,
            ));
        } else
            throw new CHttpException(400, 'La Respuesta de la pagina no Existe.');
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionClientes()
    {
        $dataProvider = new CActiveDataProvider('Cliente',
            array(
                'pagination' => array(
                    'pageSize' => '20',
                ),));
        $this->render('index', array(
            'render' => 'clientes',
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionIndex()
    {
        $this->render('index', array(
            'render' => 'index',
        ));
    }

    public function actionTipoCliente()
    {
        $model = new TiposClientes;

        // uncomment the following code to enable ajax-based validation
        /*
         if(isset($_POST['ajax']) && $_POST['ajax']==='tipos-clientes-tipoClientes-form')
         {
        echo CActiveForm::validate($model);
        Yii::app()->end();
        }
        */

        if (isset($_POST['TiposClientes'])) {
            $model->attributes = $_POST['TiposClientes'];
            if ($model->save()) {
                // form inputs are valid, do something here
                //return;
                $this->redirect(array('cliente/index'));
            }
        }
        $this->renderPartial('tipoClientes', array('model' => $model));
    }

    public function actionPreferencia()
    {
        $clientes = Cliente::model()->findAll(array('condition' => '`t`.idTiposClientes IS NOT NULL and `t`.idTiposClientes!=3', 'order' => 'apellido'));

        if (isset($_POST['Cliente'])) {
            foreach ($clientes as $key => &$cliente) {
                if (isset($_POST['Cliente'][$key + 1])) {
                    $cliente->attributes = $_POST['Cliente'][$key + 1];
                    $cliente->save();
                }
            }
        }

        $this->render('index', array('render' => 'preferencia', 'clientes' => $clientes));
    }

    public function actionReport()
    {
        $this->render('report', array('render' => ''));
    }

    public function actionCompradores()
    {
        $this->render('report', array('render' => 'compra'));
    }

    public function actionDeudores()
    {
        //$clientes = Cliente::model()->findAll();
        $clientes = new CActiveDataProvider('Cliente');
        $this->render('report', array('render' => 'deuda','clientes'=>$clientes));
    }

    public function verifyModel($model)
    {
        if ($model === null)
            throw new CHttpException(404, 'La Respuesta de la pagina no Existe.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cliente-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
