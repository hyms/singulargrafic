<div class="col-sm-2">
<?php $this->renderPartial('menus/principal');?>
</div>
<div class="col-sm-10">
<?php
    switch ($render){
        case "almacen":
            $this->renderPartial('tables/stock',array('productos'=>$productos,'almacen'=>$almacen,'title'=>$title));
            break;
        default:
            echo "";
            break;
    }
?>
</div>