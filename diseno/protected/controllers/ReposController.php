<?php

class ReposController extends Controller
{

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
        $ordenes=new CActiveDataProvider('CTP',array(
            'criteria'=>array(
                'condition'=>'tipoCTP!=3 and estado=1',
            ),
            'pagination'=>array(
                'pageSize'=>'20',
            ),));
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
                $row = CTP::model()->find(array("condition"=>"tipoCTP=3",'order'=>'fechaOrden Desc'));
                if(empty($row))
                    $row=new CTP;
                $repos->numero = $row->numero +1;

                $repos->codigo = "CR-".$repos->numero;
                $repos->attributes=$_POST['CTP'];
                $repos->tipoCTP = 3;
                $repos->fechaOrden = date("Y-m-d H:i:s");
                $repos->idUserOT= Yii::app()->user->id;
                $repos->estado=1;
                $repos->idCTPParent=$ctp->idCTP;
                if($repos->responsable=="Otro")
                {
                    $otro=$_POST['respOtro'];
                    $repos->responsable = $otro;
                    $falla = new FallasCTP;
                    $falla->nombre = $otro;
                    $falla->fecha = date("Y-m-d H:i:s");
                    $falla->costoT=0;
                }
                $i=0;$c=0;
                foreach ($_POST['DetalleCTP'] as $item)
                {
                    array_push($detalle,new DetalleCTP);
                    $detalle[$i]->attributes=$item;
                    $almacen= AlmacenProducto::model()->with("idProducto0")->find('idProducto0.detalle="'.$detalle[$i]->formato.'"');
                    $detalle[$i]->idAlmacenProducto=$almacen->idAlmacenProducto;
                    $costo= MatrizPreciosCTP::model()->find('idTiposClientes=1 and idHorario=1 and idCantidad=1 and idAlmacenProducto='.$detalle[$i]->idAlmacenProducto);
                    $detalle[$i]->costo = $costo->precioSF;
                    if(!empty($falla))
                        $falla->costoT=$falla->costoT+($detalle[$i]->nroPlacas*$detalle[$i]->costo);
                    $detalle[$i]->costoTotal = $detalle[$i]->nroPlacas*$detalle[$i]->costo;
                    if($detalle[$i]->validate())
                        $c++;
                    $i++;
                }
                if(!empty($falla))
                    $repos->montoVenta=$falla->costoT;
                if($repos->validate() && ($c==$i) && !empty($repos->obs) && !empty($repos->responsable))
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
                    //print_r($detalle);
                    $this->redirect(array('orden/rep'));
                }
            }
            $this->render('index',array('render'=>'repos','ctp'=>$ctp,'repos'=>$repos,'detalle'=>$detalle,'otro'=>$otro));
        }
        else
            throw new CHttpException(400,'Petición no válida.');
    }

    public function actionBuscar()
    {
        $ordenes=new CActiveDataProvider('CTP',array(
            'criteria'=>array(
                'condition'=>'estado=1 and tipoCTP=3',
                'with'=>array('idCliente0'),
                'order'=>'fechaOrden Desc',
            ),
            'pagination'=>array(
                'pageSize'=>'20',
            ),));
        $this->render('index',array('render'=>'buscarR','ordenes'=>$ordenes));
    }

    public function actionModificarR()
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
                //print_r($_POST['CTP']);
            }

            if(isset($_POST['DetalleCTP']))
            {
                $detalles = DetalleCTP::model()->findAll("idCTP=".$ctp->idCTP);
                if($ctp->estado==1)
                {
                    foreach ($detalles as $item)
                        $item->delete();
                }
                if($ctp->estado==2)
                {
                    foreach ($detalles as $item)
                    {
                        $almacenes = AlmacenProducto::model()->findByPk($item->idAlmacenProducto);
                        $almacenes->stockU = $almacenes->stockU + $item->nroPlacas;
                        if($almacenes->save())
                            $item->delete();
                    }
                }
                $detalle = array();$i=0;
                foreach ($_POST['DetalleCTP'] as $item)
                {
                    array_push($detalle,New DetalleCTP);
                    $detalle[$i]->attributes=$item;
                    $almacen= AlmacenProducto::model()->with("idProducto0")->find('idProducto0.detalle="'.$detalle[$i]->formato.'"');
                    $detalle[$i]->idAlmacenProducto=$almacen->idAlmacenProducto;
                    $detalle[$i]->idCTP=$ctp->idCTP;
                    $detalle[$i]->save();
                    $i++;
                }
                $sw=1;
                //print_r($_POST['DetalleCTP']);
            }
            if($sw==1)
                $ctp = $this->verifyModel(CTP::model()->with('idCliente0')->with('detalleCTPs')->findByPk($_GET['id']));

            if($ctp->tipoCTP==3)
            {
                $ctpB = CTP::model()->with('idCliente0')->with('detalleCTPs')->findByPk($ctp->idCTPParent);
                $this->render('index',array('render'=>'repos','ctp'=>$ctpB,'repos'=>$ctp,'detalle'=>$ctp->detalleCTPs,'otro'=>""));
            }
            //print_r($ctp);
        }
        else
            throw new CHttpException(400,'Petición no válida.');
        //$this->redirect(array('orden/buscar'));
    }
}