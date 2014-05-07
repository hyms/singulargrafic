<div class="form-group" >
<div class="col-sm-8">
	<?php echo CHtml::activeLabelEx($recibo,'concepto',array('class'=>'control-label col-sm-3')); ?>
	<div class="col-sm-9">
		<?php echo CHtml::activeTextArea($recibo,'concepto',array('class'=>'form-control ',"id"=>"concepto")); ?>
	</div>
	<?php echo CHtml::error($recibo,'concepto',array('class'=>'label label-danger')); ?>
</div>
</div>
<div class="form-group" >
<div class="col-sm-4">
	<?php echo CHtml::activeLabelEx($recibo,'categoria',array('class'=>'control-label col-sm-3')); ?>
	<div class="col-sm-9">
		<?php echo CHtml::activeTextField($recibo,'categoria',array('class'=>'form-control ',"id"=>"categoria")); ?>
	</div>
	<?php echo CHtml::error($recibo,'categoria',array('class'=>'label label-danger')); ?>
</div>
<div class="col-sm-4">
	<?php echo CHtml::activeLabelEx($recibo,'nro',array('class'=>'control-label col-sm-3')); ?>
	<div class="col-sm-9">
		<?php echo CHtml::activeTextField($recibo,'nro',array('class'=>'form-control ',"id"=>"codigo")); ?>
	</div>
	<?php echo CHtml::error($recibo,'nro',array('class'=>'label label-danger')); ?>
</div>
</div>

<div class="form-group" >
<div class="col-sm-4">
	<?php echo CHtml::activeLabelEx($recibo,'monto',array('class'=>'control-label col-sm-3')); ?>
	<div class="col-sm-9">
		<?php echo CHtml::activeTextField($recibo,'monto',array('class'=>'form-control ',"id"=>"monto")); ?>
	</div>
	<?php echo CHtml::error($recibo,'monto',array('class'=>'label label-danger')); ?>
</div>
<div class="col-sm-4">
	<?php echo CHtml::activeLabelEx($recibo,'acuenta',array('class'=>'control-label col-sm-3')); ?>
	<div class="col-sm-9">
		<?php echo CHtml::activeTextField($recibo,'acuenta',array('class'=>'form-control ',"id"=>"acuenta")); ?>
	</div>
	<?php echo CHtml::error($recibo,'acuenta',array('class'=>'label label-danger')); ?>
</div>
<div class="col-sm-4">
	<?php echo CHtml::activeLabelEx($recibo,'saldo',array('class'=>'control-label col-sm-3')); ?>
	<div class="col-sm-9">
		<?php echo CHtml::activeTextField($recibo,'saldo',array('class'=>'form-control ',"id"=>"saldo","readonly"=>true)); ?>
	</div>
	<?php echo CHtml::error($recibo,'saldo',array('class'=>'label label-danger')); ?>
</div>
</div>
<div class="form-group" >
<div class="col-sm-8">
	<?php echo CHtml::activeLabelEx($recibo,'obs',array('class'=>'control-label col-sm-3')); ?>
	<div class="col-sm-9">
		<?php echo CHtml::activeTextField($recibo,'obs',array('class'=>'form-control ')); ?>
	</div>
	<?php echo CHtml::error($recibo,'obs',array('class'=>'label label-danger')); ?>
</div>
</div>
<div class="form-group">
	<?php echo CHtml::submitButton('Continuar',array('class'=>'btn btn-default col-sm-offset-5')); ?>
</div>
<?php Yii::app()->getClientScript()->registerScript("saldo",
"
	function resta(a,b)
	{
		return (a*1)-(b*1);
	}
			
	$('#acuenta').blur(function(e){
			
			$('#saldo').val(resta($('#monto').val(),$('#acuenta').val()).toFixed(2));
	});		
",CClientScript::POS_READY); ?>