<h2>Distribuidora Inventario</h2>
<?php 
	echo CHtml::link('Añadir',array('stock/distribuidoraAdd'), array('class' => 'btn btn-default') );
	
	$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productos,
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
				//'value'=>'$data->idProducto0->color." ".$data->idProducto0->detalle'
				'value'=>'$data->idProducto0->color." ".$data->idProducto0->detalle." ".$data->idProducto0->marca'
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
				'value'=>'CHtml::link("Añadir a Stock",array("stock/stockDistribuidora","id"=>$data->idAlmacenProducto))'
		),
		array(
				'header'=>'',
				'type'=>'raw',
				'value'=>'CHtml::link("Eliminar",array("stock/deleteDetalle","id"=>$data->idAlmacenProducto),array("onClick"=>"confirm(\"Realmente desea eliminar el producto?\")"))'
		),
	)
	));
?>
