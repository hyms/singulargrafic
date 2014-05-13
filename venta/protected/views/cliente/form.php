<?php
/* @var $this ClienteController */
/* @var $model Cliente */
/* @var $form CActiveForm */
$this->breadcrumbs=array(
	'Registro',
);
?>
<div class="col-sm-2">
	<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="panel-title"><strong>Registro Cliente</strong></span>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'cliente-form',
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
				<?php echo $form->labelEx($model,'nombre',array('class'=>'col-sm-2 control-label')); ?>
				<div class="col-sm-4">
				<?php echo $form->textField($model,'nombre',array('size'=>40,'maxlength'=>40,'class'=>'form-control')); ?>
				</div>
				<?php echo $form->error($model,'nombre'); ?>
			</div>
		
			<div class="form-group">
				<?php echo $form->labelEx($model,'apellido',array('class'=>'col-sm-2 control-label')); ?>
				<div class="col-sm-4">
				<?php echo $form->textField($model,'apellido',array('size'=>40,'maxlength'=>40,'class'=>'form-control')); ?>
				</div>
				<?php echo $form->error($model,'apellido'); ?>
			</div>
		
			<div class="form-group">
				<?php echo $form->labelEx($model,'nitCi',array('class'=>'col-sm-2 control-label')); ?>
				<div class="col-sm-3">
				<?php echo $form->textField($model,'nitCi',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
				</div>
				<?php echo $form->error($model,'nitCi'); ?>
			</div>
			
			<div class="form-group">
				<?php echo $form->labelEx($model,'correo',array('class'=>'col-sm-2 control-label')); ?>
				<div class="col-sm-4">
				<?php echo $form->textField($model,'correo',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
				</div>
				<?php echo $form->error($model,'correo'); ?>
			</div>
		
			<div class="form-group">
				<?php echo $form->labelEx($model,'telefono',array('class'=>'col-sm-2 control-label')); ?>
				<div class="col-sm-3">
				<?php echo $form->textField($model,'telefono',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
				</div>
				<?php echo $form->error($model,'telefono'); ?>
			</div>
		
			<div class="form-group">
				<?php echo $form->labelEx($model,'direccion',array('class'=>'col-sm-2 control-label')); ?>
				<div class="col-sm-3">
				<?php echo $form->textField($model,'direccion',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
				</div>
				<?php echo $form->error($model,'direccion'); ?>
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
	
	</div>
</div>