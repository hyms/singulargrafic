<div class="form">
<h2>Producto</h2>
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'venta-producto-form',
		'htmlOptions'=>array(
				'class'=>'form-horizontal',
				'role'=>'form'
		),
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// See class documentation of CActiveForm for details on this,
		// you need to use the performAjaxValidation()-method described there.
		'enableAjaxValidation'=>false,
));
?>
<div class="form-group">
	<div class="form-group col-md-3">
		<?php echo $form->labelEx($model,'codigo',array('class'=>'col-md-4 control-label')); ?>
		<div class="col-md-8">
			<?php echo $form->textField($model,'codigo',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'codigo'); ?>
	</div>
	<div class="form-group col-md-3">
		<?php echo $form->labelEx($model,'codigo',array('class'=>'col-md-4 control-label')); ?>
		<div class="col-md-8">
			<?php echo $form->textField($model,'codigo',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'codigo'); ?>
	</div>
	<div class="form-group col-md-3">
		<?php echo $form->labelEx($model,'codigo',array('class'=>'col-md-4 control-label')); ?>
		<div class="col-md-8">
			<?php echo $form->textField($model,'codigo',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'codigo'); ?>
	</div>
	<div class="form-group col-md-3">
		<?php echo $form->labelEx($model,'codigo',array('class'=>'col-md-4 control-label')); ?>
		<div class="col-md-8">
			<?php echo $form->textField($model,'codigo',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'codigo'); ?>
	</div>
</div>
<div class="form-group">
	<?php echo CHtml::Button('Añadir',array('class'=>'btn btn-default')); ?>
</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->