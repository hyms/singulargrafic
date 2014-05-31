<?php
/* @var $this EmpleadoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Empleados',
);

?>
 
<h1>Empleados</h1>

<?php echo CHtml::link('Añadir',array('empleado/Create'), array('class' => 'btn btn-default') ); ?>

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
				'value'=>'CHtml::link("Editar",array("empleado/update","id"=>$data->idEmpleado))'
		),
		array(
				'header'=>'',
				'type'=>'raw',
				'value'=>'CHtml::link("Datos de Acceso",array("empleado/dates","id"=>$data->idEmpleado))'
		),
	)
	));
?>
