<div class="col-xs-2">
    <?php
    $this->renderPartial('menus/report');
    ?>
</div>
<div class="col-xs-10">
    <?php
    switch ($render) {
        case "deuda":
            $this->renderPartial('tables/deudas',array('clientes'=>$clientes));
            break;
        default:
            break;
    }
    ?>
</div>