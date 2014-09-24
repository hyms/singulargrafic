<div class="col-sm-2">
    <?php $this->renderPartial('menus/principal'); ?>
</div>
<div class="col-sm-10">
    <?php
        switch ($render){
            case "productos":
                $this->renderPartial('tables/productos',array('dataProvider'=>$dataProvider,));
                break;
            case "new":
                echo '<div class="panel panel-default">
                        <div class="panel-heading">
                            <strong class="panel-title">Nuevo Producto</strong>
                        </div>
                        <div class="panel-body" style="overflow: auto;">';
                $this->renderPartial('forms/_form',array('model'=>$model));
                echo '</div></div>';
                $this->renderPartial('scripts/save');
                $this->renderPartial('scripts/reset');
                break;
            case "edit":
                echo '<div class="panel panel-default">
                        <div class="panel-heading">
                            <strong class="panel-title">Producto '.$model->codigo.'</strong>
                        </div>
                        <div class="panel-body" style="overflow: auto;">';
                $this->renderPartial('forms/_form',array('model'=>$model));
                echo '</div></div>';
                $this->renderPartial('scripts/save');
                $this->renderPartial('scripts/reset');
                break;
            default:
                echo "";
                break;
        }
    ?>
</div>
