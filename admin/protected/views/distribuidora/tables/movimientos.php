<div class="panel panel-default">
	<div class="panel-body" style="overflow: auto;">
		<div class="form-group hidden-print">
			<?php if($cf!="" && $sf!=""){?>
			    <?php echo CHtml::link('Con Factura', $cf, array("class"=>"btn btn-default")); ?>
			    <?php echo CHtml::link('Sin Factura', $sf, array("class"=>"btn btn-default")); ?>
			    <?php echo CHtml::link('<span class="glyphicon glyphicon-save"></span>', array("distribuidora/reportDate","excel"=>true), array("class"=>"btn btn-default","title"=>"Descargar Excel")); ?>
			<?php }?>
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
					'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-list-alt\"></span>", array("distribuidora/ventaView","id"=>$data->idVenta), array("class" => "openDlg divDialog","title"=>"Nota de Venta"))',
			),
		)
	));
?>

<?php 
	$datos=$ventas->searchDistribuidora();
	$datos->Pagination=false;
	$datos=$datos->getData();
	$totalVenta=0; $totalSingular=0;
	foreach ($datos as $item)
	{
		$dato=$item->montoPagado-$item->montoCambio;
		if($dato>0)
            $totalVenta = $totalVenta+$dato;
        if($item->idCliente0->nitCi=="000")
        {
            $dato=$item->idCajaMovimientoVenta0->monto;
            if($dato>0)
                $totalSingular = $totalSingular+$dato;
        }
	}
?>
	</div>
	
	<div class="well well-sm col-xs-offset-8 col-xs-4">
		<span><strong>Total Venta:</strong> <?php echo $totalVenta; ?> Bs.</span>
	</div>
    <div class="well well-sm col-xs-offset-8 col-xs-4">
        <span><strong>Total Venta Singular:</strong> <?php echo $totalSingular; ?> Bs.</span>
    </div>
	<?php if(!empty($saldo)){?>
	<div class="well well-sm col-xs-offset-8 col-xs-4">
		<span><strong>Saldo:</strong> <?php echo $saldo; ?> Bs.</span>
	</div>
	<?php }?>
</div>

<?php
    $this->renderPartial("scripts/modal");

    $this->beginWidget('zii.widgets.jui.CJuiDialog', array('id'=>'divDialog',
    'options'=>array( 'title'=>'Detalle de Venta', 'autoOpen'=>false, 'modal'=>true, 'width'=>800)));
?>
    <div class="divForForm"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>