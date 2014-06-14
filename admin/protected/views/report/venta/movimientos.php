<div class="row">
<div class="text-center">
<?php echo CHtml::link('Con Factura', $cond1, array("class"=>"btn btn-default hidden-print")); ?>
<?php echo CHtml::link('Sin Factura', $cond2, array("class"=>"btn btn-default hidden-print")); ?>
<?php echo CHtml::link('Imprimir', array("#"), array("class"=>"btn btn-default hidden-print")); ?>
</div>
</div>
<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$ventas,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
			array(
					'header'=>'Nro',
					'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
			),
			array(
					'header'=>'Nº de Venta',
					'type'=>'raw',
					'value'=>'chr($data->serie)." ".$data->codigo',
			),
			array(
					'header'=>'Apellido',
					'type'=>'raw',
					'value'=>'$data->idCliente0->apellido',
			),
			array(
					'header'=>'NitCI',
					'type'=>'raw',
					'value'=>'$data->idCliente0->nitCi',
			),
			array(
					'header'=>'Monto de la Venta',
					'type'=>'raw',
					'value'=>'$data->montoVenta',
			),
			array(
					'header'=>'Monto Pagado',
					'type'=>'raw',
					'value'=>'$data->montoPagado',
			),
			array(
					'header'=>'Monto del Cambio',
					'type'=>'raw',
					'value'=>'$data->montoCambio',
			),
			array(
					'header'=>'Fecha',
					'type'=>'raw',
					'value'=>'$data->fechaVenta',
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("Detalle", array("#"), array("class"=>"hidden-print"))',
			),
		)
	));
?>

