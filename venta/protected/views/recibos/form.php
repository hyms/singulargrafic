<div class="form-group" >
	<?php echo CHtml::activeLabelEx($model,'monto',array('class'=>'control-label col-xs-2')); ?>
	<div class="col-xs-2">
		<?php echo CHtml::activeTextField($model,'monto',array('class'=>'form-control ',"id"=>"concepto")); ?>
	</div>
	<?php echo CHtml::error($model,'monto',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group" >
	<?php echo CHtml::activeLabelEx($model,'motivo',array('class'=>'control-label col-xs-2')); ?>
	<div class="col-xs-8">
		<?php echo CHtml::activeTextArea($model,'motivo',array('class'=>'form-control ',"id"=>"concepto")); ?>
	</div>
	<?php echo CHtml::error($model,'motivo',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group">
	<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-xs-offset-5')); ?>
</div>