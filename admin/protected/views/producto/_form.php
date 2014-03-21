<?php
/* @var $this ProductoController */
/* @var $model Producto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'producto-form',
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form'
	),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'codigo',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
			<?php echo $form->textField($model,'codigo',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'codigo'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'idMaterial',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->dropDownList($model,'idMaterial', CHtml::listData(Material::model()->findAll(), 'id', 'nombre'), array('empty'=>'Seleccione Material','class'=>'form-control'));?>
		</div>
		<?php echo $form->error($model,'idMaterial'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'peso',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-1">
		<?php echo $form->textField($model,'peso',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'peso'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idColor',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->dropDownList($model,'idColor', CHtml::listData(Color::model()->findAll(), 'id', 'nombre'), array('empty'=>'Seleccione Material','class'=>'form-control'));?>
		</div>
		<?php echo $form->error($model,'idColor'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'dimension',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->textField($model,'dimension',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'dimension'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'procedencia',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->textField($model,'procedencia',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'procedencia'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'costoSF',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-1">
		<?php echo $form->textField($model,'costoSF',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'costoSF'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'costoSFUnidad',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-1">
		<?php echo $form->textField($model,'costoSFUnidad',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'costoSFUnidad'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'costoCF',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-1">
		<?php echo $form->textField($model,'costoCF',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'costoCF'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'costoCFUnidad',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-1">
		<?php echo $form->textField($model,'costoCFUnidad',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'costoCFUnidad'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idIndustria',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->dropDownList($model,'idIndustria', CHtml::listData(Industria::model()->findAll(), 'id', 'nombre'), array('empty'=>'Seleccione Material','class'=>'form-control'));?>
		</div>
		<?php echo $form->error($model,'idIndustria'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'cantidad',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-1">
		<?php echo $form->textField($model,'cantidad',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'obs',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textArea($model,'obs',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'obs'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-2')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->