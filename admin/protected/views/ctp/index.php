<div class="col-xs-2">
    <?php
    $this->renderPartial("menus/report");
    ?>
</div>
<div class="col-xs-10">
    <?php
    switch($render){
        case "reportDate":
            $this->renderPartial('tables/ordenes',array('ordenes'=>$model));
            break;
        case "reportPlaca":
            $this->renderPartial('tables/productos',array('placas'=>$model));
            break;
        default:
            break;
    }
    ?>
</div>