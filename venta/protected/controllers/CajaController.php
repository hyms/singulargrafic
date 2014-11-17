<?php

class CajaController extends Controller
{

    /*/protected $cajaCTP=3;
    protected $cajaCTP;
    protected $sucursal;
    protected $almacen;

    public function init()
    {
        $this->sucursal =  Yii::app()->user->getState('idSucursal');
        if(!empty($this->sucursal))
        {
            $this->almacen = Almacen::model()->find('idSucursal='.$this->sucursal.' and nombre like "CTP%"');
            $this->cajaCTP = Caja::model()->find('idSucursal='.$this->sucursal.' and nombre like "CTP%"');
            if(!empty($this->almacen) && !empty($this->cajaCTP))
            {
                $this->almacen = $this->almacen->idAlmacen;
                $this->cajaCTP = $this->cajaCTP->idCaja;
            }
            else
                throw new CHttpException(500,'Page not found.');
        }
        parent::init();
    }*/

    public function filters()
    {
        return array( 'accessControl' ); // perform access control for CRUD operations
    }

    public function accessRules() {
        return array(
            /*array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    //'actions'=>array('index'),
                    'expression'=>'isset($user->role) && ($user->role==="3")',
            ),*/
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'expression'=>'isset($user->role) && ($user->role<=3)',
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        /*$vd = false;
        $ld = false;
        $ce = false;
        $sf = 0;
        $tabla="";
        $caja="";

        if(isset($_GET['ld']))
        {
            $date = date("Y-m")."-".$_GET['ld'];
            $caja = CajaVenta::model()	->with('reciboses')
                                        ->with('movimientoCajas')
                                        ->with('ventas')
                                        ->find(array('condition'=>'`t`.idCaja=2 and fechaArqueo is NULL'));
            if(!empty($caja))
                $tabla = $caja->ventas;
            $ld=true;
        }
        if(isset($_GET['ce']) && !empty($_GET['ce']))
        {
            $caja = MovimientoCaja::model()->with('idCaja0')->with('idUser0')->with('idUser0.idEmpleado0')->find(array('condition'=>'`t`.idCaja='.$_GET['ce'],'order'=>'fechaMovimiento DESC'));
            $ce=true;
            //print_r($caja);
        }
        if(isset($_GET['ar']) && !empty($_GET['ar']))
        {
            $caja = CajaVenta::model()->with('movimientoCajas')->with('reciboses')->with('ventas')->find(array('condition'=>'`t`.idCajaVenta='.$_GET['ar'].' and (`ventas`.estado=1 or `ventas`.estado=2)'));
            if(!empty($caja))
                $tabla = $caja->ventas;
            $ld=true;
        }*/
        $tabla = CajaChicaMovimiento::model()
            ->with('idcajaChica0')
            ->with('idcajaChica0.idUser0')
            ->findAll();
        $caja = CajaChica::model()->with('cajaChicaTipos')->with('cajaChicaTipos.idTipoMovimiento0')->find('idUser='.Yii::app()->user->id);
        $this->render("index",array('render'=>'','tabla'=>$tabla,'caja'=>$caja));
    }

    public function actionEgreso()
    {
        $egreso = new CajaChicaMovimiento;
        $egreso->fechaMovimiento=date("Y-m-d H:i:s");
        $egreso->tipoMovimiento=0;
        $caja = CajaChica::model()->with('idCaja0')->find('idUser='.Yii::app()->user->id);
        $egreso->idcajaChica = $caja->idcajaChica;
        if(isset($_POST['MovimientoCaja']))
        {
            $egreso->attributes=$_POST['MovimientoCaja'];
            if($egreso->validate())
            {
                $caja->saldo = $caja->saldo-$egreso->monto;
                if($caja->saldo>=0)
                {
                    if($egreso->save())
                        if($caja->save())
                            $this->redirect('index');
                }
                else
                {
                    $egreso->addError('monto','No existen suficientes fondos');
                }
            }
        }
        $this->render("egreso",array('model'=>$egreso));
    }

    public function actionIngreso()
    {
        $ingreso = new MovimientoCaja;
        $ingreso->fechaMovimiento = date("Y-m-d H:i:s");
        $ingreso->tipo = 1;
        $caja = $caja = CajaVenta::model()->find(array('condition'=>'`t`.idCaja=2 and fechaArqueo is NULL'));
        $ingreso->idCaja = $caja->idCajaVenta;
        if(isset($_POST['MovimientoCaja']))
        {
            $ingreso->attributes=$_POST['MovimientoCaja'];
            if($ingreso->validate())
            {
                $caja->saldo = $caja->saldo+$ingreso->monto;
                if($ingreso->save())
                    if($caja->save())
                        $this->redirect(array('index'));
            }
        }
        $this->render("ingreso",array('model'=>$ingreso));
    }

    public function actionArqueo()
    {
        $movimiento = new MovimientoCaja;
        $caja = CajaVenta::model()->find(array('condition'=>'`t`.idCaja=2 and fechaArqueo is NULL'));
        if(isset($_POST['MovimientoCaja']))
        {
            $movimiento->attributes = $_POST['MovimientoCaja'];
            $movimiento->motivo = "Traspaso de efectivo a Administracion";
            $comprovante = CajaVenta::model()->find(array('select'=>'max(comprobante) as max'));
            $caja->comprobante = $comprovante->max +1;
            $movimiento->fechaMovimiento = date("Y-m-d H:i:s");
            $comprovante = MovimientoCaja::model()->find(array('order'=>'fechaMovimiento Desc'));
            if(empty($comprovante))
                $comprovante=new MovimientoCaja;
            if(date("d",strtotime($movimiento->fechaMovimiento)) > date("d",strtotime($comprovante->fechaMovimiento)))
                $movimiento->fechaMovimiento = date("Y-m-d",strtotime($comprovante->fechaMovimiento))." 23:00:00";
            $movimiento->tipo = 0;
            $movimiento->idCaja = $caja->idCajaVenta;
            $movimiento->idUser = $caja->idUser;
            if($movimiento->validate())
            {
                $caja->saldo = $caja->saldo-$movimiento->monto;
                $caja->fechaArqueo=date("Y-m-d H:i:s");
                $caja->entregado=$movimiento->monto;
                if($movimiento->monto==0)
                {
                    $caja->comprobante="";
                    if($caja->save())
                    {
                        if($this->initCaja($caja->saldo))
                            $this->redirect(array('index','ar'=>$caja->idCajaVenta));
                    }
                }
                else
                {
                    if($movimiento->monto > 0)
                    {
                        if($movimiento->save())
                        {
                            if($caja->save())
                            {
                                if($this->initCaja($caja->saldo))
                                    $this->redirect(array('index','ar'=>$caja->idCajaVenta));
                            }
                        }
                    }
                    else
                    {
                        $movimiento->addError('monto',"El numero debe ser positivo");
                    }
                }
            }
        }

        $this->render("arqueo",array('movimiento'=>$movimiento,'caja'=>$caja));
    }

    public function actionReciboIngreso()
    {
        $cliente = new Cliente;
        $recibo = new Recibos;
        $cajaMovimiento = new CajaMovimientoVenta;
        if(isset($_GET['id']))
        {
            $recibo = $this->verifyModel(Recibos::model()->findByPk($_GET['id']));
            $cajaMovimiento = CajaMovimientoVenta::model()->findByPk($recibo->idCajaMovimientoVenta);
        }
        else
        {
            //$cajaMovimiento = $this->verifyModel(CajaMovimientoVenta::model()->find('idUser='.Yii::app()->user->id.''));
            $row = Recibos::model()->find(array("select"=>"count(*) as `max`",'condition'=>'tipoRecivo=1'));

            $recibo->fechaRegistro = date("Y-m-d h:m:s");
            $recibo->codigo = "I-".($row['max']+1);
            $recibo->tipoRecivo = 1;

        }
        if(isset($_POST['Recibos']))
        {
            $saldobkp="";
            if(!empty($recibo->acuenta))
                $saldobkp= $recibo->acuenta;

            $recibo->attributes = $_POST['Recibos'];
            $cliente->attributes = $_POST['Cliente'];
            $cliente = Cliente::model()->find("nitCi='".$cliente->nitCi."'");
            $recibo->idCliente = $cliente->idCliente;

            if($recibo->validate())
            {
                $cajaMovimiento->fechaMovimiento = date("Y-m-d H:i:s");
                $cajaMovimiento->monto = $recibo->monto;
                if($recibo->categoria=="Nota de Venta")
                    $cajaMovimiento->idCaja=2;
                if($recibo->categoria=="Orden de Trabajo")
                    $cajaMovimiento->idCaja=3;
                if($cajaMovimiento->save())
                {
                    $recibo->idCajaMovimientoVenta = $cajaMovimiento->idCajaMovimientoVenta;
                    $caja=Caja::model()->findByPk($cajaMovimiento->idCaja);
                    if($saldobkp!="")
                        $caja->saldo = $caja->saldo - $saldobkp;
                    $caja->saldo = $caja->saldo - $cajaMovimiento->monto;
                    $recibo->save();
                    if($caja->save())
                        $this->redirect(array('preview','id'=>$recibo->idRecibos));
                }
            }

        }

        //$this->render("reciboIngreso",array(
        $this->render("index",array(
            'render'=>'reciboIngreso',
            'cliente'=>$cliente,
            'recibo'=>$recibo,
        ));
    }

    public function actionReciboEgreso()
    {
        $cliente = new Cliente;
        $recibo="";$caja="";

        if(isset($_GET['id']))
        {
            $recibo = $this->verifyModel(Recibos::model()->findByPk($_GET['id']));
            $caja = CajaVenta::model()->findByPk($recibo->idCajaVenta);
        }
        else
        {
            $recibo = new Recibos;
            $caja = CajaVenta::model()->find('idUser='.Yii::app()->user->id.' and fechaArqueo is NULL');
            $row = Recibos::model()->find(array("select"=>"count(*) as `max`",'condition'=>'tipoRecivo=0'));

            $recibo->fechaRegistro=date("Y-m-d h:m:s");
            $recibo->codigo = "E-".($row['max']+1);
            $recibo->tipoRecivo=0;
            $recibo->responsable="Miriam Martinez";

            $recibo->idCaja = $caja->idCajaVenta;
        }

        if(isset($_POST['Recibos']))
        {
            $saldobkp="";
            if(!empty($recibo->acuenta))
                $saldobkp= $recibo->acuenta;
            $recibo->attributes=$_POST['Recibos'];
            if($recibo->validate())
            {
                if(!empty($recibo->idRecibos))
                    $caja->saldo = $caja->saldo + $saldobkp;

                $caja->saldo = $caja->saldo-$recibo->acuenta;
                if($caja->saldo>=0)
                {
                    if($recibo->save())
                        if($caja->save())
                            $this->redirect(array('preview','id'=>$recibo->idRecibos));
                }
                else
                {
                    $recibo->addError('acuenta','No existen suficientes fondos');
                }
            }
        }
        $this->render("reciboEgreso",array(
            'cliente'=>$cliente,
            'recibo'=>$recibo,

        ));
    }

    public function actionBuscar()
    {
        $recibos = new Recibos('search');

        $recibos->unsetAttributes();
        if (!isset($_GET["t"])) {
            $recibos->tipoRecivo = 1;
        } else {
            $recibos->tipoRecivo = $_GET["t"];
        }

        if (isset($_GET['Recibos'])) {
            $recibos->attributes = $_GET['Recibos'];
        }

        //$this->render("buscar", array('recibos' => $recibos));
        $this->render('index', array('render'=>'buscar','recibos' => $recibos));
    }

    public function actionDeuda()
    {
        if (isset($_GET['id']) && isset($_GET['serv'])) {
            $cliente = new Cliente;
            $recibo = new Recibos;
            $venta = "";
            if ($_GET['serv'] == "nv") {
                $venta = $this->verifyModel(Venta::model()->with('idCliente0')
                    ->with('idCajaMovimientoVenta0')
                    ->with("detalleVentas")
                    ->with("detalleVentas.idAlmacenProducto0")
                    ->with("detalleVentas.idAlmacenProducto0.idProducto0")
                    ->findByPk($_GET['id']));
                $recibo->categoria = "Nota de Venta";
                $i = 0;
                $recibo->concepto = "";
                foreach ($venta->detalleVentas as $producto) {
                    if ($i > 0) {
                        $recibo->concepto = $recibo->concepto . ", ";
                    }
                    $recibo->concepto = $recibo->concepto . $producto->idAlmacenProducto0->idProducto0->material . " " . $producto->idAlmacenProducto0->idProducto0->color . " " . $producto->idAlmacenProducto0->idProducto0->detalle . " " . $producto->idAlmacenProducto0->idProducto0->marca;
                    $i++;
                }
            } elseif ($_GET['serv'] == "ot") {
                $venta = $this->verifyModel(CTP::model()->with('idCliente0')
                    ->with('idCajaMovimientoVenta0')
                    ->with("detalleCTPs")
                    ->with("detalleCTPs.idAlmacenProducto0")
                    ->with("detalleCTPs.idAlmacenProducto0.idProducto0")
                    ->findByPk($_GET['id']));
                $recibo->categoria = "Orden de Trabajo";
                $i = 0;
                $recibo->concepto = "";
                foreach ($venta->detalleCTPs as $producto) {
                    if ($i > 0) {
                        $recibo->concepto = $recibo->concepto . ", ";
                    }
                    $recibo->concepto = $recibo->concepto . $producto->formato . " (" . $producto->nroPlacas . ") - " . $producto->trabajo;
                    $i++;
                }
            }
            ///$venta = Venta::model()->findByPk($_GET['id']);

            $cliente = $venta->idCliente0;
            $caja = $this->verifyModel(CajaMovimientoVenta::model()->findByPk($venta->idCajaMovimientoVenta0->idCajaMovimientoVenta));
            $row = Recibos::model()->find(array("select" => "count(*) as `max`", 'condition' => 'tipoRecivo=1'));
            $recibo->fechaRegistro = date("Y-m-d h:m:s");
            $recibo->codigo = "I-" . ($row['max'] + 1);
            $recibo->tipoRecivo = 1;
            $recibo->codigoNumero = $venta->codigo;
            $recibo->saldo = $venta->montoVenta - $venta->montoPagado;
            $recibo->acuenta = $venta->montoPagado;
            $recibo->idCliente = $cliente->idCliente;

            if (isset($_POST['Recibos'])) {
                $recibo->attributes = $_POST['Recibos'];
                $cliente->attributes = $_POST['Cliente'];


                if ($recibo->validate()) {
                    $cajaMovimiento = new CajaMovimientoVenta;
                    //Yii::app()->user->id;
                    $cajaMovimiento->idUser = Yii::app()->user->id;
                    $cajaMovimiento->motivo = "Recibo de Ingreso";
                    $cajaMovimiento->idCaja = $caja->idCaja;
                    $cajaMovimiento->arqueo = 0;
                    $cajaMovimiento->tipo = 0;
                    $cajaMovimiento->monto = $recibo->monto;
                    $cajaMovimiento->fechaMovimiento = date("Y-m-d H:i:s");
                    $cajaMovimiento->arqueo = 0;

                    $venta->montoPagado = $venta->montoPagado + $recibo->monto;

                    if (($venta->montoVenta - $venta->montoPagado) >= 0) {
                        $recibo->saldo = $venta->montoVenta - $venta->montoPagado;
                    } else {
                        $recibo->saldo = 0;
                    }
                    $venta->montoCambio = $venta->montoVenta - $venta->montoPagado;
                    $cajaVenta = Caja::model()->findByPk($caja->idCaja);
                    $cajaVenta->saldo = $cajaVenta->saldo + $caja->monto;
                    $cajaVenta->save();

                    if ($cajaMovimiento->save()) {
                        $recibo->idCajaMovimientoVenta = $caja->idCajaMovimientoVenta;
                        if ($recibo->save()) {
                            if ($venta->montoPagado >= $venta->montoVenta)
                                $venta->estado = 0;
                            $venta->save();
                            $this->redirect(array('preview', 'id' => $recibo->idRecibos));
                        }
                    }
                }
            }
            $this->render("index", array('render' => 'deuda', 'cliente' => $cliente, 'recibo' => $recibo, ));
            /*$this->render("reciboIngreso",array(
                'cliente'=>$cliente,
                'recibo'=>$recibo,
            ));*/
        } else
            throw new CHttpException(400, 'Petición no válida.');
    }

    public function actionChica()
    {
        $t=0;
        if(isset($_GET['t']))
        {
            $t=$_GET['t'];
        }
        if($t==0)
        {
            $this->actionEgreso();
        }
        else
        {
            $this->actionIngreso();
        }
    }

    public function actionPreview()
    {
        if(isset($_GET['id']))
        {
            $recibo = Recibos::model()
                ->with("idCliente0")
                ->findByPk($_GET['id']);

            if($recibo!=null)
                $this->render('index',array('render'=>'preview','recibo'=>$recibo));
            else
                $this->redirect(array('index'));
        }
        else
            throw new CHttpException(400,'Petición no válida.');
    }

    public function actionEnvio()
    {
        $productos = new AlmacenProducto('searchDistribuidora');
        $envio = new EnvioMaterial;
        $detalle = array();

        if(isset($_GET['id']))
        {
            $envio = EnvioMaterial::model()->with('detalleEnvios')->findByPk($_GET['id']);
            $detalle = $envio->detalleEnvios;
        }

        //init filter
        $productos->unsetAttributes();
        if (isset($_GET['AlmacenProducto'])){
            $productos->attributes = $_GET['AlmacenProducto'];
            $productos->color = $_GET['AlmacenProducto']['color'];
            $productos->material = $_GET['AlmacenProducto']['material'];
            $productos->marca = $_GET['AlmacenProducto']['marca'];
            $productos->paquete = $_GET['AlmacenProducto']['paquete'];
            $productos->detalle = $_GET['AlmacenProducto']['detalle'];
            $productos->codigo = $_GET['AlmacenProducto']['codigo'];
        }
        //end filter
        $se=false;
        if(isset($_POST['EnvioMaterial']))
        {
            $envio->attributes = $_POST['EnvioMaterial'];
            $envio->fechaEnvio = date('Y-m-d H:i:s');
            $envio->idUser = Yii::app()->user->id;
            $se=$envio->validate();
        }
        $sd=1;
        if(isset($_POST['DetalleEnvio']))
        {
            $sd = count($_POST['DetalleEnvio']);

            foreach ($_POST['DetalleEnvio'] as $key => $item)
            {
                $detalle[$key] = new DetalleEnvio;
                $detalle[$key]->attributes=$item;
                if($detalle[$key]->validate() && ($detalle[$key]->cantidadP>0 || $detalle[$key]->cantidadU>0))
                    $sd--;
            }
        }
        if($se && $sd==0)
        {
            $envio->save();
            foreach ($detalle as $key => $item)
            {
                $item->idEnvioMaterial=$envio->idEnvioMaterial;
                if($item->save())
                {
                    $movimiento=new MovimientoAlmacen;
                    /*$movimiento->idProducto = $almacenes->idProducto0->idProducto;
                    $movimiento->idAlmacenDestino = 2;
                    //$movimiento[$i]->idAlmacenOrigen = 2;
                    //$idUser->idUser = Yii::app()->user->id;
                    $movimiento->fechaMovimiento = date("Y-m-d H:i:s");
                    $movimiento->cantidadU = $item->cantidadU;
                    $movimiento->cantidadP = $item->cantidadP;
                    $movimiento->obs = "Devolucion de Material";
                    $movimiento->save();*/
                }
            }//*/
            $this->redirect(array('caja/envios','envios'=>true));
        }
        else
            echo "Error";

        $this->render("envios",array("productos"=>$productos,'envio'=>$envio,'detalle'=>$detalle,'nuevo'=>true));
    }

    public function actionEnvios()
    {
        if(isset($_GET['nuevo']))
        {
            $this->actionEnvio();
        }
        elseif(isset($_GET['envios']))
        {
            $envios = new EnvioMaterial('search');
            $envios->unsetAttributes();
            if (isset($_GET['EnvioMaterial'])){
                $envios->attributes=$_GET['EnvioMaterial'];
            }
            $this->render("envios",array("envios"=>$envios,'realizado'=>true));
        }
        else
            $this->render("envios",array("envios"=>''));
    }

    public function actionAddDetalle()
    {
        //if(Yii::app()->request->isAjaxRequest && isset($_GET['index']))
        if(isset($_GET['index']))
        {
            $detalle = new DetalleEnvio;
            $almacen = new AlmacenProducto;
            if(isset($_GET['al']))
            {
                $almacen = AlmacenProducto::model()
                    ->with("idProducto0")
                    ->findByPk($_GET['al']);

            }

            $detalle->idAlmacenProducto = $almacen->idAlmacenProducto;
            $this->renderPartial('envios/_newRowDetalleEnvio', array(
                'model'=>$detalle,
                'index'=>$_GET['index'],
                'almacen'=>$almacen,
            ));
        }
        else
            throw new CHttpException(400,'Petición no válida.');
    }

    private function initCaja($saldo)
    {
        $caja = new CajaVenta;
        $caja->saldo = $saldo;
        $caja->idCaja=2;
        $caja->idUser=Yii::app()->user->id;
        return $caja->save();
    }

    private function verifyModel($model)
    {
        if($model===null)
            throw new CHttpException(404,'La Respuesta de la pagina no Existe.');

        return $model;
    }
}