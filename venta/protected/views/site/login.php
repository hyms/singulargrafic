<h1 class="text-center">Sistema de Ventas</h1>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'htmlOptions'=>array(
            'class'=>'form-horizontal',
            'role'=>'form'
        ),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model,'username',array('class'=>'col-xs-4 control-label')); ?>
        <div class="col-xs-8">
            <?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
        </div>
        <?php echo $form->error($model,'username'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'password',array('class'=>'col-xs-4 control-label')); ?>
        <div class="col-xs-8">
            <?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
        </div>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="form-group">
        <div class="checkbox text-center">
            <?php echo $form->checkBox($model,'rememberMe'); ?>
            <?php echo $form->label($model,'rememberMe',array('class'=>'control-label')); ?>
            <?php echo $form->error($model,'rememberMe'); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="text-center">
            <?php echo CHtml::submitButton('Ingresar',array('class'=>'btn btn-default')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div>
