<h1>Movimientos de Alamacenes</h1>
<?php echo CHtml::link('Dercargar Excel',array('inventario/movimientos','excel'=>true), array('class' => 'btn btn-link') ); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$movimientos->searchReporte(),
	'filter'=>$movimientos,
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
				'filter'=>CHtml::activeTextField($movimientos, 'codigo',array("class"=>"form-control")),
		),
		array(
				'header'=>'Material',
				'value'=>'$data->idProducto0->material',
				'filter'=>CHtml::activeDropDownList($movimientos,'material',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'material','select'=>'material','condition'=>'idAlmacen=1')),'material','material'),array("class"=>"form-control ",'empty'=>'')),
		),
		array(
				'header'=>'Detalle Producto',
				'value'=>'$data->idProducto0->color." ".$data->idProducto0->detalle',
				'filter'=>CHtml::activeTextField($movimientos, 'detalle',array("class"=>"form-control")),
		),
		array(
				'header'=>'Industria',
				'value'=>'$data->idProducto0->industria'
		),
		array(
				'header'=>'De',
				'value'=>'(!empty($data->idAlmacenOrigen0))?$data->idAlmacenOrigen0->nombre:""',
				'filter'=>CHtml::activeDropDownList($movimientos,'origen',CHtml::listData(Almacen::model()->findAll(),'nombre','nombre'),array("class"=>"form-control ",'empty'=>'')),
		),
		array(
				'header'=>'A',
				'value'=>'$data->idAlmacenDestino0->nombre',
				'filter'=>CHtml::activeDropDownList($movimientos,'destino',CHtml::listData(Almacen::model()->findAll(),'nombre','nombre'),array("class"=>"form-control ",'empty'=>'')),
		),
		array(
				'header'=>'Cant. Unidad',
				'value'=>'$data->cantidadU'
		),
		array(
				'header'=>'Cant. Paquete',
				'value'=>'$data->cantidadP'
		),
		array(
				'header'=>'Fecha',
				'value'=>'$data->fechaMovimiento',
				'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'fechaMovimiento',
						'attribute'=>'fechaMovimiento',
						'language'=>'es',
						'model'=>$movimientos,
						'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>'yy-mm-d',
						),
						'htmlOptions'=>array(
								'class'=>'form-control input-sm',
						),
				),
						true),
		),
	)
	));
?>