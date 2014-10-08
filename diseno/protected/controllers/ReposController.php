<?php

class ReposController extends Controller
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
                'expression'=>'isset($user->role) && ($user->role===4)',
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

    public function actionRep()
    {
        /*$ordenes = new CActiveDataProvider('CTP',
                    array(
                        'criteria'=>array(
                            'condition'=>'tipoCTP!=3 and estado=1 and idSucursal='.$this->sucursal,
                        ),
                    ));*/
        $ordenes = new CTP('search');
        $ordenes->unsetAttributes();
        $ordenes->estado=1;
        $ordenes->idSucursal=$this->sucursal;

        if(isset($_GET['CTP']))
        {
            $ordenes->attributes = $_GET['CTP'];
            $ordenes->apellido = $_GET['CTP']['apellido'];
        }
        $this->render('index',array('render'=>'rep','ordenes'=>$ordenes));
    }

    public function actionRepOrden()
    {
        if(isset($_GET['id']))
        {
            $ctp = $this->verifyModel(CTP::model()->with('detalleCTPs')->findByPk($_GET['id']));
            $repos = new CTP;
            $detalle = array();
            $otro =""; $falla="";
            if(isset($_POST['CTP']) && isset($_POST['DetalleCTP']))
            {
                $row = CTP::model()->find(array("condition"=>"tipoCTP=3 and idSucursal=".$this->sucursal,'order'=>'fechaOrden Desc'));
                if(empty($row))
                    $row=new CTP;
                $repos->numero = $row->numero +1;

                $repos->codigo = "CR-".$repos->numero;
                $repos->attributes = $_POST['CTP'];
                $repos->tipoCTP = 3;
                $repos->fechaOrden = date("Y-m-d H:i:s");
                $repos->idUserOT = Yii::app()->user->id;
                $repos->estado = 1;
                $repos->idCTPParent = $ctp->idCTP;
                $repos->idSucursal = $this->sucursal;

                if($repos->responsable == "Otro")
                {
                    $otro = $_POST['respOtro'];
                    $repos->responsable = $otro;
                    $falla = new FallasCTP;
                    $falla->nombre = $otro;
                    $falla->fecha = date("Y-m-d H:i:s");
                    $falla->costoT = 0;
                }
                $c=count($_POST['DetalleCTP']);
                foreach ($_POST['DetalleCTP'] as $key => $item)
                {
                    $detalle[$key] = new DetalleCTP;
                    $detalle[$key]->attributes = $item;
                    $almacen = AlmacenProducto::model()->with("idProducto0")->find('idProducto0.detalle="'.$detalle[$key]->formato.'"');
                    $detalle[$key]->idAlmacenProducto = $almacen->idAlmacenProducto;
                    $costo = MatrizPreciosCTP::model()->find('idTiposClientes=1 and idHorario=1 and idCantidad=1 and idAlmacenProducto='.$detalle[$key]->idAlmacenProducto);
                    $detalle[$key]->costo = $costo->precioSF;
                    if(!empty($falla))
                        $falla->costoT = $falla->costoT+($detalle[$key]->nroPlacas*$detalle[$key]->costo);
                    $detalle[$key]->costoTotal = $detalle[$key]->nroPlacas*$detalle[$key]->costo;
                    if($detalle[$key]->validate())
                        $c--;
                }
                if(!empty($falla))
                    $repos->montoVenta = $falla->costoT;
                if($repos->validate() && ($c==0) && !empty($repos->obs) && !empty($repos->responsable))
                {
                    $repos->save();
                    foreach ($detalle as $item)
                    {
                        $item->idCTP=$repos->idCTP;
                        if(!empty($falla))
                            $falla->idCtpRep = $repos->idCTP;
                        $item->save();
                    }
                    if(!empty($falla))
                        $falla->save();
                    $this->redirect(array('repos/rep'));
                }
            }
            $this->render('index',array('render'=>'repos','ctp'=>$ctp,'repos'=>$repos,'detalle'=>$detalle,'otro'=>$otro));
        }
        else
            throw new CHttpException(400,'Petición no válida.');
    }

    public function actionBuscar()
    {
        /*$ordenes=new CActiveDataProvider('CTP',array(
            'criteria'=>array(
                'condition'=>'`t`.estado=1 and `t`.tipoCTP=3',
                'with'=>array('idCliente0','idCTPParent0'),
                'order'=>'`t`.fechaOrden Desc',
            ),
            'pagination'=>array(
                'pageSize'=>'20',
            ),));*/
        $ordenes = new CTP('search');
        $ordenes->unsetAttributes();
        $ordenes->estado=1;
        $ordenes->tipoCTP=3;
        $ordenes->idSucursal=$this->sucursal;

        if(isset($_GET['CTP']))
        {
            $ordenes->attributes = $_GET['CTP'];
            $ordenes->apellido = $_GET['CTP']['apellido'];
            $ordenes->codigoP = $_GET['CTP']['codigoP'];
        }
        $this->render('index',array('render'=>'buscar','ordenes'=>$ordenes));
    }

    public function actionModificar()
    {
        if(isset($_GET['id']))
        {
            $ctp = $this->verifyModel(CTP::model()->with('idCliente0')->with('detalleCTPs')->findByPk($_GET['id']));
            $sw=0;

            if(isset($_POST['CTP']))
            {
                $orden = CTP::model()->findByPk($ctp->idCTP);
                $orden->attributes = $_POST['CTP'];

                $user = Users::model()->with('idEmpleado0')->findByPk(Yii::app()->user->id);
                $orden->obs = "Modificado por el usuario ".$user->username." (".$user->idEmpleado0->nombre." ".$user->idEmpleado0->apellido.")";

                if($orden->save())
                    $sw=1;
            }

            if(isset($_POST['DetalleCTP']))
            {
                $detalle = array(); $d=count($_POST['DetalleCTP']);
                foreach ($_POST['DetalleCTP'] as $key=>$item)
                {
                    $detalle[$key] = New DetalleCTP;
                    $detalle[$key]->attributes=$item;
                    $almacen= AlmacenProducto::model()->with("idProducto0")->find('idProducto0.detalle="'.$detalle[$key]->formato.'"');
                    $detalle[$key]->idAlmacenProducto=$almacen->idAlmacenProducto;
                    $detalle[$key]->idCTP=$ctp->idCTP;
                    if($detalle[$key]->validate())
                        $d--;
                }
                if($d==0)
                {
                    $detalles = DetalleCTP::model()->findAll("idCTP=".$ctp->idCTP);
                    if($ctp->estado==1)
                    {
                        foreach ($detalles as $item)
                            $item->delete();
                    }
                    if($ctp->estado==0)
                    {
                        foreach ($detalles as $item)
                        {
                            $almacenes = AlmacenProducto::model()->findByPk($item->idAlmacenProducto);
                            $almacenes->stockU = $almacenes->stockU + $item->nroPlacas;
                            if($almacenes->save())
                                $item->delete();
                        }
                    }
                    if($sw==1){
                        $orden->save();
                        foreach($detalle as $item)
                            $item->save();
                        $this->redirect(array('buscar'));
                    }
                }
            }
            if($sw==1)
                $ctp = $this->verifyModel(CTP::model()->with('idCliente0')->with('detalleCTPs')->findByPk($_GET['id']));

            if($ctp->tipoCTP==3)
            {
                $ctpB = CTP::model()->with('idCliente0')->with('detalleCTPs')->findByPk($ctp->idCTPParent);
                $this->render('index',array('render'=>'repos','ctp'=>$ctpB,'repos'=>$ctp,'detalle'=>$ctp->detalleCTPs,'otro'=>""));
            }
        }
        else
            throw new CHttpException(400,'Petición no válida.');
    }

    public function actionAddDetalle()
    {
        if(Yii::app()->request->isAjaxRequest && isset($_GET['index']) && isset($_GET['id']))
        //if(isset($_GET['index']) && isset($_GET['id']))
        {
            $detalle = DetalleCTP::model()->findByPk($_GET['id']);
            /*$costo= MatrizPreciosCTP::model()->find('idTiposClientes=1 and idHorario=1 and idCantidad=1 and idAlmacenProducto='.$detalle->idAlmacenProducto);
            $detalle->costo = $costo->precioSF;
            */
            $this->renderPartial('forms/_newRowDetalleRepos', array(
                'model'=>$detalle,
                'index'=>$_GET['index'],
            ));
        }
        else
            throw new CHttpException(400,'Petición no válida.');
    }

    private function verifyModel($model)
    {
        if($model===null or empty($model))
            throw new CHttpException(404,'La Respuesta de la pagina no Existe.');

        return $model;
    }
}