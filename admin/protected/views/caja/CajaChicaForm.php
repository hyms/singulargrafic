<div class="col-xs-2">
<?php $this->renderPartial('menu');?>
</div>
<div class="col-xs-10">
<?php $this->renderPartial('cajaChica/menu');?>

<h2>Nueva Caja Chica</h2>
<?php
/* @var $this CajaChicaController */
/* @var $model CajaChica */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'caja-chica-CajaChicaForm-form',
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
		<?php echo $form->labelEx($model,'saldo',array('class'=>'col-xs-2 control-label')); ?>
		<div class="col-xs-4">
		<?php echo $form->textField($model,'saldo',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'saldo'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idUser',array('class'=>'col-xs-2 control-label')); ?>
		<div class="col-xs-4">
		<?php echo $form->dropDownList($model,'idUser',CHtml::listData(Users::model()->findAll(),'idUser','username'),array('class'=>'form-control','empty'=>'Seleccione Usuario'))?>
		</div>
		<?php echo $form->error($model,'idUser'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idCaja',array('class'=>'col-xs-2 control-label')); ?>
		<div class="col-xs-4">
		<?php echo $form->dropDownList($model,'idCaja',CHtml::listData(Caja::model()->findAll(),'idCaja','nombre'),array('class'=>'form-control','empty'=>'Seleccione Caja'))?>
		</div>
		<?php echo $form->error($model,'idCaja'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'maximo',array('class'=>'col-xs-2 control-label')); ?>
		<div class="col-xs-4">
		<?php echo $form->textField($model,'maximo',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'maximo'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'detalle',array('class'=>'col-xs-2 control-label')); ?>
		<div class="col-xs-4">
		<?php echo $form->textField($model,'detalle',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'detalle'); ?>
	</div>


	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-xs-offset-2')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
