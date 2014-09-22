<?php if(!empty($cond3)){?>
<div class="form-group hidden-print">
    <?php if($cf!="" && $sf!=""){?>
        <?php echo CHtml::link('Con Factura', $cf, array("class"=>"btn btn-default hidden-print")); ?>
        <?php echo CHtml::link('Sin Factura', $sf, array("class"=>"btn btn-default hidden-print")); ?>
        <?php echo CHtml::link('Imprimir', $cond3, array("class"=>"btn btn-default hidden-print")); ?>
    <?php }?>
</div>

<div  style="height:500px; overflow:auto;">
<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$ventas->searchCTP(),
		'filter'=>$ventas,
		'ajaxUpdate'=>false,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
			array(
					'header'=>'Nro',
					'value'=>'($row+1)',
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
					'value'=>'$data->fechaOrden',
					'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
										'name'=>'fechaOrden',
										'attribute'=>'fechaOrden',
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
			/*array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("Detalle", array("ctp/ventaDetalle","id"=>$data->idVenta), array("class" => "openDlg divDialog"))',
			),*/
		)
	));
?>
</div>
<?php 
$datos=$ventas->searchCTP();
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

    <div class="well well-sm col-xs-offset-8 col-xs-4">
        <span><strong>Total:</strong> <?php echo $total; ?> Bs.</span>
    </div>
    <?php if(!empty($saldo)){?>
    <div class="well well-sm col-xs-offset-8 col-xs-4">
        <span><strong>Saldo:</strong> <?php echo $saldo; ?> Bs.</span>
    </div>
    <?php }?>

<?php
    $this->renderPartial("scripts/modal");
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array('id'=>'divDialog',
    'options'=>array( 'title'=>'Detalle de Orden', 'autoOpen'=>false, 'modal'=>true, 'width'=>800)));
?>
    <div class="divForForm"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>

</div>
<?php }?>