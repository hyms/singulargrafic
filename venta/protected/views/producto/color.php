<?php
/* @var $this ColorController */
/* @var $model Color */
/* @var $form CActiveForm */

Yii::app()->clientscript
// use it when you need it!


?>
<div class="col-sm-2">
	<h2>Colores</h2>
	<ul class="nav nav-pills nav-stacked">
	<?php
		foreach ($colores as $color)
		{
	?>
		<li><?php echo CHtml::link($color->nombre, array('producto/color', 'id'=>$color->id));?></li>
	<?php 
		}
	?>
	</ul>
	
	<?php
		$form=$this->beginWidget('CActiveForm', array(
				'id'=>'empresa-empresa-form',
				'action'=>Yii::app()->createUrl('/producto/color'),
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
		
	?>
	<div class="form-group">
		<?php echo CHtml::hiddenField('new','true'); ?>
	</div>
	<div class="form-group">
		<?php echo CHtml::submitButton('Añadir',array('class'=>'btn btn-default col-sm-offset-2')); ?>
	</div>

	<?php $this->endWidget(); ?>
	
</div>

<div class="form col-sm-10">
	<h1><?php echo $model->nombre; ?></h1>
<?php if($new==true || $model->id != null){?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'color-color-form',
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
		<?php echo $form->labelEx($model,'nombre',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'nombre',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'codigo',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo $form->textField($model,'codigo',array('class'=>'form-control','id'=>'codigo')); ?>
		<span id="color"></span>
		</div>
		<?php echo $form->error($model,'codigo'); ?>
	</div>


	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-2')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<script>
//$("#codigo").spectrum();
$("#codigo").spectrum({
	preferredFormat: "hex",
	showInitial: true,
    showInput: true,
    show: function(color) {
        color.toHexString(); // #ff0000
    }
    
});
$("#color").show();

t.toHex();
</script>

<?php }?>
</div>
