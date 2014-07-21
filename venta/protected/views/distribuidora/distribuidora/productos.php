<h2>Distribuidora Inventario</h2>
<?php 
	
	$this->widget('zii.widgets.grid.CGridView', array(
	//'dataProvider'=>$productos,
	'dataProvider'=>$productos->searchDistribuidoraP(),
	'filter'=>$productos,
	//'ajaxUpdate'=>true,
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
				'filter'=>CHtml::activeTextField($productos, 'codigo',array("class"=>"form-control input-sm")),
		),
		array(
				'header'=>'Material',
				'value'=>'$data->idProducto0->material',
				'filter'=>CHtml::activeDropDownList($productos,'material',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'material','select'=>'material','condition'=>'idAlmacen=2')),'material','material'),array("class"=>"form-control input-sm",'empty'=>'')),
		),
		array(
				'header'=>'Detalle Producto',
				'value'=>'$data->idProducto0->color." ".$data->idProducto0->detalle',
				'filter'=>CHtml::activeTextField($productos, 'detalle',array("class"=>"form-control input-sm")),
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
				'filter'=>CHtml::activeDropDownList($productos,'marca',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'marca','select'=>'marca','condition'=>'idAlmacen=2')),'marca','marca'),array("class"=>"form-control input-sm",'empty'=>'')),
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
		
		/*array(
				'header'=>'',
				'type'=>'raw',
				'value'=>'CHtml::link("Editar",array("inventario/update","id"=>$data->idProducto0->idProducto))'
		),*/
		array(
				'header'=>'',
				'type'=>'raw',
				'value'=>'CHtml::link("Añadir a Stock",array("distribuidora/productos","id"=>$data->idAlmacenProducto))'
		),
	)
	));
?>
