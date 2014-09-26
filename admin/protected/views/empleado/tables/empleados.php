<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Lista de Productos</strong>
    </div>
    <div class="panel-body">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'itemsCssClass' => 'table table-hover table-condensed',
	'htmlOptions' => array('class' => 'table-responsive'),
	'columns'=>array(
		array(
				'header'=>'Nro',
				'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
		),
		array(
				'header'=>'Nombre',
				'value'=>'$data->nombre',
		),
		array(
				'header'=>'Apellido',
				'value'=>'$data->apellido',
		),
		array(
				'header'=>'CI',
				'value'=>'$data->ci',
		),
		array(
				'header'=>'Telefono',
				'value'=>'$data->telefono',
		),
		array(
				'header'=>'',
				'type'=>'raw',
				'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-edit\"></span> Editar",array("empleado/update","id"=>$data->idEmpleado))'
		),
		array(
				'header'=>'',
				'type'=>'raw',
				'value'=>'CHtml::link("Datos de Acceso",array("empleado/dates","id"=>$data->idEmpleado))'
		),
	)
	));
?>
    </div>
</div>