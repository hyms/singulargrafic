<?php
/* @var $this SucursalController */
/* @var $model Sucursal */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'sucursal-sucursal-form',
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
    <div class="form-group">
        <?php echo $form->labelEx($model,'nombre',array('class'=>'col-xs-3 control-label')); ?>
        <div class="col-xs-9">
            <?php echo $form->textField($model,'nombre',array('class'=>'form-control')); ?>
        </div>
        <?php echo $form->error($model,'nombre'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'detalle',array('class'=>'col-xs-3 control-label')); ?>
        <div class="col-xs-9">
            <?php echo $form->textArea($model,'detalle',array('class'=>'form-control')); ?>
        </div>
        <?php echo $form->error($model,'detalle'); ?>
    </div>


    <div class="form-group">
        <?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-xs-offset-2')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
