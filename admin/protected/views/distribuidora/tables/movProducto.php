<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Productos Vendidos</strong>
    </div>
	<div class="panel-body" style="overflow: auto;">
        <div class="hidden-print">
            <?php echo CHtml::link('<span class="glyphicon glyphicon-save"></span>', array("distribuidora/reportDate","productos"=>true,"excel"=>true), array("class"=>"btn btn-default",'id'=>"print","title"=>"Descargar Excel")); ?>
        </div>
<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		//'dataProvider'=>$ventas,
		'dataProvider'=>$ventas->searchVenta(),
		'filter'=>$ventas,
		'ajaxUpdate'=>false,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
			array(
					'header'=>'Nº de Venta',
					'type'=>'raw',
					'value'=>'$data->idVenta0->codigo',
					'filter'=>CHtml::activeTextField($ventas, 'codigo',array("class"=>"form-control input-sm")),
			),
			array(
					'header'=>'Apellido',
					'type'=>'raw',
					'value'=>'$data->idVenta0->idCliente0->apellido',
					'filter'=>CHtml::activeTextField($ventas, 'apellido',array("class"=>"form-control input-sm")),
			),
			array(
					'header'=>'Codigo',
					'type'=>'raw',
					'value'=>'$data->idAlmacenProducto0->idProducto0->codigo',
					'filter'=>CHtml::activeTextField($ventas, 'codigoProducto',array("class"=>"form-control input-sm")),
			),
			array(
					'header'=>'material',
					'type'=>'raw',
					'value'=>'$data->idAlmacenProducto0->idProducto0->material',
					'filter'=>CHtml::activeDropDownList($ventas,'material',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'material','select'=>'material','condition'=>'idAlmacen=2')),'material','material'),array("class"=>"form-control input-sm",'empty'=>'')),
			),
			array(
					'header'=>'color',
					'type'=>'raw',
					'value'=>'$data->idAlmacenProducto0->idProducto0->color',
					'filter'=>CHtml::activeDropDownList($ventas,'color',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'color','select'=>'color','condition'=>'idAlmacen=2')),'color','color'),array("class"=>"form-control input-sm",'empty'=>'')),
			),
			array(
					'header'=>'detalle',
					'type'=>'raw',
					'value'=>'$data->idAlmacenProducto0->idProducto0->detalle',
					'filter'=>CHtml::activeTextField($ventas, 'detalle',array("class"=>"form-control input-sm")),
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
												'dateFormat'=>'yy-mm-dd',
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
<?php 
	$datagrid = $ventas->searchventa();
	$datagrid->Pagination = false;
	$data = $datagrid->data;
	$unidad = 0; $paquete = 0;
	foreach($data as $item)
	{
		$unidad = $unidad+$item->cantidadU;
		$paquete = $paquete+$item->cantidadP;
	}
?>
	<div class="well well-sm col-xs-offset-8 col-xs-4">
		<div class="col-xs-6">
		<strong>Unidades:</strong><?php echo $unidad;?>
		</div>
		<div class="col-xs-6">
		<strong>Paquetes:</strong><?php echo $paquete;?>
	</div>
</div>