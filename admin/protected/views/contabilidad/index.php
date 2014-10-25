<div class="col-xs-2">
    <?php
    $this->renderPartial('menus/principal');
    ?>
</div>
<div class="col-xs-10">
    <?php
    switch ($render){
        case "menuCTP":
            $this->renderPartial('menus/ctps');
            break;
        case "costosCTP":
            $this->renderPartial('menus/ctps');
            ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    $this->renderPartial('forms/matriz',array('model'=>$model,'placas'=>$placas,'tiposClientes'=>$tiposClientes,'cantidades'=>$cantidades,'horarios'=>$horarios));
                    ?>
                </div>
            </div>
            <?php
            break;
        default:
            break;
    }
    ?>
</div>