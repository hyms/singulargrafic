<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'form',
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
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'nombre',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'nombre',array('size'=>40,'maxlength'=>40,'class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'nombre'); ?>
        </div>

        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'apellido',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'apellido',array('size'=>40,'maxlength'=>40,'class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'apellido'); ?>
        </div>
    </div>

	<div class="form-group">
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'email',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'email'); ?>
        </div>

        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'telefono',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-6">
            <?php echo $form->textField($model,'telefono',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'telefono'); ?>
        </div>
    </div>
	<div class="form-group">
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'ci',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-6">
            <?php echo $form->textField($model,'ci',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'ci'); ?>
        </div>

        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'idSucursal',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-6">
                <?php echo $form->dropDownList($model,'idSucursal',CHtml::listData(Sucursal::model()->findAll(),'idSucursal','nombre'),array('class'=>'form-control','empty'=>'')); ?>
            <?php //echo $form->textField($model,'idSucursal',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'idSucursal'); ?>
        </div>
	</div>

    <div class="form-group">
        <p class="text-center">
            <?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
            <?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-default hidden-print','id'=>'save')); ?>
        </p>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->