<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
<?php $this->renderPartial('menuMovimientos');?>
<div class="row">
<div class="text-center">
<?php if($cf!="" && $sf!=""){?>
<?php echo CHtml::link('Con Factura', $cf, array("class"=>"btn btn-default hidden-print")); ?>
<?php echo CHtml::link('Sin Factura', $sf, array("class"=>"btn btn-default hidden-print")); ?>
<?php echo CHtml::link('Imprimir', $cond3, array("class"=>"btn btn-default hidden-print")); ?>
<?php }?>
</div>
</div>


<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		//'dataProvider'=>$ventas,
		'dataProvider'=>$ventas->searchDistribuidora(),
		'filter'=>$ventas,
		'ajaxUpdate'=>false,
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
					'value'=>'$data->codigo',
			),
			array(
					'header'=>'Apellido',
					'type'=>'raw',
					'value'=>'$data->idCliente0->apellido',
					'filter'=>CHtml::activeTextField($ventas, 'apellido',array("class"=>"form-control input-sm")),
			),
			array(
					'header'=>'NitCI',
					'type'=>'raw',
					'value'=>'$data->idCliente0->nitCi',
					'filter'=>CHtml::activeTextField($ventas, 'nit',array("class"=>"form-control input-sm")),
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
					'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
										'name'=>'fechaVenta',
										'attribute'=>'fechaVenta',
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
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("Detalle", array("distribuidora/ventaDetalle","id"=>$data->idVenta), array("class" => "openDlg divDialog"))',
			),
		)
	));
?>

<?php 
//$datos=$ventas->getData();
$datos=$ventas->searchDistribuidora();
$datos->Pagination=false;
$datos=$datos->getData();
$total=0;
foreach ($datos as $item)
{
	$dato=$item->montoPagado-$item->montoCambio;
	if($dato>0)
		$total = $total+$dato;
}
//print_r(count($datos));
?>
<div class="col-xs-offset-8 col-xs-4">
<div class="well well-sm">
	<span><strong>Total:</strong> <?php echo $total; ?> Bs.</span>
</div>
<?php if(!empty($saldo)){?>
<div class="well well-sm">
	<span><strong>Saldo:</strong> <?php echo $saldo; ?> Bs.</span>
</div>
<?php }?>
</div>

<?php
Yii::app()->clientScript->registerScript('row',"
$('#document').ready(function(){
	$('.openDlg').click(function(){
		var dialogId = $(this).attr('class').replace('openDlg ', '');
		$.ajax({
			'type': 'GET',
			'url' : $(this).attr('href'),
			success: function (data) {
				 
				$('#'+dialogId+' div.divForForm').html(data);
				$( '#'+dialogId ).dialog( 'open' );
			},
			dataType: 'html',
		});
		return false; // prevent normal submit
	})
}); 
",CClientScript::POS_READY);?>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array('id'=>'divDialog',
    'options'=>array( 'title'=>'Detalle de Venta', 'autoOpen'=>false, 'modal'=>true, 'width'=>800)));
?>
    <div class="divForForm"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>

</div>

