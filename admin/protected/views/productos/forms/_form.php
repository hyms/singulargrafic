<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'form',
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
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'codigo',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'codigo',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'codigo'); ?>
        </div>
	</div>

    <div class="form-group">
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'material',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'material',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'material'); ?>
	    </div>

        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'color',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'color',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'color'); ?>
        </div>
	</div>

    <div class="form-group">
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'marca',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'marca',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'marca'); ?>
	    </div>

        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'industria',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'industria',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'industria'); ?>
        </div>
	</div>

	<div class="form-group">
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'familia',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'familia',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'familia'); ?>
        </div>
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'detalle',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'detalle',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'detalle'); ?>
        </div>
	</div>

        <div class="form-group">
            <div class="col-xs-6">
            <?php echo $form->labelEx($model,'cantXPaquete',array('class'=>'col-xs-4 control-label')); ?>
                <div class="col-xs-8">
                <?php echo $form->textField($model,'cantXPaquete',array('class'=>'form-control')); ?>
                </div>
            <?php echo $form->error($model,'cantXPaquete'); ?>
            </div>
        </div>
    <div class="form-group">
        <div class="col-xs-2 col-xs-offset-2">
            <?php echo $form->labelEx($model,'precioSFU'); ?>
            <?php echo $form->textField($model,'precioSFU',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'precioSFU'); ?>
        </div>

        <div class="col-xs-2">
            <?php echo $form->labelEx($model,'precioSFP'); ?>
            <?php echo $form->textField($model,'precioSFP',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'precioSFP'); ?>
        </div>

        <div class="col-xs-2">
            <?php echo $form->labelEx($model,'precioCFU'); ?>
            <?php echo $form->textField($model,'precioCFU',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'precioCFU'); ?>
        </div>

        <div class="col-xs-2">
            <?php echo $form->labelEx($model,'precioCFP'); ?>
            <?php echo $form->textField($model,'precioCFP',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'precioCFP'); ?>
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