<div class="col-xs-2 hidden-print">
    <?php $this->renderPartial('../distribuidora/menus/report'); ?>
</div>

<div class="col-xs-10">
    <?php
    switch ($render)
    {
        case "movimientos":
            $this->renderPartial('menus/reportMovimientos');
            $this->renderPartial('tables/movimientos',array('ventas'=>$ventas,'saldo'=>$saldo,'cf'=>$cf,'sf'=>$sf));
            break;
        case "movProducto":
            $this->renderPartial('tables/movProducto',array('ventas'=>$ventas));
            break;
        case "saldos":
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong class="panel-title">Saldos de Material</strong>
                </div>
                <div class="panel-body" style="overflow: auto;">
            <?php
            $this->renderPartial('producto/productoSaldo',array('saldoA'=>$saldoA,'entradas'=>$entradas,'salidas'=>$salidas,'saldoB'=>$saldoB,'costos'=>$costos,'almacen'=>$almacen));
            ?>
                </div>
            </div>
            <?php
            break;
        default:
            echo "";
            break;
    }
    ?>
</div>
