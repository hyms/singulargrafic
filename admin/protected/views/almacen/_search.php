<?php
/* @var $this AlmacenController */
/* @var $model Almacen */
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
		<?php echo $form->label($model,'idProducto'); ?>
		<?php echo $form->textField($model,'idProducto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idTipoAlmacen'); ?>
		<?php echo $form->textField($model,'idTipoAlmacen'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stockUnidad'); ?>
		<?php echo $form->textField($model,'stockUnidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stockPaquete'); ?>
		<?php echo $form->textField($model,'stockPaquete'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->