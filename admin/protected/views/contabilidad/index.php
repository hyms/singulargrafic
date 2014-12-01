<div class="col-xs-2">
    <?php
    $this->renderPartial('menus/principal');
    ?>
</div>
<div class="col-xs-10">
    <?php
    switch ($render){
        case "menuCTP":
            $this->renderPartial('menus/submenus',array("tipo"=>"ctp"));
            break;
        case "costosCTP":
            $this->renderPartial('menus/submenus',array("tipo"=>"ctp"));
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
        case "menuDist":
            $this->renderPartial('menus/submenus',array("tipo"=>"dist"));
            break;
        case "distribuidora":
            $this->renderPartial('menus/submenus',array("tipo"=>"dist"));
            ?>
            <div class="panel panel-default">
                <div class="panel-body" style="height: 600px; overflow: auto;">
                    <?php
                    $this->renderPartial('tables/material',array('lista'=>$lista))
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