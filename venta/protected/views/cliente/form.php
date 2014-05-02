<?php
/* @var $this ClienteController */
/* @var $model Cliente */
/* @var $form CActiveForm */
$this->breadcrumbs=array(
	'Registro',
);
?>
<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>
<div class="form col-sm-10">
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="panel-title"><strong>Registro Cliente</strong></span>
	</div>
  	<div class="panel-body" style="overflow: auto;">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cliente-Cliente-form',
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

	<?php echo $form->errorSummary($model,'', '', array('class' => 'alert alert-danger')); ?>

	<div class="form-group">
		<div class="col-sm-6">
		<?php echo $form->labelEx($model,'nitCi',array('class'=>'col-sm-4 control-label')); ?>
		<div class="col-sm-5">
		<?php echo $form->textField($model,'nitCi',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'nitCi',array('class'=>'label label-danger')); ?>
		</div>
	</div>
	<div class="form-group">
	<div class="col-sm-6">
		<?php echo $form->labelEx($model,'apellido',array('class'=>'col-sm-4 control-label')); ?>
		<div class="col-sm-8">
		<?php echo $form->textField($model,'apellido',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'apellido',array('class'=>'label label-danger')); ?>
	</div>

	<div class="col-sm-6">
		<?php echo $form->labelEx($model,'nombre',array('class'=>'col-sm-4 control-label')); ?>
		<div class="col-sm-8">
		<?php echo $form->textField($model,'nombre',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'nombre',array('class'=>'label label-danger')); ?>
	</div>
	</div>
	<div class="form-group">
	<div class="col-sm-6">
		<?php echo $form->labelEx($model,'correo',array('class'=>'col-sm-4 control-label')); ?>
		<div class="col-sm-8">
		<?php echo $form->textField($model,'correo',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'correo',array('class'=>'label label-danger')); ?>
	</div>

	<div class="col-sm-6">
		<?php echo $form->labelEx($model,'telefono',array('class'=>'col-sm-4 control-label')); ?>
		<div class="col-sm-6">
		<?php echo $form->textField($model,'telefono',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'telefono',array('class'=>'label label-danger')); ?>
	</div>
	</div>
	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-3 hidden-print')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>