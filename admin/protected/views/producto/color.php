<?php
/* @var $this ColorController */
/* @var $model Color */
/* @var $form CActiveForm */
Yii::app()->clientscript->registerCssFile( Yii::app()->request->baseUrl . '/css/spectrum.css');
Yii::app()->clientscript->registerScriptFile( Yii::app()->request->baseUrl . '/js/spectrum.js');
// use it when you need it!


?>
<div class="col-sm-2">
	<h2>Colores</h2>
	<?php 
	$items = array();
	foreach ($colores as $color)
	{
		array_push($items,array('label'=>$color->nombre, 'url'=>array('/producto/color', 'id'=>$color->id)));
	}
	$this->widget('zii.widgets.CMenu',array(
					'htmlOptions' => array('class' => 'nav nav-pills nav-stacked'),
					'activeCssClass'	=> 'active',
					'encodeLabel' => false,
					'items'=>$items,
					)); 
	?>
	<?php
		$form=$this->beginWidget('CActiveForm', array(
				'id'=>'empresa-empresa-form',
				'action'=>Yii::app()->createUrl('/producto/color'),
				'htmlOptions'=>array(
						'class'=>'form-horizontal',
						'role'=>'form'
				),
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
		)); 
		
	?>
	<div class="form-group">
		<?php echo CHtml::hiddenField('new','true'); ?>
	</div>
	<div class="form-group">
		<?php echo CHtml::submitButton('Añadir',array('class'=>'btn btn-default col-sm-offset-2')); ?>
	</div>

	<?php $this->endWidget(); ?>
	
</div>

<div class="form col-sm-10">
	<h1><?php echo $model->nombre; ?></h1>
<?php if($new==true || $model->id != null){?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'color-color-form',
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

	<?php echo $form->errorSummary($model,'', '', array('class' => 'alert alert-danger')); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nombre',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'nombre',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'nombre',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'codigo',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo $form->textField($model,'codigo',array('class'=>'form-control','id'=>'codigo')); ?>
		<span id="color"></span>
		</div>
		<?php echo $form->error($model,'codigo',array('class'=>'label label-danger')); ?>
	</div>


	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-2')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php Yii::app()->getClientScript()->registerScript("spectrum",
"
$(\"#codigo\").spectrum({
	preferredFormat: \"hex\",
	showInitial: true,
    showInput: true,
    show: function(color) {
        color.toHexString(); // #ff0000
    }
    
});
$(\"#color\").show();

t.toHex();
		
",CClientScript::POS_READY); ?>

<?php }?>
</div>
