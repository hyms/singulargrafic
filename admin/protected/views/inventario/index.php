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
				'header'=>'Codigo',
				'value'=>'$data->codigo'
		),
		array(
				'header'=>'Material',
				'value'=>'$data->material'
		),
		array(
				'header'=>'Detalle Producto',
				'value'=>'$data->color." ".$data->detalle'
		),
		array(
				'header'=>'Precio S/F',
				'value'=>'$data->precioSFU."/".$data->precioSFP'
		),
		array(
				'header'=>'Precio C/F',
				'value'=>'$data->precioCFU."/".$data->precioCFP'
		),
		array(
				'header'=>'Industria',
				'value'=>'$data->industria'
		),

		array(
				'header'=>'Cant.xPaqt.',
				'value'=>'$data->cantXPaquete'
		),
		array(
				'header'=>'',
				'type'=>'raw',
				'value'=>'CHtml::link("Editar",array("inventario/update","id"=>$data->idProducto))'
		),
		array(
				'header'=>'',
				'type'=>'raw',
				'value'=>'CHtml::link("Añadir a Stock",array("inventario/update","id"=>$data->idProducto))'
		),
	)
	));
?>
