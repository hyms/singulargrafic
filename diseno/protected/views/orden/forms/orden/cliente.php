<div class="form-group col-xs-6">
	<?php echo CHtml::activeLabelEx($cliente,'nitCi',array('class'=>'control-label col-xs-4')); ?>
	<div class="col-xs-8">
		<?php echo CHtml::activeTextField($cliente,'nitCi',array('class'=>'form-control input-sm',"id"=>"NitCi")); ?>
	</div>
	<?php echo CHtml::error($cliente,'nitCi',array('class'=>'label label-danger')); ?>
</div>
<div class="form-group col-xs-6">
	<?php echo CHtml::activeLabelEx($cliente,'apellido',array('class'=>'control-label col-xs-4')); ?>
	<div class="col-xs-8">
		<?php echo CHtml::activeTextField($cliente,'apellido',array('class'=>'form-control input-sm',"id"=>"apellido",'readonly'=>true)); ?>
	</div>
	<?php echo CHtml::error($cliente,'apellido',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group col-xs-6">
	<?php echo CHtml::activeLabelEx($ctp,'responsable',array('class'=>'control-label col-xs-4')); ?>
	<div class="col-xs-8">
		<?php echo CHtml::activeTextField($ctp,'responsable',array('class'=>'form-control input-sm')); ?>
	</div>
	<?php echo CHtml::error($ctp,'responsable',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group col-xs-6">
	<?php echo CHtml::activeLabelEx($cliente,'telefono',array('class'=>'control-label col-xs-4')); ?>
	<div class="col-xs-8">
		<?php echo CHtml::activeTextField($cliente,'telefono',array('class'=>'form-control input-sm')); ?>
	</div>
	<?php echo CHtml::error($cliente,'telefono',array('class'=>'label label-danger')); ?>
</div>
<?php
$this->renderPartial('scripts/cliente');
