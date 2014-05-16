<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>
<div class="col-sm-10">
<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$ventas->searchVenta(),
		'filter'=>$ventas,
		'ajaxUpdate'=>true,
		//'afterAjaxUpdate' => 'reinstallDatePicker',
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
								'attribute'=>'fechaVenta',
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
			array(
					'header'=>'codigo',
					'type'=>'raw',
					'value'=>'$data->serie." ".$data->codigo',
					'filter'=>CHtml::activeTextField($ventas, 'codigos',array("class"=>"form-control input-sm")),
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("Modificar","#")',
			),
		)
	));
?>
</div>
<?php 
/*Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_due_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['es'],{'dateFormat':'yy/mm/dd'}));
}
");*/
?>