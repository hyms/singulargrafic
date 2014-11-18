<div class="col-xs-2 hidden-print">
    <?php $this->renderPartial('menus/principal'); ?>
</div>
<div class="col-xs-10">
    <?php
    switch ($render) {
        case "ordenes":
            $this->renderPartial('tables/ordenes', array('ordenes' => $ordenes, 'estado' => $estado));
            break;
        case "orden":
            $this->renderPartial('orden', array('ctp' => $ctp, 'detalle' => $detalle, 'cliente' => $cliente));
            $this->renderPartial('scripts/save');
            $this->renderPartial('scripts/reset');
            break;
        case "search":
            $this->renderPartial('tables/search', array('ordenes' => $ordenes,));
            break;
        case "deudores":
            $this->renderPartial('tables/deudores', array('deudores' => $deudores));
            break;
        case "movimientos":
            $this->renderPartial('menus/movimientos');
            $this->renderPartial('tables/movimientos', array('ventas' => $ventas, 'saldo' => $saldo, 'cond3' => $cond3, 'cf' => $cf, 'sf' => $sf));
            break;
        case "arqueo":
            $this->renderPartial('menus/arqueo');
            $this->renderPartial("tables/arqueo",
                array(
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
            $this->renderPartial('scripts/print');
            break;
        case "arqueos":
            $this->renderPartial('menus/arqueo');
            $this->renderPartial('tables/arqueos', array('arqueos' => $arqueos,));
            break;
        case "registroRealizado":
            $saldo = 0;
            $saldo = CajaArqueo::model()->findByPk($arqueo->idCajaArqueo - 1);
            if (!isset($saldo))
                $saldo = 0;
            else
                $saldo = $saldo->saldo;
            $this->renderPartial('tables/registroDiario', array('fecha' => $fecha, 'saldo' => $saldo, 'ventas' => $ventas, 'recibos' => $recibos, 'arqueo' => $arqueo));
            break;
        case "material":
            $this->renderPartial('tables/material', array('material' => $material));
            break;
        case "preview":
            $this->renderPartial('menus/previews', array('ctp' => $ctp, 'tipo' => $tipo));
            $this->renderPartial('prints/preview', array('ctp' => $ctp, 'tipo' => $tipo));
            $this->renderPartial('scripts/print');
            break;
        case "previewTI":
            $this->renderPartial('menus/previews', array('ctp' => $ctp, 'tipo' => $tipo));
            $this->renderPartial('prints/previewTI', array('ctp' => $ctp, 'tipo' => $tipo, 'titulo' => $titulo));
            $this->renderPartial('scripts/print');
            break;
        case "previewSC":
            $this->renderPartial('menus/previews', array('ctp' => $ctp, 'tipo' => $tipo));
            $this->renderPartial('prints/previewSC', array('ctp' => $ctp, 'tipo' => $tipo, 'titulo' => $titulo));
            $this->renderPartial('scripts/print');
            break;
        case "previewDay":
            $this->renderPartial('menus/movimientos');
            $this->renderPartial("movimientos/previewVentas", array('tabla' => $tabla,));
            $this->renderPartial('scripts/print');
            break;
        case "comprobante":
            $this->renderPartial('menus/arqueo');
            $this->renderPartial('prints/comprobante', array('arqueo' => $arqueo));
            $this->renderPartial('scripts/print');
            break;
        case "matriz":
            $this->renderPartial('tables/precios', array('model' => $model, 'placas' => $placas, 'clienteTipos' => $tiposClientes, 'cantidades' => $cantidades, 'horarios' => $horarios));
            break;
        default:
            $this->renderPartial('index', array('clientes' => $clientes, 'agotarse' => $agotarse));
            break;
    }
    ?>
</div>