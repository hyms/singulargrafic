<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'empleado-form',
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form',
		'enctype' => 'multipart/form-data'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
        <div class="col-sm-6">
            <?php echo $form->labelEx($model,'nombre',array('class'=>'col-sm-4 control-label')); ?>
            <div class="col-sm-8">
            <?php echo $form->textField($model,'nombre',array('size'=>40,'maxlength'=>40,'class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'nombre'); ?>
        </div>

        <div class="col-sm-6">
            <?php echo $form->labelEx($model,'apellido',array('class'=>'col-sm-4 control-label')); ?>
            <div class="col-sm-8">
            <?php echo $form->textField($model,'apellido',array('size'=>40,'maxlength'=>40,'class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'apellido'); ?>
        </div>
    </div>

	<div class="form-group">
        <div class="col-sm-6">
            <?php echo $form->labelEx($model,'email',array('class'=>'col-sm-4 control-label')); ?>
            <div class="col-sm-8">
            <?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'email'); ?>
        </div>

        <div class="col-sm-6">
            <?php echo $form->labelEx($model,'telefono',array('class'=>'col-sm-4 control-label')); ?>
            <div class="col-sm-6">
            <?php echo $form->textField($model,'telefono',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'telefono'); ?>
        </div>
    </div>
	<div class="form-group">
        <div class="col-sm-6">
            <?php echo $form->labelEx($model,'ci',array('class'=>'col-sm-4 control-label')); ?>
            <div class="col-sm-6">
            <?php echo $form->textField($model,'ci',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'ci'); ?>
        </div>
	</div>

	<div class="form-group">
		<p class="text-center">
		<?php echo CHtml::button('Atras', array(
            'name' => 'btnBack',
            'class' => 'btn btn-default',
            'onclick' => "history.go(-1)",
                )
        ); ?>
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default')); ?>
		</p>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->