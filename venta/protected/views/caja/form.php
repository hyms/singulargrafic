<div class="form-group" >
	<?php echo CHtml::activeLabelEx($model,'detalle',array('class'=>'control-label col-sm-2')); ?>
	<div class="col-sm-8">
		<?php echo CHtml::activeTextField($model,'detalle',array('class'=>'form-control ',"id"=>"concepto")); ?>
	</div>
	<?php echo CHtml::error($model,'detalle',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group" >
	<?php echo CHtml::activeLabelEx($model,'factura',array('class'=>'control-label col-sm-2')); ?>
	<div class="col-sm-4">
		<?php echo CHtml::activeTextField($model,'factura',array('class'=>'form-control ',"id"=>"concepto")); ?>
	</div>
	<?php echo CHtml::error($model,'factura',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group" >
	<?php echo CHtml::activeLabelEx($model,'idTipoMovimiento',array('class'=>'control-label col-sm-2')); ?>
	<div class="col-sm-5">
		<?php echo CHtml::activeDropDownList($model,'idTipoMovimiento',array(),array('class'=>'form-control ',"id"=>"concepto")); ?>
	</div>
	<?php echo CHtml::error($model,'idTipoMovimiento',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group" >
	<?php echo CHtml::activeLabelEx($model,'monto',array('class'=>'control-label col-sm-2')); ?>
	<div class="col-sm-2">
		<?php echo CHtml::activeTextField($model,'monto',array('class'=>'form-control ',"id"=>"concepto")); ?>
	</div>
	<?php echo CHtml::error($model,'monto',array('class'=>'label label-danger')); ?>
</div>
<div class="form-group" >
	<?php echo CHtml::activeLabelEx($model,'Obs',array('class'=>'control-label col-sm-2')); ?>
	<div class="col-sm-8">
		<?php echo CHtml::activeTextArea($model,'Obs',array('class'=>'form-control ',"id"=>"concepto")); ?>
	</div>
	<?php echo CHtml::error($model,'Obs',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group">
	<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-5')); ?>
</div>