<?php
/* @var $this AlmacenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Almacens',
);

?>

<h1>Almacenes</h1>

<?php echo CHtml::link('Añadir',array('almacen/create'), array('class' => 'btn btn-default') ); ?>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'itemsCssClass' => 'table table-hover table-condensed',
	'htmlOptions' => array('class' => 'table-responsive'),
	'columns'=>array(
		
		array(
			'header'=>'#',
			'value'=>'$row+1',       //  row is zero based
		),
		array(
			'name'=>'Tipo Almacen',
			'type'=>'raw',
			'value'=>'$data->TipoAlmacen->nombre'
		),
		array(
			'name'=>'Detalle del Producto',
			'type'=>'raw',
			'value'=>'$data->Producto->Material->nombre." ".$data->Producto->Color->nombre." ".$data->Producto->peso." ".$data->Producto->dimension.", ".$data->Producto->procedencia'
		),
		'stockUnidad',
		'stockPaquete',
		/*array(
			'name'=>'',
			'type'=>'raw',
			'value'=>'CHtml::link("Editar",array("producto/update","id"=>$data->id))'
		),*/
		array(
			'name'=>'',
			'type'=>'raw',
			'value'=>'CHtml::link("Eliminar",array("almacen/delete","id"=>$data->id),array("confirm" => "Esta seguro de Eliminarlo?"))'
		),
		
	)
));
?>

