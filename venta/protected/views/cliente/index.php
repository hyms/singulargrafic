<?php
switch ($render){
    case "clientes":
        $this->renderPartial('tables/clientes',array(
            'dataProvider'=>$dataProvider,
        ));
        break;
    case "new":
        echo '<div class="panel panel-default">
                        <div class="panel-heading">
                            <strong class="panel-title">Nuevo Cliente</strong>
                        </div>
                        <div class="panel-body" style="overflow: auto;">';
        $this->renderPartial('forms/_form', array('model'=>$model));
        echo '</div></div>';
        $this->renderPartial('scripts/save');
        $this->renderPartial('scripts/reset');
        break;
    case "update":
        echo '<div class="panel panel-default">
                    <div class="panel-heading">
                        <strong class="panel-title">Cliente: '.$model->apellido.'</strong>
                    </div>
                    <div class="panel-body" style="overflow: auto;">';
        $this->renderPartial('forms/_form', array('model'=>$model));
        echo "</div>
                </div>";
        $this->renderPartial('scripts/save');
        $this->renderPartial('scripts/reset');
        break;
    case "preferencia":
        $this->renderPartial('forms/preferencia',array('clientes'=>$clientes));
        $this->renderPartial('scripts/save');
        break;
    default:
        break;
}