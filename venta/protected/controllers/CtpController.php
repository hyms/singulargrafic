<?php
class CtpController extends Controller
{
    //protected $cajaCTP=3;
    protected $cajaCTP;
    protected $sucursal;
    protected $almacen;

    public function init()
    {
        $this->sucursal = Yii::app()->user->getState('idSucursal');
        if (!empty($this->sucursal)) {
            $this->almacen = Almacen::model()->find('idSucursal=' . $this->sucursal . ' and nombre like "CTP%"');
            $this->cajaCTP = Caja::model()->find('idSucursal=' . $this->sucursal . ' and nombre like "CTP%"');
            if (!empty($this->almacen) && !empty($this->cajaCTP)) {
                $this->almacen = $this->almacen->idAlmacen;
                $this->cajaCTP = $this->cajaCTP->idCaja;
            } else
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
                'expression' => 'isset($user->role) && ($user->role<=3)',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $clientes = new CActiveDataProvider('CTP',
            array('criteria' => array(
                'group' => '`t`.idCliente',
                'select' => 'count(*) as cantidad, `t`.`idCliente`',
                'condition' => 'idSucursal=' . $this->sucursal,
                'order' => 'cantidad Desc',
                'with' => array('idCliente0' => array('select' => 'nitCi, apellido')),
                'limit' => '5',
            ),
                'pagination' => false,));
        //$almacenes = AlmacenProducto::model()->with('idProducto0')->findAll('idAlmacen='.$_GET['almacen'].' and (stockP+(stockU/idProducto0.cantXPaquete))<=5');
        $agotarse = new CActiveDataProvider('AlmacenProducto',
            array('criteria' => array(
                'with' => array('idProducto0'),
                'condition' => 'idAlmacen=' . $this->almacen . ' and (stockP+(stockU/idProducto0.cantXPaquete))<=200',
                'order' => 'stockP and stockU Desc',
            ),
            ));
        $this->render('base', array('render' => '', 'clientes' => $clientes, 'agotarse' => $agotarse));
    }

    public function actionOrdenes()
    {
        $ordenes = new CTP('searchOrder');
        $ordenes->unsetAttributes();
        $ordenes->idSucursal = $this->sucursal;
        $ordenes->estado = 1;
        if (isset($_GET['CTP'])) {
            $ordenes->attributes = $_GET['CTP'];
            $ordenes->apellido = $_GET['CTP']['apellido'];
        }
        $this->render('base', array('render' => 'ordenes', 'ordenes' => $ordenes, 'estado' => ''));
    }

    public function actionOrden()
    {
        if (isset($_GET['id'])) {
            $ctp = $this->verifyModel(CTP::model()
                ->with('detalleCTPs')
                ->with('idCliente0')
                ->find('`t`.idCTP=' . $_GET['id']));
            $ctp->formaPago = 1;
            $ctp->tipoOrden = 1;
            $ctp->fechaOrden = date("Y-m-d H:i:s");
            $ctp = $this->getCodigo($ctp);
            $detalle = array();
            $total = 0;
            $horas = Horario::model()->findAll();
            $cantidades = CantidadCTP::model()->findAll();
            foreach ($ctp->detalleCTPs as $key => $item) {
                $detalle[$key] = $item;
                $condAlmacen = 'idAlmacenProducto=' . $item->idAlmacenProducto;
                $condCliente = 'idTiposClientes=' . $ctp->idCliente0->idTiposClientes;
                $condCantidad = "";
                foreach ($cantidades as $c) {
                    if ($c->Inicio <= $item->nroPlacas)
                        $condCantidad = " and idCantidad=" . $c->idCantidadCTP;
                    else
                        break;
                }
                $condHora = "";
                foreach ($horas as $h) {
                    if ($h->inicio <= date("H:m:s"))
                        $condHora = " and idHorario=" . $h->idHorario;
                    else
                        break;
                }
                $matriz = MatrizPreciosCTP::model()->find($condAlmacen . ' and ' . $condCliente . $condCantidad . $condHora);
                if ($ctp->tipoOrden == 0)
                    $detalle[$key]->costo = $matriz->precioCF;
                else
                    $detalle[$key]->costo = $matriz->precioSF;

                $detalle[$key]->costoTotal = ($detalle[$key]->costo * $detalle[$key]->nroPlacas) + $detalle[$key]->costoAdicional;
                $total = $total + $detalle[$key]->costoTotal;
            }
            $ctp->detalleCTPs = $detalle;
            $ctp->montoVenta = $total;

            if (isset($_POST['CTP'])) {
                $sw = 0;
                $ctp->attributes = $_POST['CTP'];
                $ctp->idUserVenta = Yii::app()->user->id;
                $ctp = $this->getCodigo($ctp);

                if ($ctp->formaPago == 1) {
                    if (empty($ctp->fechaPlazo)) {
                        $sw = 1;
                        $ctp->addError('fechaPlazo', 'Fecha Plazo no puede estar Vacio');
                    }
                    if ($ctp->autorizado == "") {
                        $sw = 1;
                        $ctp->addError('fechaPlazo', 'Debes seleccionar a un autorizado');
                        //print_r($ctp);
                    }
                }

                if ($sw == 0) {
                    if (!empty($ctp->fechaPlazo))
                        $ctp->fechaPlazo = date("Y-m-d H:i:s", strtotime($ctp->fechaPlazo));
                    $ctp->estado = 2;

                    //$ctp=$this->getCodigo($ctp);
                    $tmp = array();

                    $caja = $this->verifyModel(Caja::model()->findByPk($this->cajaCTP));
                    $cajaMovimiento = new CajaMovimientoVenta;
                    $cajaMovimiento->idUser = Yii::app()->user->id;
                    $cajaMovimiento->motivo = "Orden CTP";
                    $cajaMovimiento->idCaja = $caja->idCaja;
                    $cajaMovimiento->arqueo = 0;
                    $cajaMovimiento->tipo = 0;

                    if (isset($_POST['Cliente'])) {
                        $cliente = $this->saveCliente($_POST['Cliente']);
                        $cliente->validate();
                    }

                    foreach ($_POST['DetalleCTP'] as $key => $item) {
                        $tmp[$key] = DetalleCTP::model()->findByPk($ctp->detalleCTPs[$key]->idDetalleCTP);

                        $tmp[$key]->attributes = $item;
                        $tmp[$key]->save();
                    }
                    $ctp->detalleCTPs = $tmp;

                    $cajaMovimiento->fechaMovimiento = date("Y-m-d H:i:s");
                    $cajaMovimiento->tipo = 0;
                    if ($ctp->formaPago == 0) {
                        $cajaMovimiento->monto = $ctp->montoPagado - $ctp->montoCambio;
                    }
                    if ($ctp->formaPago == 1) {
                        $cajaMovimiento->monto = $ctp->montoPagado;
                    }
                    if ($cajaMovimiento->monto == $ctp->montoVenta)
                        $ctp->estado = 0;
                    elseif ($cajaMovimiento->monto > $ctp->montoVenta) {
                        $ctp->estado = 0;
                        $cajaMovimiento->monto = $ctp->montoVenta;
                    } else
                        $ctp->estado = 2;

                    if ($cliente->save() && $ctp->save()) {
                        $almacen = array();
                        foreach ($ctp->detalleCTPs as $key => $item) {
                            //$item->save();
                            $almacen[$key] = AlmacenProducto::model()->findByPk($item->idAlmacenProducto);
                            $almacen[$key]->stockU = $almacen[$key]->stockU - $item->nroPlacas;
                            if ($almacen[$key]->stockU >= 0) {
                                if (!$almacen[$key]->validate()) {
                                    $ctp->estado = 1;
                                    break;
                                }
                            } else {
                                $ctp->estado = 1;
                                break;
                            }
                        }
                        if ($ctp->estado != 1) {
                            if ($this->saveMovimientoAlmacen($ctp->detalleCTPs)) {
                                if ($cajaMovimiento->save()) {
                                    $caja->saldo = $caja->saldo + $cajaMovimiento->monto;
                                    $caja->save();
                                }

                                $ctp->idCajaMovimientoVenta = $cajaMovimiento->idCajaMovimientoVenta;
                                if ($ctp->save())
                                    $this->redirect(array('ctp/preview', 'id' => $ctp->idCTP));
                            } else {
                                $ctp->estado = 1;
                                $ctp->save();
                            }
                        } else
                            $ctp->save();

                    }
                }
            }
            $this->render('base', array('render' => 'orden', 'ctp' => $ctp, 'detalle' => $ctp->detalleCTPs, 'cliente' => $ctp->idCliente0));
        } else
            throw new CHttpException(400, 'Petición no válida.');
    }

    public function actionValidar()
    {
        if (isset($_GET['id'])) {
            $ctp = $this->verifyModel(CTP::model()
                ->with('detalleCTPs')
                ->with('idCliente0')
                ->find('`t`.idCTP=' . $_GET['id']));

            if ($this->saveMovimientoAlmacen($ctp->detalleCTPs)) {
                $ctp->estado = 0;
                $ctp->save();
                $this->redirect(array('ctp/buscar'));
            } else
                $this->redirect(array('ctp/orden', 'id' => $_GET['id']));
        } else
            throw new CHttpException(400, 'Petición no válida.');
    }

    public function actionModificar()
    {
        if (isset($_GET['id'])) {
            $ctp = $this->verifyModel(CTP::model()
                ->with('detalleCTPs')
                ->with('idCliente0')
                ->with('idCajaMovimientoVenta0')
                ->find('`t`.idCTP=' . $_GET['id']));
            $caja = Caja::model()->findByPk($this->cajaCTP);

            if (isset($_POST['CTP'])) {
                if ($ctp->idCajaMovimientoVenta0->arqueo < 1) {
                    $ctp->attributes = $_POST['CTP'];
                    $ctp = $this->getCodigo($ctp);
                    if ($ctp->montoPagado >= 0) {
                        if ($ctp->montoPagado < $ctp->montoVenta)
                            $ctp->estado = 2;
                        else
                            $ctp->estado = 0;

                        $caja->saldo = $caja->saldo - $ctp->idCajaMovimientoVenta0->monto;
                        $caja->saldo = $caja->saldo + $ctp->montoPagado;
                        $ctp->idCajaMovimientoVenta0->monto = $ctp->montoPagado;
                        $caja->save();
                        $ctp->save();
                        $this->redirect(array('ctp/preview', 'id' => $_GET['id']));
                    }
                } else {
                    if ($ctp->estado == 2) {
                        $ctp->attributes = $_POST['CTP'];
                        if (($ctp->montoPagado > 0) && ($ctp->montoPagado >= $ctp->idCajaMovimientoVenta0->monto)) {
                            $caja->monto = $caja->monto - $ctp->idCajaMovimientoVenta0->monto;
                            if (($caja->monto + $ctp->montoPagado) > 0) {
                                $caja->monto = $caja->monto + $ctp->montoPagado;
                                $ctp->idCajaMovimientoVenta0->monto = $ctp->montoPagado;
                                $caja->save();
                                $ctp->save();
                                $this->redirect(array('ctp/buscar'));
                            }
                        }
                    } else {
                        throw new CHttpException(400, 'Petición no válida.');
                    }
                }
            }
            $this->render('base', array('render' => 'orden', 'ctp' => $ctp, 'detalle' => $ctp->detalleCTPs, 'cliente' => $ctp->idCliente0));
        } else
            throw new CHttpException(400, 'Petición no válida.');
    }

    public function actionReturn()
    {
        if (isset($_GET['id'])) {
            $ctp = $this->verifyModel(CTP::model()
                ->with('detalleCTPs')
                ->with('idCliente0')
                ->with('idCajaMovimientoVenta0')
                ->findByPk($_GET['id']));
            if ($ctp->estado != 1) {
                $ctp->estado = 1;
                $almacen = array();
                foreach ($ctp->detalleCTPs as $key => $item) {
                    $almacen[$key] = AlmacenProducto::model()->findByPk($item->idAlmacenProducto);
                    $almacen[$key]->stockU = $almacen[$key]->stockU + $item->nroPlacas;
                }

                if (!empty($ctp->idCajaMovimientoVenta0)) {
                    $caja = Caja::model()->findByPk($this->cajaCTP);
                    $ctp->idCajaMovimientoVenta = null;
                    $tmp = $ctp->idCajaMovimientoVenta0;
                    if ($ctp->idCajaMovimientoVenta0->arqueo < 1) {
                        $caja->saldo = $caja->saldo - $tmp->monto;

                        $ctp->montoPagado = 0;
                        if ($ctp->save()) {
                            $tmp->delete();
                            foreach ($almacen as $item) {
                                $item->save();
                            }
                            $this->redirect(array('ctp/ordenes'));
                        }
                    }

                }
                if ($ctp->save()) {
                    foreach ($almacen as $item) {
                        $item->save();
                    }
                    $this->redirect(array('ctp/ordenes'));
                }

            }
        } else
            throw new CHttpException(400, 'Petición no válida.');
    }

    public function actionBuscar()
    {
        $ordenes = new CTP('searchOrder');
        $ordenes->unsetAttributes();
        $ordenes->idSucursal = $this->sucursal;
        //$ordenes->estado = 1;
        if (isset($_GET['CTP'])) {
            $ordenes->attributes = $_GET['CTP'];
            $ordenes->apellido = $_GET['CTP']['apellido'];
        }
        $this->render('base', array('render' => 'search', 'ordenes' => $ordenes, 'estado' => 1));
    }

    public function actionPreview()
    {
        //$this->layout ='print';
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
                $this->render('base', array('render' => 'preview', 'ctp' => $ctp, 'tipo' => ''));
            }
            if ($ctp->tipoCTP == 2) {
                /*$ctpP= CTP::model()
                    ->with('idCliente0')
                    ->with('idUserOT0')
                    ->with('idUserOT0.idEmpleado0')
                    ->findByPk($ctp->idCTPParent);*/
                //print_r($ctp);
                $this->render('base', array('render' => 'previewTI', 'ctp' => $ctp, 'tipo' => '1', 'titulo' => 'Interna'));
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
                    $this->render('base', array('render' => 'preview', 'ctp' => $ctp, 'tipo' => 'Reposición'));
                else
                    $this->render('base', array('render' => 'previewSC', 'ctp' => $ctp, 'tipo' => '1', 'titulo' => 'Reposición'));
            }
        } else
            throw new CHttpException(400, 'Petición no válida.');
    }

    public function actionDeudores()
    {
        $deudores = new CActiveDataProvider('CTP',
            array('criteria' => array(
                'condition' => 'estado=2 and idSucursal=' . $this->sucursal,
                'with' => array('idCliente0'),
                'order' => 'fechaPlazo ASC',
            ),
                'pagination' => array(
                    'pageSize' => 20,
                ),));
        $this->render('base', array('render' => 'deudores', 'deudores' => $deudores));

    }

    public function actionMovimientos()
    {
        if (isset($_GET['excel']) && isset(Yii::app()->session['excel'])) {
            $model = Yii::app()->session['excel'];
            $dataProvider = $model->searchCTP();
            $dataProvider->pagination = false; // for retrive all modules
            $data = $dataProvider->data;

            $columnsTitle = array('Nro', 'Nº de Venta', 'Apellido', 'NitCI', 'Monto de la Venta', 'Monto Pagado', 'Fecha');
            $content = array();
            $index = 1;
            foreach ($data as $item) {
                array_push($content, array($index,
                    $item->codigo,
                    $item->idCliente0->apellido,
                    $item->idCliente0->nitCi,
                    $item->montoVenta,
                    $item->montoPagado,
                    $item->fechaOrden,
                ));
                $index++;
            }
            $total = 0;
            foreach ($data as $item) {
                $dato = $item->montoPagado - $item->montoCambio;
                if ($dato > 0)
                    $total = $total + $dato;
            }
            array_push($content, array('', '', '', '', '', 'total', $total));
            $this->createExcel($columnsTitle, $content, 'Reporte de Ordenes ' . date('Ymd'));
        }

        $cond3 = "";
        $saldo = "";
        $cf = array("ctp/movimientos", 'f' => 0);
        $sf = array("ctp/movimientos", 'f' => 1);
        $ventas = new CTP('searchCTP');

        $ventas->unsetAttributes();
        $ventas->idSucursal=$this->sucursal;
        if (isset($_GET['f']))
            $ventas->tipoOrden = $_GET['f'];

        if (isset($_GET['d']) || isset($_GET['m'])) {
            $d = date("d");
            $m = date("m");
            $y = date("Y");

            if (isset($_GET['d'])) {
                $d = $_GET['d'];
                if ($d == 0) {
                    $m = $m - 1;
                    if ($m < 10 && $m > 0)
                        $m = "0" . $m;

                    $d = $this->getUltimoDiaMes($y, $m);
                }
                $ventas->fechaOrden = $y . "-" . $m . "-" . $d;
                $cf = array("ctp/movimientos", 'f' => 0, 'd' => $_GET['d']);
                $sf = array("ctp/movimientos", 'f' => 1, 'd' => $_GET['d']);
            }
            if (isset($_GET['m'])) {
                $m = $_GET['m'];
                $ventas->fechaOrden = $y . "-" . $m;
                $cf = array("ctp/movimientos", 'f' => 0, 'm' => $_GET['m']);
                $sf = array("ctp/movimientos", 'f' => 1, 'm' => $_GET['m']);
            }

            if (isset($_GET['Venta'])) {
                $ventas->attributes = $_GET['Venta'];

                if (isset($_GET['Venta']['apellido']))
                    $ventas->apellido = $_GET['Venta']['apellido'];
                if (isset($_GET['Venta']['nit']))
                    $ventas->nit = $_GET['Venta']['nit'];

            }
            if (isset($_GET['d'])) {
                $cond3 = array("ctp/previewDay", "f" => $ventas->tipoOrden, "date" => date("Y-m-d", strtotime($ventas->fechaOrden)));
            }
            if (isset($_GET['m']))
                $cond3 = array("ctp/previewDay", "f" => $ventas->tipoOrden, "m" => date("m", strtotime($ventas->fechaOrden)));
        }


        if (isset($_GET['d'])) {
            $saldo = CajaArqueo::model()->find(array('condition' => "idCaja=" . $this->cajaCTP . " and fechaVentas<'" . $ventas->fechaOrden . "'", 'order' => 'idCajaArqueo Desc'));
            //print_r($saldo);
            if (!empty($saldo))
                $saldo = $saldo->saldo;
        }

        //$this->render('movimientos',array('ventas'=>$ventas,'cond1'=>$cond1,'cond2'=>$cond2,'cond3'=>$cond3));
        $this->render('base', array('render' => 'movimientos', 'ventas' => $ventas, 'saldo' => $saldo, 'cond3' => $cond3, 'cf' => $cf, 'sf' => $sf));
    }

    public function actionPreviewDay()
    {
        if (isset($_GET['excel']) && isset(Yii::app()->session['excel'])) {
            $columnsTitle = array('Nº', 'Codigo Orden', 'Cliente', 'Cod. Prod.', 'Detalle del Producto', 'Cant', 'Precio', 'T/A', 'Total', 'Importe', 'Creditos', 'Fact');
            $content = array();
            $i = 0;
            $total = 0;
            $importe = 0;
            $creditos = 0;
            $adicional = 0;
            print_r(Yii::app()->session['excel']);
            foreach (Yii::app()->session['excel'] as $item) {
                $temp = count($item->detalleCTPs);
                foreach ($item->detalleCTPs as $producto) {
                    $i++;
                    $temp--;
                    array_push($content, array($i,
                        $item->codigo,
                        $item->idCliente0->apellido . " " . $item->idCliente0->nombre,
                        $producto->idAlmacenProducto0->idProducto0->codigo,
                        $producto->idAlmacenProducto0->idProducto0->material
                        . " " . $producto->idAlmacenProducto0->idProducto0->color
                        . " " . $producto->idAlmacenProducto0->idProducto0->detalle
                        . " " . $producto->idAlmacenProducto0->idProducto0->marca,
                        $producto->nroPlacas,
                        ($producto->nroPlacas * $producto->costo),
                        $producto->costoAdicional,
                        $producto->costoTotal,
                        ($item->estado == 1) ? (($temp == 0) ? ($item->montoPagado - $item->montoCambio) : 0) : (($item->estado == 2) ? (($temp == 0) ? $item->montoPagado : 0) : 0),
                        ($item->estado == 2) ? (($temp == 0) ? ($item->montoCambio * (-1)) : 0) : 0,
                        $item->factura
                    ));
                    $total = $total + $producto->costoTotal;
                    $adicional = $adicional + $producto->costoAdicional;
                    ($item->estado == 1) ? (($temp == 0) ? ($importe = $importe + ($item->montoPagado - $item->montoCambio)) : 0) : (($item->estado == 2) ? (($temp == 0) ? ($importe = $importe + $item->montoPagado) : 0) : 0);
                    ($item->estado == 2) ? (($temp == 0) ? ($creditos = $creditos + ($item->montoCambio * (-1))) : 0) : 0;
                }
            }
            array_push($content, array('', '', '', '', '', '', 'Totales', $adicional, $total, $importe, $creditos));
            $this->createExcel($columnsTitle, $content, 'Reporte de Ordenes ' . date('Ymd'));
        }
        $fact = "";
        $cond = "";
        if (isset($_GET['f'])) {
            if ($_GET['f'] != "") {
                if ($_GET['f'] == 0) {
                    $fact = " and tipoOrden=0";
                } else {
                    $fact = " and tipoOrden=1";
                }
            }
        }
        if (isset($_GET['d']) || isset($_GET['m'])) {
            $m = date("m");
            $y = date("Y");
            $start = date("Y-m-d") . " 00:00:00";
            $end = date("Y-m-d") . " 23:59:59";

            if (isset($_GET['d'])) {
                $d = $_GET['d'];
                if ($d == 0) {
                    $m--;
                    $d = $this->getUltimoDiaMes($y, $m);
                }
                $start = $y . "-" . $m . "-" . $d . " 00:00:00";
                $end = $y . "-" . $m . "-" . $d . " 23:59:59";
            }
            if (isset($_GET['m'])) {
                $m = $_GET['m'];
                $d = $this->getUltimoDiaMes($y, $m);
                $start = $y . "-" . $m . "-1 00:00:00";
                $end = $y . "-" . $m . "-" . $d . " 23:59:59";
            }
            $cond = " and '" . $start . "'<=fechaOrden AND fechaOrden<='" . $end . "'";
        }
        $caja = $this->verifyModel(CTP::model()
            ->with('idCliente0')
            ->with('detalleCTPs')
            ->with('detalleCTPs.idAlmacenProducto0')
            ->with('detalleCTPs.idAlmacenProducto0.idProducto0')
            ->with('idCajaMovimientoVenta0')
            ->findAll(array('condition' => 'idCajaMovimientoVenta0.idCaja=' . $this->cajaCTP . ' and idSucursal=' . $this->sucursal . ' ' . $fact . $cond)));//$tabla = $caja->ventas;
        ;
        $this->render("base", array('render' => "previewDay", 'tabla' => $caja,));
        //$this->render("base", array('render' => 'previewDay', 'tabla' => $caja,));
    }

    public function actionArqueo()
    {
        $arqueo = new CajaArqueo;
        $caja = Caja::model()->findByPk($this->cajaCTP);
        if (isset($_POST['CajaArqueo'])) {
            $arqueo->attributes = $_POST['CajaArqueo'];
            $arqueo->fechaArqueo = date("Y-m-d H:i:s");
            $arqueo->idUser = Yii::app()->user->id;
            $arqueo->idCaja = $this->cajaCTP;
            $end = $arqueo->fechaVentas . " 23:59:59";

            $movimiento = new CajaMovimientoVenta;
            $movimiento->motivo = "Traspaso de efectivo a Administracion";
            $comprovante = CajaArqueo::model()->find(array('select' => 'max(comprobante) as max', 'condition' => 'idCaja=' . $this->cajaCTP));
            $arqueo->comprobante = $comprovante->max + 1;
            $movimiento->fechaMovimiento = $arqueo->fechaVentas . " 23:59:59";

            $movimiento->tipo = 0;
            $movimiento->idCaja = $arqueo->idCaja;
            $movimiento->idUser = $arqueo->idUser;
            $movimiento->monto = $arqueo->monto;
            $movimiento->arqueo = 0;
            if ($movimiento->validate() && $arqueo->validate()) {
                $caja->saldo = $caja->saldo - $movimiento->monto;
                $ctps = 0;
                $recibos = 0;
                $cajaMovimiento = CajaMovimientoVenta::model()->with('cTPs')->with('reciboses')->findAll(array('condition' => "`t`.idCaja=" . $this->cajaCTP . " and tipo=0 and arqueo=0 and fechaMovimiento<='" . $end . "'"));
                foreach ($cajaMovimiento as $item) {
                    foreach ($item->cTPs as $venta) {
                        $tmp = CTP::model()->with('idCajaMovimientoVenta0')->findByPk($venta->idCTP);
                        $ctps = $ctps + $tmp->idCajaMovimientoVenta0->monto;
                    }
                    foreach ($item->reciboses as $venta) {
                        $tmp = Recibos::model()->with('idCajaMovimientoVenta0')->findByPk($venta->idRecibos);
                        $recibos = $recibos + $tmp->idCajaMovimientoVenta0->monto;
                    }
                }

                $saldo = CajaArqueo::model()->find(array('condition' => "idCaja=" . $this->cajaCTP, 'order' => 'idCajaArqueo Desc'));
                if (empty($saldo))
                    $saldo = 0;
                else
                    $saldo = $saldo->saldo;

                $arqueo->saldo = round($saldo + $ctps + $recibos - $movimiento->monto, 1, PHP_ROUND_HALF_UP);
                if ($caja->saldo >= 0 && $arqueo->saldo >= 0) {
                    if ($movimiento->monto >= 0) {
                        if ($movimiento->monto == 0) {
                            $movimiento->motivo = "Arqueo de Caja";
                            $arqueo->comprobante = "";
                        }
                        if ($arqueo->save() && $caja->save()) {
                            //$start=$arqueo->fechaVentas." 00:00:00";
                            $end = $arqueo->fechaVentas . " 23:59:59";
                            $movimiento->save();
                            $arqueo->idCajaMovimientoVenta = $movimiento->idCajaMovimientoVenta;
                            $arqueo->save();
                            $cajaMovimiento = CajaMovimientoVenta::model()->findAll(array('condition' => "`t`.idCaja=" . $this->cajaCTP . " and tipo=0 and arqueo=0 and fechaMovimiento<='" . $end . "'"));
                            foreach ($cajaMovimiento as $item) {
                                $item->arqueo = $arqueo->idCajaArqueo;
                                $item->save();
                            }
                            if ($movimiento->monto > 0) {
                                $cajaAdmin = Caja::model()->findByPk(1);
                                $cajaAdmin->saldo = $cajaAdmin->saldo + $movimiento->monto;
                                $cajaAdmin->save();
                            }
                            $this->redirect(array('distribuidora/comprobante', 'id' => $arqueo->idCajaArqueo));
                        }

                    } else {
                        $movimiento->addError('monto', "El numero debe ser positivo");
                        $this->redirect(array('ctp/arqueo'));
                    }
                }
            }
        }

        if (isset($_GET['d'])) {
            $d = $_GET['d'];
            $m = date("m");
            if ($d == 0) {
                $m--;
                $d = $this->getUltimoDiaMes(date("Y"), $m);
            }
            //$start=date("Y")."-".$m."-".$d." 00:00:00";
            $end = date("Y") . "-" . $m . "-" . $d . " 23:59:59";
            //$cajaMovimiento = CajaMovimientoVenta::model()->with('reciboses')->with('ventas')->findAll(array('condition'=>"`t`.idCaja=2 and arqueo=0 and '".$start."'<=fechaMovimiento AND fechaMovimiento<='".$end."'"));
            $cajaMovimiento = CajaMovimientoVenta::model()->with('reciboses')->with('cTPs')->findAll(array('condition' => "`t`.idCaja=" . $this->cajaCTP . " and tipo=0 and arqueo=0 and fechaMovimiento<='" . $end . "'", 'order' => 'fechaMovimiento Desc'));
            if (!empty($cajaMovimiento))
                $end = date('Y-m-d', strtotime($cajaMovimiento[0]->fechaMovimiento)) . " 23:59:59";
            $ctps = 0;
            $recibos = 0;
            foreach ($cajaMovimiento as $item) {
                foreach ($item->cTPs as $venta) {
                    $tmp = CTP::model()->with('idCajaMovimientoVenta0')->findByPk($venta->idCTP);
                    $ctps = $ctps + $tmp->idCajaMovimientoVenta0->monto;
                }
                foreach ($item->reciboses as $venta) {
                    $tmp = Recibos::model()->with('idCajaMovimientoVenta0')->findByPk($venta->idRecibos);
                    $recibos = $recibos + $tmp->idCajaMovimientoVenta0->monto;
                }
            }
            $saldo = CajaArqueo::model()->find(array('condition' => "idCaja=" . $this->cajaCTP, 'order' => 'idCajaArqueo Desc'));
            if (empty($saldo))
                $saldo = 0;
            else
                $saldo = $saldo->saldo;
            $this->render("base",
                array(
                    'render' => 'arqueo',
                    'saldo' => $saldo,
                    'arqueo' => $arqueo,
                    'caja' => $caja,
                    'fecha' => date('Y-m-d', strtotime($end)),
                    'ventas' => $ctps,
                    'recibos' => $recibos,
                ));
        } elseif (isset($_GET['list'])) {
            $arqueos = new CActiveDataProvider('CajaArqueo',
                array(
                    'criteria' => array(
                        'condition' => 'idCaja=' . $this->cajaCTP,
                        'order' => 'fechaArqueo Desc',
                        'with' => array('idUser0', 'idUser0.idEmpleado0'),
                    ),
                    'pagination' => array(
                        'pageSize' => '20',
                    ),
                ));
            $this->render('base', array('render' => 'arqueos', 'arqueos' => $arqueos,));
        } else
            $this->render('base', array('render' => 'arqueos', 'arqueos' => ''));
    }

    public function actionRegistroDiario()
    {
        if (isset($_GET['id'])) {
            $arqueo = CajaArqueo::model()
                ->with('cajaMovimientoVenta')
                ->find(array('condition' => 'idCajaArqueo=' . $_GET['id'] . ' and cajaMovimientoVenta.tipo=0 and `t`.idCaja=' . $this->cajaCTP, 'order' => 'cajaMovimientoVenta.fechaMovimiento Desc'));
            $start = $arqueo->fechaVentas;
            if (!empty($arqueo)) {
                $arqueoA = CajaArqueo::model()->findByPk($arqueo->idCajaArqueo - 1);
                if (!empty($arqueoA)) {
                    $d = date("d", strtotime($arqueoA->fechaVentas)) + 1;
                    $start = date("Y-m", strtotime($arqueoA->fechaVentas)) . "-" . $d . " 00:00:00";
                }
            }
            $venta = CTP::model()
                ->with('idCajaMovimientoVenta0')
                ->findAll(array('condition' => "fechaOrden>='" . $start . "' and fechaOrden<='" . date("Y-m-d", strtotime($arqueo->fechaVentas)) . " 23:59:59' and idCajaMovimientoVenta0.tipo=0"));
            $ventas = 0;

            foreach ($venta as $item) {
                $ventas = $ventas + $item->idCajaMovimientoVenta0->monto;
            }

            $recibo = Recibos::model()
                ->with('idCajaMovimientoVenta0')
                ->findAll(array('condition' => "fechaRegistro	>='" . $arqueo->fechaVentas . "' and fechaRegistro<='" . date("Y-m-d", strtotime($arqueo->fechaVentas)) . " 23:59:59' and idCajaMovimientoVenta0.tipo=0 and idCajaMovimientoVenta0.idcaja=" . $this->cajaCTP));
            $recibos = 0;

            foreach ($recibo as $item) {
                $recibos = $recibos + $item->idCajaMovimientoVenta0->monto;
            }

            $this->render('base',
                array(
                    'render' => 'registroRealizado',
                    'fecha' => date("Y-m-d", strtotime($arqueo->fechaVentas)),
                    'arqueo' => $arqueo,
                    'ventas' => $ventas,
                    'recibos' => $recibos,
                )
            );
        } else
            throw new CHttpException(400, 'Petición no válida.');
    }

    public function actionComprobante()
    {
        if (isset($_GET['id'])) {
            $arqueo = CajaArqueo::model()->with('idUser0')
                ->with('cajaMovimientoVenta')
                ->with('idUser0.idEmpleado0')
                ->find(array('condition' => 'idCajaArqueo=' . $_GET['id'], 'order' => 'fechaMovimiento Desc'));
            $this->render('base', array('render' => 'comprobante', 'arqueo' => $arqueo));
        } else
            throw new CHttpException(400, 'Petición no válida.');
    }

    public function actionMaterial()
    {
        $material = AlmacenProducto::model()->with('idProducto0')->findAll(array('condition' => 'idAlmacen=' . $this->almacen, 'order' => 'idProducto0.codigo asc, idProducto0.material asc'));
        $this->render('base', array('render' => 'material', 'material' => $material));
    }

    public function actionProductos()
    {
        if (isset($_GET['id'])) {
            $almacen = $this->verifyModel(AlmacenProducto::model()->with('idProducto0')->findByPk($_GET['id']));
            $deposito = AlmacenProducto::model()->find('idAlmacen=1 and idProducto=' . $almacen->idProducto);
            $model = new MovimientoAlmacen;

            $model->idProducto = $almacen->idProducto;
            $model->idAlmacenDestino = $almacen->idAlmacen;
            $model->idAlmacenOrigen = $deposito->idAlmacen;
            //$idUser->idUser = Yii::app()->user->id;
            $model->fechaMovimiento = date("Y-m-d H:i:s");

            if (isset($_POST['MovimientoAlmacen'])) {
                $model->attributes = $_POST['MovimientoAlmacen'];

                $deposito->stockU = $deposito->stockU - $model->cantidadU;
                while ($deposito->stockU < 0) {
                    $deposito->stockU = $deposito->stockU + $almacen->idProducto0->cantXPaquete;
                    $deposito->stockP = $deposito->stockP - 1;
                }
                $deposito->stockP = $deposito->stockP - $model->cantidadP;

                if ($deposito->stockP < 0)
                    $model->addError('cantidadP', 'No existen suficientes insumos');
                else {
                    if ($model->save()) {
                        // form inputs are valid, do something here
                        $almacen->stockU = $almacen->stockU + $model->cantidadU;
                        $almacen->stockP = $almacen->stockP + $model->cantidadP;

                        if ($almacen->save() && $deposito->save()) {
                            //$this->redirect(array('distribuidora/productos'));
                            $this->redirect(array('ctp/material'));
                        }
                    }
                }
            }
            $index = 2;
            $this->renderPartial('forms/add_reduce', array('model' => $model, 'almacen' => $almacen, 'deposito' => $deposito, 'index' => $index));

        } else {
            $this->redirect(array('ctp/material'));
            /*$productos = new CActiveDataProvider('AlmacenProducto',array('criteria'=>$criteria,
                'pagination'=>array(
                        'pageSize'=>15,
                ),));
            //init filter
            $this->renderPartial('add_reduce',array('productos'=>$productos,'index'=>$index));*/
        }
    }

    public function actionPrecios()
    {
        $model = "";//  new MatrizPreciosCTP;
        $placas = AlmacenProducto::model()->with('idProducto0')->findAll(array('condition' => 'idAlmacen=' . $this->almacen . ' and material LIKE "Placas%"', 'order' => 'idProducto0.detalle'));
        $tiposClientes = TiposClientes::model()->findAll('servicio=1');
        $cantidades = CantidadCTP::model()->findAll();
        $horarios = Horario::model()->findAll();

        $matriz = MatrizPreciosCTP::model()->findAll();
        if (!empty($matriz)) {
            $model = array();
            $i = 0;
            $j = 0;
            $k = 0;
            foreach ($placas as $placa)
                foreach ($tiposClientes as $tipoCliente)
                    foreach ($cantidades as $cantidad)
                        foreach ($horarios as $horario) {
                            $model[$placa->idAlmacenProducto][$tipoCliente->idTiposClientes][$cantidad->idCantidadCTP][$horario->idHorario] = new MatrizPreciosCTP;
                        }

            foreach ($matriz as $item) {
                $model[$item->idAlmacenProducto][$item->idTiposClientes][$item->idCantidad][$item->idHorario] = $item;
                if ($i < $item->idCantidad)
                    $i = $item->idCantidad;
                if ($j < $item->idTiposClientes)
                    $j = $item->idTiposClientes;
                if ($k < $item->idAlmacenProducto)
                    $k = $item->idAlmacenProducto;
            }
        } else {
            $model = new MatrizPreciosCTP;
        }
        $this->render('base', array('render' => 'matriz', 'model' => $model, 'placas' => $placas, 'tiposClientes' => $tiposClientes, 'cantidades' => $cantidades, 'horarios' => $horarios));
    }

    public function actionOrdenView()
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

    public function actionAjaxCliente()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['nitCi'])) //if(isset($_GET['nitCi']))
        {
            $cliente = Cliente::model()->with('cTPs')->find('nitCi=' . $_GET['nitCi']);
            $deuda = false;
            if ($cliente === null) {
                $cliente = CJSON::encode(array("nitCi" => "", "apellido" => ""));
            } else {
                foreach ($cliente->cTPs as $item) {
                    if ($item->estado == 2) {
                        $deuda = true;
                        break;
                    }
                }
                $cliente = CJSON::encode($cliente);
                $cliente = array('cliente' => $cliente, 'deuda' => $deuda);
            }
            echo CJSON::encode($cliente);
        }
    }

    public function actionAjaxFactura()
    {
        //Yii::app()->user->id;
        $detalle = array();
        $tipo = 0;
        if (isset($_POST['tipo'])) {
            $tipo = $_POST['tipo'];
        }

        if (isset($_POST['detalle']) and isset($_POST['id']) and isset($_POST['cliente'])) {
            $resultado = array();

            $ctp = $this->verifyModel(CTP::model()
                ->with('detalleCTPs')
                ->with('idCliente0')
                ->findByPk($_POST['id']));
            $ctp->tipoOrden = $tipo;
            $ctp = $this->getCodigo($ctp);

            $horas = Horario::model()->findAll();
            $cantidades = CantidadCTP::model()->findAll();
            //$resultado['detalle']=array();

            $cliente = Cliente::model()->find("nitCi=" . $_POST['cliente']);
            if (empty($cliente)) {
                $cliente = new Cliente;
                $cliente->nitCi = $_POST['cliente'];
                $cliente->save();
            }

            foreach ($ctp->detalleCTPs as $key => $item) {
                $condAlmacen = 'idAlmacenProducto=' . $item->idAlmacenProducto;
                $condCliente = 'idTiposClientes=' . $ctp->idCliente0->idTiposClientes;
                if ($cliente->idCliente != $ctp->idCliente0->idCliente)
                    $condCliente = 'idTiposClientes=' . $cliente->idTiposClientes;
                foreach ($cantidades as $c) {
                    if ($c->Inicio <= $item->nroPlacas)
                        $condCantidad = "idCantidad=" . $c->idCantidadCTP;
                    else
                        break;
                }
                $condHora = "";
                foreach ($horas as $h) {
                    if ($h->inicio <= date("H:0:s"))
                        $condHora = "idHorario=" . $h->idHorario;
                    else
                        break;
                }
                $matriz = MatrizPreciosCTP::model()->find($condAlmacen . ' and ' . $condCliente . ' and ' . $condCantidad . ' and ' . $condHora);
                if ($tipo == 0)
                    $resultado[$key]['costo'] = $matriz->precioCF;
                else
                    $resultado[$key]['costo'] = $matriz->precioSF;

            }
            //*/
            $resultado['codigo'] = $ctp->codigo;

            echo CJSON::encode($resultado);
        }
    }

    private function verifyModel($model)
    {
        if ($model === null)
            throw new CHttpException(404, 'La Respuesta de la pagina no Existe.');

        return $model;
    }

    protected function getUltimoDiaMes($elAnio, $elMes)
    {
        return date("d", (mktime(0, 0, 0, $elMes + 1, 1, $elAnio) - 1));
    }

    protected function getCodigo($ctp)
    {
        $row = CTP::model()->find(array("condition" => "tipoOrden=" . $ctp->tipoOrden . " and idSucursal=" . $this->sucursal, 'order' => 'fechaOrden Desc'));
        if (empty($row))
            $row = new CTP;

        if (empty($row->serie) && $ctp->tipoOrden == 1)
            $row->serie = 65;
        $ctp->numero = $row->numero + 1;
        if ($row->numero == 1001 && $ctp->tipoOrden == 1) {
            $row->numero = 1;
            $row->serie++;
            if ($row->serie == 91)
                $row->serie = 65;
        }
        $ctp->serie = $row->serie;
        if ($ctp->tipoOrden == 1)
            $ctp->codigo = chr($ctp->serie) . "C-" . $ctp->numero . "-" . date("y");
        else
            $ctp->codigo = $ctp->numero . "-C";

        return $ctp;
    }

    private function saveCliente($post)
    {
        $cliente = Cliente::model()->find('nitCi="' . $post['nitCi'] . '"');
        if (empty($cliente))
            $cliente = new Cliente;

        $cliente->attributes = $post;

        if ($cliente->isNewRecord) {
            $cliente->fechaRegistro = date("Y-m-d");
        }
        if ($cliente->idTiposClientes == "") {
            $tmp = TiposClientes::model()->find('`nombre`="nuevo"');
            $cliente->idTiposClientes = $tmp->idTiposClientes;
        }
        return $cliente;
    }

    private function saveMovimientoAlmacen($detalles)
    {
        $almacen = array();
        foreach ($detalles as $key => $item) {
            //$item->save();
            $almacen[$key] = AlmacenProducto::model()->findByPk($item->idAlmacenProducto);
            $almacen[$key]->stockU = $almacen[$key]->stockU - $item->nroPlacas;
            if ($almacen[$key]->stockU >= 0) {
                if (!$almacen[$key]->validate()) {
                    return false;
                }
            } else {
                return false;
            }
        }
        foreach ($almacen as $item) {
            if ($item->save()) {
                $movimiento = new MovimientoAlmacen;
                $movimiento->idProducto = $almacen[$key]->idProducto0->idProducto;
                //$movimiento->idAlmacenDestino = 2;
                $movimiento->idAlmacenOrigen = $this->almacen;
                $movimiento->idUser = Yii::app()->user->id;
                $movimiento->fechaMovimiento = date("Y-m-d H:i:s");
                $movimiento->cantidadU = $detalles[$key]->nroPlacas;
                $movimiento->obs = "orden de trabajo";
                $movimiento->save();
            }
        }
        return true;
    }

    private function modificar($ctp)
    {
        $mntBkp = $ctp->idCajaMovimientoVenta0->monto;
        $ctp->montoVenta;
        $ctp->montoPagado;
        return true;
    }
}
