<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>
<h1>Empleado <?php echo $empleado->nombre." ".$empleado->apellido;?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-formDate-form',
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
		<?php echo $form->labelEx($model,'estado',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo CHtml::activeRadioButtonList($model,'estado',array('activo','inactivo'))?>
		</div>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'username',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'password',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tipo',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo CHtml::activeDropDownList($model,'tipo',$model->tipos(),array('class'=>'form-control'));?>
		<?php //echo $form->textField($model,'tipo',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'tipo'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-2')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
