<?php
/* @var $this CajaController */
/* @var $model Caja */
/* @var $form CActiveForm */
?>
<div class="col-xs-2">
<?php $this->renderPartial('menu');?>
</div>
<div class="col-xs-10">
<h2>Caja</h2>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'caja-cajaForm-form',
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form'
	),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nombre',array('class'=>'col-xs-2 control-label')); ?>
		<div class="col-xs-4">
		<?php echo $form->textField($model,'nombre',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idParent',array('class'=>'col-xs-2 control-label')); ?>
		<div class="col-xs-4">
		<?php echo $form->dropDownList($model,'idParent',$model->getCajas(),array('class'=>'form-control','empty'=>"Seleccione Caja")); ?>
		</div>
		<?php echo $form->error($model,'idParent'); ?>
	</div>
	
	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-xs-offset-2')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>