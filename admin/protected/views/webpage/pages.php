<?php
/* @var $this PagesController */
/* @var $model Pages */
/* @var $form CActiveForm */

Yii::app()->clientscript->registerScriptFile( Yii::app()->baseUrl.'/js/ckeditor/ckeditor.js');
?>
<div class="col-sm-2">
	<h2>Lista de paginas</h2>
	<?php 
	$items = array();
	foreach ($paginas as $pag)
	{
		array_push($items,array('label'=>$pag->nombre, 'url'=>array('/webpage/pages', 'id'=>$pag->id)));
	}
	echo "<div class = 'well well-sm'>";
	$this->widget('zii.widgets.CMenu',array(
					'htmlOptions' => array('class' => 'nav nav-pills nav-stacked'),
					'activeCssClass'	=> 'active',
					'encodeLabel' => false,
					'items'=>$items,
					)); 
	echo "</div>";
	?>
</div>
<div class="form col-sm-10">

<h1>Paginas</h1>
<?php if($model->id != null){?>
	
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pagesForm',
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
	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>
	<p class="note">Ultima modificacion <code><?php echo $model->fecha;?></code></p>
	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nombre',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
			<?php echo $form->textField($model,'nombre',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'contenido',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textArea($model,'contenido',array('id'=>'contenido','name'=>'contenido')); ?>
		</div>
		<?php echo $form->error($model,'contenido'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'enable',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->checkBox($model,'enable'); ?>
		</div>
		<?php echo $form->error($model,'enable'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'order',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-1">
			<?php echo $form->textField($model,'order',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'order'); ?>
	</div>
	
	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-2')); ?>
	</div>

<?php $this->endWidget(); ?>
<?php Yii::app()->getClientScript()->registerScript("CKEDITOR",
"
    CKEDITOR.replace( 'contenido'
    	    //,{ filebrowserBrowseUrl : '/images/' }
		);
",CClientScript::POS_READY); ?>
<?php }?>
</div><!-- form -->
