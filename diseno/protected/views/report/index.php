<div class="col-xs-2">
    <?php $this->renderPartial('menus/principal'); ?>
</div>

<div class="col-xs-10">
    <?php
    switch ($render){
        case "ordenes":
            $this->renderPartial('tables/ordenes',array('ordenes'=>$ordenes));
            break;
        case "placas":
            $this->renderPartial('tables/productos',array('placas'=>$placas));
            break;
        case "deudas":
            $this->renderPartial('tables/deudas',array('deudas'=>$deudas));
            break;
        case "preview":
            break;
        default:
            echo "";
            break;
    }
    ?>
</div>