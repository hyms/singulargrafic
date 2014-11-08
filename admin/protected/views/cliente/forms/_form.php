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

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'nombre',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'nombre',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'nombre'); ?>
        </div>

        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'apellido',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'apellido',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'apellido'); ?>
        </div>
    </div>

	<div class="form-group">
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'nitCi',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'nitCi',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'nitCi'); ?>
        </div>

        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'correo',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'correo',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'correo'); ?>
        </div>
	</div>

	<div class="form-group">
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'telefono',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'telefono',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'telefono'); ?>
        </div>

        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'direccion',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
            <?php echo $form->textField($model,'direccion',array('class'=>'form-control')); ?>
            </div>
            <?php echo $form->error($model,'direccion'); ?>
        </div>
	</div>
	
	<div class="form-group">
        <div class="col-xs-6">
            <?php echo $form->labelEx($model,'idTiposClientes',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-6">
            <?php echo $form->dropDownList($model,'idTiposClientes',CHtml::listData(TiposClientes::model()->findAll(),'idTiposClientes','nombre'),array('maxlength'=>20,'class'=>'form-control','empty'=>'')); ?>
            </div>
            <?php echo $form->error($model,'idTiposClientes'); ?>
	    </div>
	
	    <div class="col-xs-6">
            <?php echo $form->labelEx($model,'idParent',array('class'=>'col-xs-4 control-label')); ?>
            <div class="col-xs-6">
            <?php echo $form->dropDownList($model,'idParent',$model->getClientes(),array('maxlength'=>20,'class'=>'form-control','empty'=>'')); ?>
            </div>
            <?php echo $form->error($model,'idParent'); ?>
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