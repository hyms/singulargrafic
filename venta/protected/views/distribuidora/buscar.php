<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>
<div class="col-sm-10">


<div class="panel panel-default">
<div class="panel-heading"><strong class="panel-title">Ventas Realizadas</strong></div>
  <div class="panel-body">
<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$ventas->searchVenta(),
		'filter'=>$ventas,
		'ajaxUpdate'=>true,
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
					'filter'=>CHtml::activeTextField($ventas, 'nit',array("class"=>"form-control input-sm")),
			),
			array(
					'header'=>'Apellido',
					'type'=>'raw',
					'value'=>'$data->idCliente0->apellido',
					'filter'=>CHtml::activeTextField($ventas, 'apellido',array("class"=>"form-control input-sm")),
			),
			array(
					'header'=>'Fecha',
					'type'=>'raw',
					'value'=>'$data->fechaVenta',
					'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'name'=>'fechaVenta',
								'language'=>'es',
								'attribute'=>'fechaVenta',
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
			array(
					'header'=>'codigo',
					'type'=>'raw',
					'value'=>'$data->codigo',
					'filter'=>CHtml::activeTextField($ventas, 'codigo',array("class"=>"form-control input-sm")),
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("Modificar",array("distribuidora/modificar","id"=>$data->idVenta),array("class"=>"hidden-print"))',
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-print\"></span>",array("distribuidora/preview","id"=>$data->idVenta),array("class"=>"hidden-print"))',
			),
		)
	));
?>
</div>
</div>
</div>