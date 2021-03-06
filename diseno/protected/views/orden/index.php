<div class="col-xs-2">
    <?php $this->renderPartial('menus/principal'); ?>
</div>

<div class="col-xs-10">
    <?php
    switch ($render){
        case "new":
            $this->renderPartial('cliente',array('cliente'=>$cliente,'detalle'=>$detalle,'ctp'=>$ctp,'productos'=>$productos,'clientes'=>$clientes));
            $this->renderPartial('scripts/save');
            $this->renderPartial('scripts/reset');
            break;
        case "interna":
            $this->renderPartial('interna',array('cliente'=>$cliente,'detalle'=>$detalle,'ctp'=>$ctp,'productos'=>$productos));
            $this->renderPartial('scripts/save');
            $this->renderPartial('scripts/reset');
            break;
        case "buscar":
            $this->renderPartial('tables/buscar',array('ordenes'=>$ordenes));
            break;
        case "modificarC":
            $this->renderPartial('cliente',array('cliente'=>$cliente,'detalle'=>$detalle,'ctp'=>$ctp,'productos'=>$productos));
            $this->renderPartial('scripts/save');
            $this->renderPartial('scripts/reset');
            break;
        case "modificarI":
            $this->renderPartial('interna',array('cliente'=>$cliente,'detalle'=>$detalle,'ctp'=>$ctp,'productos'=>$productos));
            $this->renderPartial('scripts/save');
            $this->renderPartial('scripts/reset');
            break;
        default:
            echo "";
            break;
    }
    ?>
</div>