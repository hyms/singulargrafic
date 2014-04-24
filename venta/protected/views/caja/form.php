<div class="form-group" >
	<?php echo CHtml::activeLabelEx($model,'monto',array('class'=>'control-label col-sm-2')); ?>
	<div class="col-sm-2">
		<?php echo CHtml::activeTextField($model,'monto',array('class'=>'form-control ',"id"=>"concepto")); ?>
	</div>
	<?php echo CHtml::error($model,'monto',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group" >
	<?php echo CHtml::activeLabelEx($model,'obs',array('class'=>'control-label col-sm-2')); ?>
	<div class="col-sm-8">
		<?php echo CHtml::activeTextField($model,'obs',array('class'=>'form-control ',"id"=>"concepto")); ?>
	</div>
	<?php echo CHtml::error($model,'obs',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group">
	<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-5')); ?>
</div>