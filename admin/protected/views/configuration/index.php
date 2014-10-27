<div class="col-xs-2">
    <?php
    $this->renderPartial('menus/principal');
    ?>
</div>
<div class="col-xs-10">
    <?php
    switch ($render){
        case "sucursal":
            $this->renderPartial('tables/sucursales',array('sucursales'=>$sucursales));
            break;
        case "caja":
            $this->renderPartial('tables/cajas',array('cajas'=>$cajas));
            break;
        case "almacen":
            $this->renderPartial('tables/almacenes',array('almacenes'=>$almacenes));
            break;
        default:
            break;
    }
    ?>
</div>