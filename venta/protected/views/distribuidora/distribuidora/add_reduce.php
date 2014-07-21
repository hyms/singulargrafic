<?php
/* @var $this MovimientoAlmacenController */
/* @var $model MovimientoAlmacen */
/* @var $form CActiveForm */
?>
<h2>Producto <?php echo $almacen->idProducto0->codigo; ?></h2>
<div class = "col-sm-4">
<h3>En deposito</h3>
<div class="row form-group">
	<?php echo CHtml::activeLabelEx($model,'cantidadU',array('class'=>'col-sm-6 control-label')); ?>
	<span class="col-sm-4"><?php echo $deposito->stockU ?></span>
</div>
<div class="row form-group">
	<?php echo CHtml::activeLabelEx($model,'cantidadP',array('class'=>'col-sm-6 control-label')); ?>
	<span class="col-sm-4"><?php echo $deposito->stockP ?></span>
</div>
</div>
<div class = "col-sm-4">
<h3>En existencia</h3>
<div class="row form-group">
	<?php echo CHtml::activeLabelEx($model,'cantidadU',array('class'=>'col-sm-6 control-label')); ?>
	<span class="col-sm-4"><?php echo $almacen->stockU ?></span>
</div>
<div class="row form-group">
	<?php echo CHtml::activeLabelEx($model,'cantidadP',array('class'=>'col-sm-6 control-label')); ?>
	<span class="col-sm-4"><?php echo $almacen->stockP ?></span>
</div>
</div>
<div class="form col-sm-4">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'movimiento-almacen-add_reduce-form',
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

	<h3>Añadir a stock</h3>
	<div class="form-group">
		<?php echo $form->labelEx($model,'cantidadU',array('class'=>'col-sm-6 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'cantidadU',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'cantidadU',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'cantidadP',array('class'=>'col-sm-6 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'cantidadP',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'cantidadP',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php // echo CHtml::link("Atras",array("stock/distribuidora"),array("class"=>"btn btn-default")); ?>
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
