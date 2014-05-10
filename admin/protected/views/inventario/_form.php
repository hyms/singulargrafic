<?php
/* @var $this EmpleadoController */
/* @var $model Empleado */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'producto-producto-form',
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
		<?php echo $form->labelEx($model,'codigo',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'codigo',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'material',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'material',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'material'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'color',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'color',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'color'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'marca',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'marca',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'marca'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'industria',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'industria',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'industria'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'familia',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'familia',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'familia'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'detalle',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'detalle',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'detalle'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'cantXPaquete',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'cantXPaquete',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'cantXPaquete'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'precioSFU',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'precioSFU',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'precioSFU'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'precioSFP',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'precioSFP',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'precioSFP'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'precioCFU',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'precioCFU',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'precioCFU'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'precioCFP',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'precioCFP',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'precioCFP'); ?>
	</div>
	
	<div class="form-group">
		<p class="text-center">
			<?php echo CHtml::button('Atras', array(
	            'name' => 'btnBack',
	            'class' => 'btn btn-default',
	            'onclick' => "history.go(-1)",
	                )
	        ); ?>
			<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-2')); ?>
		</p>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->