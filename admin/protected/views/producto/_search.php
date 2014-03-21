<?php
/* @var $this ProductoController */
/* @var $model Producto */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'peso'); ?>
		<?php echo $form->textField($model,'peso',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idColor'); ?>
		<?php echo $form->textField($model,'idColor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dimension'); ?>
		<?php echo $form->textField($model,'dimension',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idProcedencia'); ?>
		<?php echo $form->textField($model,'idProcedencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'costoSF'); ?>
		<?php echo $form->textField($model,'costoSF'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'costoSFUnidad'); ?>
		<?php echo $form->textField($model,'costoSFUnidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'costoCF'); ?>
		<?php echo $form->textField($model,'costoCF'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'costoCFUnidad'); ?>
		<?php echo $form->textField($model,'costoCFUnidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idIndustria'); ?>
		<?php echo $form->textField($model,'idIndustria'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'obs'); ?>
		<?php echo $form->textField($model,'obs',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->