<?php
/* @var $this VentaTmpController */
/* @var $model VentaTmp */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'venta-venta-form',
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

$model->fechaModifcacion = date("d/m/Y"); 
?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'codigo',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'codigo',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'pago',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'pago',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'pago'); ?>
	</div>
<div class="form-group">
	<div class="form-group col-md-3">
		<?php echo $form->labelEx($model,'idCliente',array('class'=>'col-md-4 control-label')); ?>
		<div class="col-md-8">
		<?php echo $form->textField($model,'idCliente',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'idCliente'); ?>
	</div>
	
	<div class="form-group col-md-3">
	</div>
	
	<div class="form-group col-md-3">
		<?php echo $form->labelEx($model,'idEmpleado',array('class'=>'col-md-4 control-label')); ?>
		<div class="col-md-8">
		<?php echo $form->textField($model,'idEmpleado',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'idEmpleado'); ?>
	</div>
	
	<div class="form-group col-md-3">
		<?php echo CHtml::label($model->fechaModifcacion,'fechaModifcacion',array('class'=>'control-label')); ?>
	</div>
</div>	
	<div class="form-group">
		<?php echo $form->labelEx($model,'obs',array('class'=>'col-md-2 control-label')); ?>
		<div class="col-md-4">
		<?php echo $form->textField($model,'obs',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'obs'); ?>
	</div>


	<div class="form-group">
		<?php echo CHtml::submitButton('Agregar',array('class'=>'btn btn-default col-sm-offset-2')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
