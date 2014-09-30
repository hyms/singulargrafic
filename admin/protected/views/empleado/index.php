<div class="col-xs-2">
    <?php
    $this->renderpartial('menus/principal');
    ?>
</div>
<div class="col-xs-10">
    <?php
    switch ($render){
        case "list":
            $this->renderPartial('tables/empleados',array('dataProvider'=>$dataProvider));
            break;
        case "new":
            echo '<div class="panel panel-default">
                        <div class="panel-heading">
                            <strong class="panel-title">Nuevo Empleado</strong>
                        </div>
                        <div class="panel-body" style="overflow: auto;">';
            $this->renderPartial('forms/_form',array(
                'model'=>$model,
            ));
            echo '</div></div>';
            $this->renderPartial('scripts/save');
            $this->renderPartial('scripts/reset');
            break;
        case "update":
            echo '<div class="panel panel-default">
                        <div class="panel-heading">
                            <strong class="panel-title">Empleado: '.$model->apellido.' </strong>
                        </div>
                        <div class="panel-body" style="overflow: auto;">';
            $this->renderPartial('forms/_form',array(
                'model'=>$model,
            ));
            echo '</div></div>';
            $this->renderPartial('scripts/save');
            $this->renderPartial('scripts/reset');
            break;
        case "dates":
            $this->renderPartial('forms/formDate',array('model'=>$model,'empleado'=>$empleado));
            $this->renderPartial('scripts/save');
            $this->renderPartial('scripts/reset');
            break;
        default;
            break;
    }
    ?>
</div>