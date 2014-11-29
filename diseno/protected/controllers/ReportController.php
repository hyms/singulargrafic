<?php

class ReportController extends CController
{
    protected $sucursal;
    protected $almacen;

    public function init()
    {
        $this->sucursal = Yii::app()->user->getState('idSucursal');
        if (!empty($this->sucursal)) {
            $this->almacen = Almacen::model()->find('idSucursal=' . $this->sucursal . ' and nombre like "CTP%"');
            if (!empty($this->almacen))
                $this->almacen = $this->almacen->idAlmacen;
            else
                throw new CHttpException(500, 'Page not found.');
        }
        parent::init();
    }

    public function filters()
    {
        return array('accessControl'); // perform access control for CRUD operations
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                //'actions'=>array('index'),
                'expression' => 'isset($user->role) && ($user->role==4)',
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'expression' => 'isset($user->role) && ($user->role<=2)',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $this->render('index', array('render' => ''));
    }

    public function actionOrdenes()
    {

        $ordenes = new CTP('searchReport');
        $ordenes->unsetAttributes();
        $ordenes->idSucursal = $this->sucursal;
        if (isset($_GET['CTP'])) {
            $ordenes->attributes = $_GET['CTP'];
            $ordenes->apellido = $_GET['CTP']['apellido'];
            $ordenes->diseno = $_GET['CTP']['diseno'];
        }
        $this->render('index', array('render' => 'ordenes', 'ordenes' => $ordenes));
    }

    public function actionPlacas()
    {
        $placas = new DetalleCTP('searchPlacas');
        $placas->unsetAttributes();
        $placas->sucursal = $this->sucursal;
        if (isset($_GET['DetalleCTP'])) {
            $placas->attributes = $_GET['DetalleCTP'];
            $placas->cliente = $_GET['DetalleCTP']['cliente'];
            $placas->fecha = $_GET['DetalleCTP']['fecha'];
        }
        $this->render('index', array('render' => 'placas', 'placas' => $placas));
    }

    public function actionDeuda()
    {
        $deudas = new FallasCTP('search');
        $deudas->unsetAttributes();
        $idEmpleado = User::model()->findByPk(Yii::app()->user->id);
        $deudas->idEmpleado = $idEmpleado->idEmpleado;
        if (isset($_GET['FallasCTP'])) {
            $deudas->attributes = $_GET['FallasCTP'];
            $deudas->codigo = $_GET['FallasCTP']['codigo'];
        }
        $this->render('index', array('render' => 'deudas', 'deudas' => $deudas));
    }

    public function actionOrden()
    {
        if (isset($_GET['id'])) {
            $ctp = CTP::model()
                ->with('idCliente0')
                ->with('idUserOT0')
                ->with('idUserOT0.idEmpleado0')
                ->with('idUserVenta0')
                //->with('idUserVenta0.idEmpleado0')
                ->with('detalleCTPs')
                ->findByPk($_GET['id']);
            if ($ctp->tipoCTP == 1) {
                $this->renderPartial('prints/preview', array('render' => 'preview', 'ctp' => $ctp, 'tipo' => ''));
            }
            if ($ctp->tipoCTP == 2) {
                $ctpP = CTP::model()
                    ->with('idCliente0')
                    ->with('idUserOT0')
                    ->with('idUserOT0.idEmpleado0')
                    ->findByPk($ctp->idCTPParent);
                $this->renderPartial('v', array('render' => 'previewTI', 'ctp' => $ctp, 'tipo' => '', 'titulo' => 'Interna'));
            }
            if ($ctp->tipoCTP == 3) {
                $ctpP = CTP::model()
                    ->with('idCliente0')
                    ->with('idUserVenta0')
                    ->with('idUserVenta0.idEmpleado0')
                    ->findByPk($ctp->idCTPParent);
                $ctp->idCliente0 = $ctpP->idCliente0;
                $ctp->idUserVenta0 = $ctpP->idUserVenta0;

                if ($ctp->montoVenta > 0)
                    $this->renderPartial('prints/preview', array('render' => 'preview', 'ctp' => $ctp, 'tipo' => 'Reposición'));
                else
                    $this->renderPartial('prints/preview', array('render' => 'previewSC', 'ctp' => $ctp, 'tipo' => '1', 'titulo' => 'Reposición'));
            }
        } else
            throw new CHttpException(400, 'Petición no válida.');
    }
}