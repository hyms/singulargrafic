<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banners'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Banner', 'url'=>array('index')),
	array('label'=>'Create Banner', 'url'=>array('create')),
	array('label'=>'View Banner', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Banner', 'url'=>array('admin')),
);
?>

<h1>Update Banner <?php echo $model->id; ?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'banner-form',
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
		<?php echo $form->labelEx($model,'imagen',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php /*$this->widget('ext.uploadify.MUploadify',array(
			  'model'=>$model,
			  'attribute'=>'imagen',
			  //'script'=>$this->createUrl('upload'),
			  //'auto'=>true,
			  //'someOption'=>'someValue',
			));*/?>
		<?php echo $form->fileField($model,'imagen',array('class'=>'form-control','size'=>60,'maxlength'=>500)); ?>
		</div>
		<?php echo $form->error($model,'imagen'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'texto',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
		<?php echo $form->textArea($model,'texto',array('id'=>'texto','name'=>'texto')); ?>
		</div>
		<?php echo $form->error($model,'texto'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'fecha',array('class'=>'col-sm-2 control-label')); ?>
		<p class="col-sm-2">
		<?php echo $model->fecha = date("Y-m-d"); ?>
		</p>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'order',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-1">
		<?php echo $form->textField($model,'order',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'order'); ?>
	</div>

	<div class="form-group">
		<?php 
		echo CHtml::button('Atras', array(
            'name' => 'btnBack',
            'class' => 'btn btn-default col-sm-pull-2',
            'onclick' => "history.go(-1)",
                )
        );
		 echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Save',array('class'=>'btn btn-default col-sm-offset-1')); 
	?>
	</div>

<?php $this->endWidget(); ?>
<script type="text/javascript">
    CKEDITOR.replace( 'texto' );
</script>

</div>