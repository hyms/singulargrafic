<div class="table-responsive">
<table id="yw3" class="table table-condensed">
	<thead class="tabular-header"><tr>
		<td><?php echo CHtml::label('Nº','number')?></td>
		<td><?php echo CHtml::label('Formato','formato')?></td>
		<td><?php echo CHtml::label('Nº de placas','nro placas')?></td>
		<td><?php echo CHtml::label('Full','f')?></td>
		<td><?php echo CHtml::label('C','c')?></td>
		<td><?php echo CHtml::label('M','m')?></td>
		<td><?php echo CHtml::label('Y','y')?></td>
		<td><?php echo CHtml::label('B','k')?></td>
		<td><?php echo CHtml::label('Trabajo','trabajo')?></td>
		<td><?php echo CHtml::label('Pinza','pinza')?></td>
		<td><?php echo CHtml::label('Resolucion','resolucion')?></td>
		<td><?php echo CHtml::label('Adicional','adicional')?></td>
		<?php /*?><td><?php echo CHtml::label('Total','total')?></td><?php */?>
       	<td></td>
 	</tr></thead>
<tbody class="tabular-input-container">
<?php

if(count($detalle)>=1)
{
	if(!isset($detalle->isNewRecord))
	{
		$i=0;
		
		foreach ($detalle as $item)
		{
			if($item->idAlmacenProducto!=null)
			{
				$this->renderPartial('./orden/_newRowDetalleVenta', array(
						'model'=>$item,
						'index'=>$i,
						'costo'=>0,
						'almacen'=>AlmacenProducto::model()
									->with("idProducto0")
									->findByPk($item->idAlmacenProducto),
				));
				$i++;
			}
		}
	}
}
?>
</tbody></table>
</div>
<div class="form-group">
<div class="col-sm-7">
    <?php echo CHtml::activeLabelEx($ctp,"obs",array('class'=>'control-label col-sm-4'))?>
    <div class="col-sm-8">
	<?php echo CHtml::activeTextArea($ctp,"obs",array('class'=>'form-control'))?>
	</div>
	 <?php echo CHtml::error($ctp,"obs",array('class'=>'label label-danger')); ?>
</div>
<div class="col-sm-5" >
	<div class="form-group">
		<?php echo CHtml::activeLabelEx($ctp,"fechaEntega",array('class'=>'control-label col-sm-5'))?>
	    <div class="col-sm-7">
	    	<?php //echo CHtml::activeTextField($ctp,"fechaEntega",array('class'=>'form-control input-sm','readonly'=>true,"id"=>"total")); ?>
	    	<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'name'=>'fechaEntega',
								'attribute'=>'fechaEntega',
	    						'language'=>'es',
								'model'=>$ctp,
								'options'=>array(
										'showAnim'=>'fold',
										'dateFormat'=>'yy-mm-d',
								),
								'htmlOptions'=>array(
										'class'=>'form-control input-sm',
								),
							)); ?>
	    </div>
	    <?php echo CHtml::error($ctp,"fechaEntega",array('class'=>'label label-danger')); ?>
	</div>
</div>
<?php /*?>
<div class="col-sm-5" >
	<div class="form-group">
		<?php echo CHtml::activeLabelEx($ctp,"montoVenta",array('class'=>'control-label col-sm-4'))?>
	    <div class="col-sm-8">
	    	<?php echo CHtml::activeTextField($ctp,"montoVenta",array('class'=>'form-control input-sm','readonly'=>true,"id"=>"total")); ?>
	    </div>
	    <?php echo CHtml::error($ctp,"montoVenta",array('class'=>'label label-danger')); ?>
	</div>
</div>

<?php */?>
</div>
<?php Yii::app()->getClientScript()->registerScript("ajax_total",
"
   	function calcular_total() {
		importe_total = 0
		$('.costo*').each(
			function(index, value) {
				importe_total = importe_total + parseFloat($(this).val()*1);
			}
		);
		$('#total').val(parseFloat(importe_total).toFixed(1));
		cambio();
	}
	
	function suma(a,b)
	{
		return ((a*1) + (b*1));
	}
	
	function resta(a,b)
	{
		return ((a*1) - (b*1));
	}
   
",CClientScript::POS_HEAD); ?>

<?php Yii::app()->getClientScript()->registerScript("ajax_detalleventa","
	
	$(\"#yw3 .tabular-input-remove\").live(\"click\", function(event) {
		event.preventDefault();
		$(this).parents(\".tabular-input:first\").remove();
		$('.tabular-input-container').filter(function(){return $.trim($(this).text())==='' && $(this).children().length == 0}).siblings('.tabular-header').hide();
	});
",CClientScript::POS_READY); ?>