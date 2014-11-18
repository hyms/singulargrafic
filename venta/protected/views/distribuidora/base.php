<div class="col-xs-2 hidden-print">
    <?php $this->renderPartial('menus/principal'); ?>
</div>

<div class="col-xs-10">
    <?php
    if(isset($render)) {
        switch ($render) {
            case "nota":
                $this->renderPartial("notaVenta", array(
                    'productos' => $productos,
                    'cliente' => $cliente,
                    'detalle' => $detalle,
                    'venta' => $venta,));
                $this->renderPartial("scripts/operaciones");
                $this->renderPartial("scripts/save");
                $this->renderPartial("scripts/reset");
                break;

            case "buscar":
                $this->renderPartial('tables/buscar', array('ventas' => $ventas));
                break;

            case "preview":
                $this->renderPartial('prints/notaVenta', array('venta' => $ventas));
                $this->renderPartial("scripts/print");
                break;

            case "deudores":
                $this->renderPartial('tables/deudores', array('deudores' => $deudores));
                break;

            case "movimientos":
                $this->renderPartial('menus/movimientos');
                $this->renderPartial('tables/movimientos', array('ventas' => $ventas, 'saldo' => $saldo, 'cond3' => $cond3, 'cf' => $cf, 'sf' => $sf));
                break;

            case "movProducto":
                $this->renderPartial('menus/movimientos');
                $this->renderPartial('tables/movProducto', array('ventas' => $ventas));
                break;

            case "previewVentas":
                $this->renderPartial("prints/ventas", array('tabla' => $tabla,));
                $this->renderPartial("scripts/print");
                break;

            case "arqueo":
                $this->renderPartial('menus/arqueo');
                $this->renderPartial("forms/arqueo", array(
                    'saldo' => $saldo,
                    'arqueo' => $arqueo,
                    'caja' => $caja,
                    'fecha' => $fecha,
                    'ventas' => $ventas,
                    'recibos' => $recibos,
                ));
                $comprobante = '';
                $detalle = '';
                $arqueo = '';
                $this->renderPartial('tables/registroDiario',
                    array('fecha' => $fecha,
                        'saldo' => $saldo,
                        'ventas' => $ventas,
                        'recibos' => $recibos,
                        'comprobante' => $comprobante,
                        'detalle' => $detalle,
                        'arqueo' => $arqueo,
                    ));
                $this->renderPartial("scripts/print");
                $this->renderPartial("scripts/save");
                break;
            case "arqueos":
                $this->renderPartial('menus/arqueo');
                $this->renderPartial('tables/arqueos', array('arqueos' => $arqueos,));
                break;
            case "registroRealizado":
                $this->renderPartial('menus/arqueo');
                $saldo = CajaArqueo::model()->find(array('condition' => "idCaja=2 and idCajaArqueo<" . $arqueo->idCajaArqueo, 'order' => 'idCajaArqueo Desc'));
                if (empty($saldo))
                    $saldo = 0;
                else
                    $saldo = $saldo->saldo;
                $this->renderPartial('tables/registroDiario', array('fecha' => $fecha, 'saldo' => $saldo, 'ventas' => $ventas, 'recibos' => $recibos, 'arqueo' => $arqueo));
                $this->renderPartial("scripts/print");
                break;
            case "comprobante":
                $this->renderPartial('menus/arqueo');
                $this->renderPartial('prints/comprobante', array('arqueo' => $arqueo));
                $this->renderPartial("scripts/print");
                break;
            default:
                $this->renderPartial('index', array("ventas" => $ventas, "productos" => $productos));
                break;
        }
    }
    ?>
</div>