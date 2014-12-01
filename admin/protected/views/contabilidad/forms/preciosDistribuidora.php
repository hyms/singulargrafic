<div class="form">
    <h3><?php
        echo $nombre;
        ?>
    </h3>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'precios-distribuidora-preciosDistribuidora-form',
        'htmlOptions'=>array(
            'class'=>'form-horizontal',
            'role'=>'form'
        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation'=>true,
    )); ?>

    <div class="form-group">
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'precioCFU',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
                <?php echo $form->textField($model,'precioCFU',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'precioCFU'); ?>
        </div>
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'precioCFP',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
                <?php echo $form->textField($model,'precioCFP',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'precioCFP'); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'precioSFU',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
                <?php echo $form->textField($model,'precioSFU',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'precioSFU'); ?>
        </div>
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'precioSFP',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
                <?php echo $form->textField($model,'precioSFP',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'precioSFP'); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12">
            <?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div>