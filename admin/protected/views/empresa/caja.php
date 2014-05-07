<?php
/* @var $this ServiciosController */
/* @var $model Servicios */
/* @var $form CActiveForm */
?>

<div class="col-sm-2">
	<h2>Cajas</h2>
	<?php 
	$items = array();
	foreach ($CajaTipo as $serv)
	{
		array_push($items,array('label'=>$serv->nombre, 'url'=>array('/empresa/cajas', 'id'=>$serv->id)));
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
				'action'=>Yii::app()->createUrl('/empresa/cajas'),
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
	'id'=>'servicios-servicios-form',
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
		<div class="col-sm-3">
		<?php echo $form->textField($model,'nombre',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'nombre',array('class'=>'label label-danger')); ?>
	</div>
	
	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-3')); ?>
		
		<?php
			if($model->id != null)
				echo CHtml::link('Eliminar', array('empresa/serviciosDelete', 'id'=>$model->id),array("confirm" => "Esta seguro de Eliminarlo?"));
		?>
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php }?>
</div>