<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
<?php $this->renderPartial('movimientos/menu');?>
<div class="row">
<div class="text-center">
<?php if($cond1!="" && $cond2!=""){?>
<?php echo CHtml::link('Con Factura', $cond1, array("class"=>"btn btn-default hidden-print")); ?>
<?php echo CHtml::link('Sin Factura', $cond2, array("class"=>"btn btn-default hidden-print")); ?>
<?php echo CHtml::link('Imprimir', $cond3, array("class"=>"btn btn-default hidden-print")); ?>
<?php }?>
</div>
</div>
<?php if($ventas!=""){?>
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
					'header'=>'NitCi',
					'type'=>'raw',
					'value'=>'$data->idCliente0->nitCi',
			),
			array(
					'header'=>'Apellido',
					'type'=>'raw',
					'value'=>'$data->idCliente0->apellido',
			),
			array(
					'header'=>'Fecha',
					'type'=>'raw',
					'value'=>'$data->fechaVenta',
			),
			array(
					'header'=>'Formato',
					'type'=>'raw',
					'value'=>'$data->formato',
			),
			array(
					'header'=>'Monto',
					'type'=>'raw',
					'value'=>'$data->idCajaMovimientoVenta0->monto',
			),
		)
	));
?>
<?php }?>
</div>

