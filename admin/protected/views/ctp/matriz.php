<?php echo "  ".CHtml::link('Añadir Horario'); ?>
<?php echo "  ".CHtml::link('Añadir Cantidades'); ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'matriz-precios-ctp-precios-form',
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

<?php $this->renderPartial('precios',array('model'=>$model,'placa'=>0,'clienteTipo'=>0,'cantidad'=>0,'horario'=>0)); ?>

<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-2')); ?>
</div>


<?php $this->endWidget(); ?>

</div><!-- form -->