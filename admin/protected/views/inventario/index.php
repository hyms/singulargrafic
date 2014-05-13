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
				'value'=>'$data->idProducto0->codigo'
		),
		array(
				'header'=>'Material',
				'value'=>'$data->idProducto0->material'
		),
		array(
				'header'=>'Detalle Producto',
				'value'=>'$data->idProducto0->color." ".$data->idProducto0->detalle'
		),
		array(
				'header'=>'Precio S/F',
				'value'=>'$data->idProducto0->precioSFU."/".$data->idProducto0->precioSFP'
		),
		array(
				'header'=>'Precio C/F',
				'value'=>'$data->idProducto0->precioCFU."/".$data->idProducto0->precioCFP'
		),
		array(
				'header'=>'Industria',
				'value'=>'$data->idProducto0->industria'
		),

		array(
				'header'=>'Cant.xPaqt.',
				'value'=>'$data->idProducto0->cantXPaquete'
		),
		array(
				'header'=>'',
				'type'=>'raw',
				'value'=>'CHtml::link("Editar",array("inventario/update","id"=>$data->idProducto0->idProducto))'
		),
		array(
				'header'=>'',
				'type'=>'raw',
				'value'=>'CHtml::link("Añadir a Stock",array("inventario/stock","id"=>$data->idAlmacenProducto))'
		),
	)
	));
?>
