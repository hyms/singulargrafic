<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">
                Empleado <?php echo $empleado->nombre." ".$empleado->apellido;?>
        </strong>
    </div>
    <div class="panel-body">
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
            <?php echo $form->errorSummary($model); ?>

            <div class="form-group col-xs-5">
                <?php echo $form->labelEx($model,'username',array('class'=>'col-xs-4 control-label')); ?>
                <div class="col-xs-8">
                    <?php echo $form->textField($model,'username',array('class'=>'form-control','readonly'=>true)); ?>
                </div>
                <?php echo $form->error($model,'username'); ?>
            </div>

            <div class="form-group col-xs-5">
                <?php echo $form->labelEx($model,'password',array('class'=>'col-xs-4 control-label')); ?>
                <div class="col-xs-8">
                    <?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
                </div>
                <?php echo $form->error($model,'password'); ?>
            </div>

            <div class="form-group col-xs-2">
                <?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-xs-offset-2')); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>