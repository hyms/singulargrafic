<?php
/* @var $this MovimientoAlmacenController */
/* @var $model MovimientoAlmacen */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'movimiento-almacen-movimientoAlamacen-form',
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
		<?php echo $form->labelEx($model,'unidad',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'unidad',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'unidad'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'paquete',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'paquete',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'paquete'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'estado',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'estado',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'fechaInicio',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'fechaInicio',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'fechaInicio'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'fechaFinal',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'fechaFinal',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'fechaFinal'); ?>
	</div>


	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-2')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
