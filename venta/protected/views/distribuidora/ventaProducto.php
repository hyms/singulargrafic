<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'venta-producto-form',
		'htmlOptions'=>array(
				//'class'=>'form-inline',
				'role'=>'form'
		),
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// See class documentation of CActiveForm for details on this,
		// you need to use the performAjaxValidation()-method described there.
		'enableAjaxValidation'=>false,
));
?>

	<div class="form-group col-md-3">
		<?php echo $form->labelEx($cliente,'nitCi',array('class'=>'control-label')); ?>
		<div >
			<?php echo $form->textField($cliente,'nitCi',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($cliente,'nitCi'); ?>
	</div>
	<div class="form-group col-md-3">
		<?php echo $form->labelEx($cliente,'apellido',array('class'=>'control-label')); ?>
		<div >
			<?php echo $form->textField($cliente,'apellido',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($cliente,'apellido'); ?>
	</div>
	<div class="form-group col-md-3">
		<?php echo $form->labelEx($cliente,'nombre',array('class'=>'control-label')); ?>
		<div >
			<?php echo $form->textField($cliente,'nombre',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($cliente,'nombre'); ?>
	</div>
	<div class="form-group col-md-3">
		<?php echo $form->labelEx($ventaTmp,'fechaModifcacion',array('class'=>'control-label')); ?>
		<div>
			<?php echo $form->hiddenField($ventaTmp,'fechaModifcacion'); ?>
			<p class=" form-control "><?php echo date("d/m/Y");?></p>
		</div>
		<?php echo $form->error($ventaTmp,'fechaModifcacion'); ?>
	</div>
<!-- 
<div class="form-group">
	<?php echo CHtml::Button('Añadir',array('class'=>'btn btn-default')); ?>
</div>
	 -->
<?php $this->endWidget(); ?>

</div><!-- form -->