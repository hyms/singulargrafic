<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
<?php $this->renderPartial('menuMovimientos');?>

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
					'header'=>'codigo',
					'type'=>'raw',
					'value'=>'$data->serie." ".$data->codigo',
			),
		)
	));
?>

</div>