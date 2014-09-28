<div class="col-xs-2">
<?php $this->renderPartial('menus/principal');?>
</div>
<div class="col-xs-10">
<?php
    switch ($render){
        case "almacen":
            $this->renderPartial('tables/stock',array('productos'=>$productos,'almacen'=>$almacen,'title'=>$title));
            $this->renderPartial("scripts/modal");
            break;
        case "movimientos":
            $this->renderPartial('tables/movimientos',array('movimientos'=>$movimientos));
            break;
        default:
            echo "";
            break;
    }
?>
</div>