<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
<?php $this->renderPartial('menuMovimientos');?>

<div  >
<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		//'dataProvider'=>$ventas,
		'dataProvider'=>$ventas->searchventa(),
		'filter'=>$ventas,
		'ajaxUpdate'=>false,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
			array(
					'header'=>'Nº de Venta',
					'type'=>'raw',
					'value'=>'$data->idVenta0->codigo',
					'filter'=>CHtml::activeTextField($ventas, 'codigo',array("class"=>"form-control")),
			),
			array(
					'header'=>'Apellido',
					'type'=>'raw',
					'value'=>'$data->idVenta0->idCliente0->apellido',
					'filter'=>CHtml::activeTextField($ventas, 'apellido',array("class"=>"form-control")),
			),
			array(
					'header'=>'material',
					'type'=>'raw',
					'value'=>'$data->idAlmacenProducto0->idProducto0->material',
					'filter'=>CHtml::activeDropDownList($ventas,'material',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'material','select'=>'material','condition'=>'idAlmacen=2')),'material','material'),array("class"=>"form-control ",'empty'=>'')),
			),
			array(
					'header'=>'detalle',
					'type'=>'raw',
					'value'=>'$data->idAlmacenProducto0->idProducto0->detalle',
					'filter'=>CHtml::activeTextField($ventas, 'detalle',array("class"=>"form-control")),
			),
			array(
					'header'=>'cantidad Unidad',
					'type'=>'raw',
					'value'=>'$data->cantidadU',
					
			),
			array(
					'header'=>'cantidad paquete',
					'type'=>'raw',
					'value'=>'$data->cantidadP',
						
			),
			array(
					'header'=>'Fecha',
					'type'=>'raw',
					'value'=>'$data->idVenta0->fechaVenta',
					'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
										'name'=>'fecha',
										'attribute'=>'fecha',
										'language'=>'es',
										'model'=>$ventas,
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
</div>
