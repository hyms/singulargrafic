<div class="col-sm-2">
	<?php echo CHtml::activeRadioButtonList($ctp,'formaPago',array('Contado','Credito'))?>
</div>
<div class="col-sm-2">
	<?php echo CHtml::activeRadioButtonList($ctp,'tipoOrden',array('Con Factura','Sin Factura'))?>
</div>
<div class="col-sm-4">
	<div class="form-group">
		<?php echo CHtml::activeLabelEx($ctp,'fechaPlazo',array('class'=>'col-sm-5 control-label')); ?>
		<div class="col-sm-7">
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	    		'name'=>'fechaPlazo',
				'attribute'=>'fechaPlazo',
				'language'=>'es',
			    'model'=>$ctp,
			    'options'=>array(
			        'showAnim'=>'fold',
					'dateFormat'=>'dd-mm-yy',
			    ),
			    'htmlOptions'=>array(
			        'class'=>'form-control input-sm',
					'disabled'=>(($ctp->formaPago==0)?true:false),
			    ),
			));
		?>
		</div>
		<?php echo CHtml::error($ctp,"fechaPlazo",array('class'=>'label label-danger')); ?>
	</div>
	<div class="form-group">
		<?php echo CHtml::activeLabelEx($ctp,'autorizado',array('class'=>'col-sm-5 control-label')); ?>
		<div class="col-sm-7">
		<?php echo CHtml::activeDropDownList($ctp, 'autorizado',array('Erick Paredes','Miriam Martinez'),array('class'=>'form-control input-sm','disabled'=>(($ctp->formaPago==0)?true:false),'id'=>"autorizado",'empty' => 'Selecciona Responsable')); ?>
	   	</div>
	</div>
</div>
<div class="col-sm-4">
	<div class="form-group ">
		<div class="col-sm-7">
		<?php echo CHtml::checkBoxList('Descuento',false,array('Descuento')); ?>
		</div>
		<div class="col-sm-5">
		<?php echo CHtml::activeTextField($ctp,'montoDescuento',array('class'=>'form-control input-sm','disabled'=>(empty($ctp->montoDescuento)?true:false),'id'=>'descuento')); ?>
		</div>
	</div>
	<div class="form-group ">
		<div class="col-sm-5">
		<?php echo CHtml::activeLabelEx($ctp,'factura',array('class'=>'col-sm-5 control-label')); ?>
		</div>
		<div class="col-sm-7">
		<?php echo CHtml::activeTextField($ctp,'factura',array('class'=>'form-control input-sm','disabled'=>(($ctp->tipoOrden==0)?false:(empty($ctp->factura)?true:false)),'id'=>'factura')); ?>
		</div>
	</div>
</div>

<?php 
Yii::app()->getClientScript()->registerScript("check","
function factura()
{
	$('form').attr('action', '".CHtml::normalizeUrl(array('/ctp/factura','id'=>$ctp->idCTP))."');
   	$('form').submit();
}

function formaPago(value)
{
	$('#fechaPlazo').prop('disabled', value);
	$('#autorizado').prop('disabled', value);
}
					
$('#CTP_tipoOrden_0').change(function(){
	factura();
});
			
$('#CTP_tipoOrden_1').change(function(){
	factura();
});
					
$('#CTP_formaPago_0').change(function(){
	formaPago(true);
});

$('#CTP_formaPago_1').change(function(){
	formaPago(false);
});
				
$('#Descuento_0').change(function(){
	var value;
	if($('#Descuento_0').is(':checked'))
	{
		value = false;
		$('#total').val(resta($('#total').val(),$('#descuento').val()).toFixed(1));
		cambio();
	}
	else
	{
		value = true;
		calcular_total()
	}			
	$('#descuento').prop('disabled', value);
});

$('#descuento').blur(function(e){
	$('#total').val(resta($('#total').val(),$('#descuento').val()).toFixed(1));
	cambio();
});		
",CClientScript::POS_READY);?>