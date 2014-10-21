<h1>Empleado <?php echo $empleado->nombre." ".$empleado->apellido;?></h1>

<div class="form">

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

    <p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model,'username',array('class'=>'col-xs-2 control-label')); ?>
        <div class="col-xs-3">
            <?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
        </div>
        <?php echo $form->error($model,'username'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'password',array('class'=>'col-xs-2 control-label')); ?>
        <div class="col-xs-3">
            <?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
        </div>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-xs-offset-2')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
