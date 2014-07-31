<?php
/* @var $this EmpleadoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Inventario',
);

?>
 
<h1>Inventario</h1>

<?php echo CHtml::link('Añadir',array('inventario/Create'), array('class' => 'btn btn-default') ); ?>
<?php echo CHtml::link('Dercargar Excel',array('inventario/index','excel'=>true), array('class' => 'btn btn-link') ); ?>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	//'dataProvider'=>$dataProvider,
	'dataProvider'=>$dataProvider->searchInventarioGral(),
	'filter'=>$dataProvider,
	'itemsCssClass' => 'table table-hover table-condensed',
	'htmlOptions' => array('class' => 'table-responsive'),
	'columns'=>array(
		array(
				'header'=>'Nro',
				'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
		),
		
		array(
				'header'=>'Codigo',
				'value'=>'$data->idProducto0->codigo',
				'filter'=>CHtml::activeTextField($dataProvider, 'codigo',array("class"=>"form-control")),
		),
		array(
				'header'=>'Material',
				'value'=>'$data->idProducto0->material',
				'filter'=>CHtml::activeDropDownList($dataProvider,'material',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'material','select'=>'material','condition'=>'idAlmacen=1')),'material','material'),array("class"=>"form-control ",'empty'=>'')),
		),
		array(
				'header'=>'Detalle Producto',
				'value'=>'$data->idProducto0->color." ".$data->idProducto0->detalle." ".$data->idProducto0->marca',
				'filter'=>CHtml::activeTextField($dataProvider, 'detalle',array("class"=>"form-control")),
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
				'value'=>'$data->idProducto0->industria',
				'filter'=>CHtml::activeDropDownList($dataProvider,'industria',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'industria','select'=>'industria','condition'=>'idAlmacen=1')),'industria','industria'),array("class"=>"form-control",'empty'=>'')),
		),
		array(
				'header'=>'Cant.xPaqt.',
				'value'=>'$data->idProducto0->cantXPaquete'
		),
		array(
				'header'=>'Stock Unidad',
				'value'=>'$data->stockU'
		),
		array(
				'header'=>'Stock Paquete',
				'value'=>'$data->stockP'
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
