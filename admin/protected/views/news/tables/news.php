<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Lista de Noticias</strong>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$data,
            'itemsCssClass' => 'table table-hover table-condensed',
            'htmlOptions' => array('class' => 'table-responsive'),
            'columns'=>array(
                array(
                    'header'=>'#',
                    'value'=>'$row+1',       //  row is zero based
                ),
                array(
                    'name'=>'titulo',
                    'type'=>'raw',
                    'value'=>'$data->titulo'
                ),
                array(
                    'name'=>'texto',
                    'type'=>'raw',
                    'value'=>'"<div style=\"height: 130px; overflow:overlay;\">".$data->detalle."</div>"',
                ),
                array(
                    'name'=>'',
                    'type'=>'raw',
                    'value'=>'CHtml::link("Editar",array("news/new","id"=>$data->idNews))'
                ),
                array(
                    'name'=>'',
                    'type'=>'raw',
                    'value'=>'CHtml::link("Asignar",array("news/asignar","id"=>$data->idNews))'
                ),

            )
        ));
        ?>
    </div>
</div>