<div class="col-sm-2">
	<?php $this->renderPartial('menu')?>
</div>
<div class="col-sm-10">
	<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Ventas de Hoy', 'url'=>array('report/ventaSingular','d'=>date('d'))),
							array('label'=>'Ventas de Ayer', 'url'=>array('report/ventaSingular','d'=>(date('d')-1))),
							array('label'=>'Ventas del Mes', 'url'=>array('report/ventaSingular','m'=>date('m'))),
							array('label'=>'Todas las Ventas', 'url'=>array('report/ventaSingular','t'=>'all')),
						),
				)); 


?>
	
	
	<div class="row">
<div class="text-center">

<?php echo CHtml::link('Con Factura', $cf, array("class"=>"btn btn-default hidden-print")); ?>
<?php echo CHtml::link('Sin Factura', $sf, array("class"=>"btn btn-default hidden-print")); ?>
<?php //echo CHtml::link('Imprimir', array("#"), array("class"=>"btn btn-default hidden-print")); ?>
</div>
</div>
<div  style="height:500px; overflow:auto;">
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
			),
			array(
					'header'=>'NitCI',
					'type'=>'raw',
					'value'=>'$data->idCliente0->nitCi',
			),
			array(
					'header'=>'Monto de la Venta',
					'type'=>'raw',
					'value'=>'$data->idCajaMovimientoVenta0->monto',
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
					'value'=>'CHtml::link("Detalle", array("report/ventaDetalle","id"=>$data->idVenta), array("class" => "openDlg divDialog"))',
			),
		)
	));
?>
</div>
<?php 
//$datos=$ventas->getData();
$datos=$ventas->searchDistribuidora();
$datos->Pagination=false;
$datos=$datos->getData();
$total=0;
foreach ($datos as $item)
{
	$dato=$item->idCajaMovimientoVenta0->monto;
	if($dato>0)
		$total = $total+$dato;
}
//print_r(count($datos));
?>
<div class="col-xs-offset-8 col-xs-4">
<div class="well well-sm">
	<span><strong>Total:</strong> <?php echo $total; ?> Bs.</span>
</div>
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