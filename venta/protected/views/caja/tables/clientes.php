<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Lista de Clientes</strong>
    </div>
    <div class="panel-body">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$clientes->search(),
            'filter'=>$clientes,
            'itemsCssClass' => 'table table-hover table-condensed',
            'htmlOptions' => array('class' => 'table-responsive'),
            'columns'=>array(
                array(
                    'header'=>'Nro',
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
                array(
                    'header'=>'Nombre',
                    'filter'=>CHtml::activeTextField($clientes, 'nombre',array("class"=>"form-control input-sm hidden-print")),
                    'value'=>'$data->nombre',
                ),
                array(
                    'header'=>'Apellido',
                    'filter'=>CHtml::activeTextField($clientes, 'apellido',array("class"=>"form-control input-sm hidden-print")),
                    'value'=>'$data->apellido',
                ),
                array(
                    'header'=>'Nit/Ci',
                    'filter'=>CHtml::activeTextField($clientes, 'nitCi',array("class"=>"form-control input-sm hidden-print")),
                    'value'=>'$data->nitCi',
                ),
                array(
                    'header'=>'Telefono',
                    'value'=>'$data->telefono',
                ),
            )
        ));
        ?>
    </div>
</div>