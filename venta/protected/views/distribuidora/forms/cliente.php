<div class="form-group col-sm-6">
	<?php echo CHtml::activeLabelEx($cliente,'nitCi',array('class'=>'control-label col-sm-4')); ?>
	<div class="col-sm-8">
		<?php echo CHtml::activeTextField($cliente,'nitCi',array('class'=>'form-control input-sm',"id"=>"NitCi")); ?>
	</div>
	<?php echo CHtml::error($cliente,'nitCi',array('class'=>'label label-danger')); ?>
</div>
<div class="form-group col-sm-6">
	<?php echo CHtml::activeLabelEx($cliente,'apellido',array('class'=>'control-label col-sm-4')); ?>
	<div class="col-sm-8">
		<?php echo CHtml::activeTextField($cliente,'apellido',array('class'=>'form-control input-sm',"id"=>"apellido",'readonly'=>true)); ?>
	</div>
	<?php echo CHtml::error($cliente,'apellido',array('class'=>'label label-danger')); ?>
</div>
	
<?php $this->renderPartial("scripts/cliente")?>