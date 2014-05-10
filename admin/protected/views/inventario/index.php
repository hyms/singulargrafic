<?php
/* @var $this EmpleadoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Inventario',
);

?>
 
<h1>Invetario</h1>

<?php echo CHtml::link('Añadir',array('inventario/Create'), array('class' => 'btn btn-default') ); ?>

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
				'header'=>'',
				'type'=>'raw',
				'value'=>'CHtml::link("Editar",array("cliente/update","id"=>$data->idCliente))'
		),
		array(
				'header'=>'',
				'type'=>'raw',
				'value'=>'CHtml::link("Añadir a Stock",array("cliente/update","id"=>$data->idCliente))'
		),
	)
	));
?>
