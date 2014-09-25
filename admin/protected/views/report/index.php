<div class="col-sm-2">
	<?php
        $this->renderPartial('menus/producto');
    ?>
</div>
<div class="col-sm-10">
    <?
    switch ($render){
        case "saldos":
            $this->renderPartial('menus/saldos');
            $this->renderPartial('tables/productoSaldo',array('saldoA'=>$saldoA,'entradas'=>$entradas,'salidas'=>$salidas,'saldoB'=>$saldoB,'costos'=>$costos,'almacen'=>$almacen));
            break;
        case "agotarse":
            $this->renderPartial('menus/agotarse');
            $this->renderPartial('tables/productoAgotado',array('resultado'=>$resultado));
            break;
        default:
            break;
    }
    ?>
</div>
