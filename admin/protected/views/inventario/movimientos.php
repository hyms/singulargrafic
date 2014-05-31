<h1>Movimientos de Alamacenes</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$movimientos,
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
				'header'=>'Industria',
				'value'=>'$data->idProducto0->industria'
		),
		array(
				'header'=>'De',
				'value'=>'(!empty($data->idAlmacenOrigen0))?$data->idAlmacenOrigen0->nombre:""'
		),
		array(
				'header'=>'A',
				'value'=>'$data->idAlmacenDestino0->nombre'
		),
		array(
				'header'=>'Cant. Unidad',
				'value'=>'$data->cantidadU'
		),
		array(
				'header'=>'Cant. Paquete',
				'value'=>'$data->cantidadU'
		),
		array(
				'header'=>'Fecha',
				'value'=>'$data->fechaMovimiento'
		),
	)
	));
?>