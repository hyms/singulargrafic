<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Empleado <?php echo $empleado->apellido;?> </strong>
    </div>
    <div class="panel-body" style="overflow: auto;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-formDate-form',
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

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
        <div class="col-sm-6">
            <?php echo $form->labelEx($model,'username',array('class'=>'col-sm-4 control-label')); ?>
            <div class="col-sm-8">
            <?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'username'); ?>
        </div>

        <div class="col-sm-6">
            <?php echo $form->labelEx($model,'password',array('class'=>'col-sm-4 control-label')); ?>
            <div class="col-sm-8">
            <?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'password'); ?>
        </div>
	</div>

	<div class="form-group">
        <div class="col-sm-6">
            <?php echo $form->labelEx($model,'tipo',array('class'=>'col-sm-4 control-label')); ?>
            <div class="col-sm-8">
            <?php echo CHtml::activeDropDownList($model,'tipo',$model->tipos(),array('class'=>'form-control'));?>
            <?php //echo $form->textField($model,'tipo',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'tipo'); ?>
        </div>

        <div class="col-sm-6">
            <?php echo $form->labelEx($model,'estado',array('class'=>'col-sm-4 control-label')); ?>
            <div class="col-sm-8">
                <?php echo CHtml::activeRadioButtonList($model,'estado',array('activo','inactivo'))?>
            </div>
            <?php echo $form->error($model,'estado'); ?>
        </div>
    </div>


    <div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-2')); ?>
	</div>

<?php $this->endWidget(); ?>
    </div>
</div><!-- form -->
