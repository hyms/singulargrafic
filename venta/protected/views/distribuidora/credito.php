<div class="col-md-2">
<?php $this->renderPartial('menu'); ?>
</div>
<div class="col-md-10">
<div class="panel panel-default">
	<div class="panel-heading">
		<strong><?php echo $titulo;?></strong>
	</div>
	<div class="panel-body">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$ventas,
		//'ajaxUpdate'=>true,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
			
			array(
				'header'=>'#',
				'value'=>'$row+1',       //  row is zero based
			),
			'codigo',
			array(
				'name'=>'tipoPago',
				'value'=>'($data->tipoPago==0)?CHtml::encode("Con Factura"):CHtml::encode("Sin Factura")',
			),
			array(
				'header'=>'Cliente',
				'value'=>'$data->Cliente->nitCi." - ".$data->Cliente->apellido',
			),
			'fechaVenta',
			'fechaPlazo',
			array(
				'header'=>'Deuda',
				'value'=>'$data->montoTotal - $data->montoPagado',
			),
			'montoTotal',
			array(
				'header'=>'',
				'type'=>'raw',
				'value'=>'CHtml::link("Ver", array("preview","id"=>$data->id))',
			),
			
		)
	)); 
	?>
	</div>
</div>
</div>