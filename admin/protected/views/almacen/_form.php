<?php
/* @var $this AlmacenController */
/* @var $model Almacen */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'almacen-form',
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

	<?php echo $form->errorSummary($model,'', '', array('class' => 'alert alert-danger')); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idProducto',array('class'=>'col-xs-2 control-label')); ?>
		<div class="col-xs-3">
		<?php echo $form->dropDownList($model,'idProducto', 
				CHtml::listData(Producto::model()->with('Material')->findAll(), 'id', 'codigo'), array('empty'=>'Seleccione Producto','class'=>'form-control'));?>
		</div>
		<?php echo $form->error($model,'idProducto',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idTipoAlmacen',array('class'=>'col-xs-2 control-label')); ?>
		<div class="col-xs-3">
		<?php echo $form->dropDownList($model,'idTipoAlmacen', CHtml::listData(TipoAlmacen::model()->findAll(), 'id', 'nombre'), array('empty'=>'Seleccione Tipo','class'=>'form-control'));?>
		</div>
		<?php echo $form->error($model,'idTipoAlmacen',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'stockUnidad',array('class'=>'col-xs-2 control-label')); ?>
		<div class="col-xs-2">
		<?php echo $form->textField($model,'stockUnidad',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'stockUnidad',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'stockPaquete',array('class'=>'col-xs-2 control-label')); ?>
		<div class="col-xs-2">
		<?php echo $form->textField($model,'stockPaquete',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'stockPaquete',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-xs-offset-2')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->