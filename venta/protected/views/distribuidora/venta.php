<div class="col-md-2">
<?php $this->renderPartial('menu'); ?>
</div>
<div class="col-md-10">
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
			'header'=>'Tipo Pago',
			'value'=>'($data->idTipoPago==0)?CHtml::encode("Contado"):CHtml::encode("Credito")',
		),
		array(
			'header'=>'Cliente',
			'value'=>'$data->Cliente->nitCi." - ".$data->Cliente->apellido',
		),
		'fechaVenta',
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