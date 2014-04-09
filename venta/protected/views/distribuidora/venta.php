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
			'idTipoPago',
			'idCliente',
			'fechaVenta',
			'montoTotal',
		/*array(
			'name'=>'codigo',
			'value'=>'$data->codigo',
		),*/
		
		array(
			'header'=>'',
			'type'=>'raw',
			//'value'=>'CHtml::link("ver","#",array("onclick"=>\'newRow("\'.$data->Almacen->id.\'");\'))',
			'value'=>'CHtml::link("ver","#")',
		),
		
	)
)); 
?>
</div>