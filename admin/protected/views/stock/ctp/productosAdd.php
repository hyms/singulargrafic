<h2>Distribuidora Inventario</h2>
<?php 
	
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
				'header'=>'Distribuidora',
				'type'=>'raw',
				'value'=>'$data->ctpLink($data->idProducto0->idProducto)',
		),
	)
	));
?>
<div class="text-right">
<?php echo CHtml::link("Finalizar",array("stock/distribuidora"),array("class"=>"btn btn-default"));?>
</div>