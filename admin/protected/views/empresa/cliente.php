<?php
/* @var $this ClienteController */
/* @var $model Cliente */
/* @var $form CActiveForm */
?>
<div class="col-sm-2">
	<h2>Clientes</h2>
	<?php 
	$items = array();
	foreach ($clientes as $cli)
	{
		array_push($items,array('label'=>$cli->nombre.' '.$cli->apellido, 'url'=>array('/empresa/cliente', 'id'=>$cli->id)));
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
				'action'=>Yii::app()->createUrl('/empresa/cliente'),
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
	<h1><?php echo $model->nombre.' '.$model->apellido; ?></h1>
<?php if($new==true || $model->id != null){?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cliente-Cliente-form',
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
		<?php echo $form->labelEx($model,'nitCi',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->textField($model,'nitCi',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'nitCi',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'apellido',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->textField($model,'apellido',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'apellido',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nombre',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->textField($model,'nombre',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'nombre',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'correo',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'correo',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'correo',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'telefono',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->textField($model,'telefono',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'telefono',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'fechaRegistro',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    	    'name'=>'fechaRegistro',
			'attribute'=>'fechaRegistro',
		    //'id'=>'user_Birthdate',
		    'model'=>$model,
		    // additional javascript options for the date picker plugin
		    'options'=>array(
		        'showAnim'=>'fold',
				'dateFormat'=>'dd-mm-yy',
		    ),
		    'htmlOptions'=>array(
		        'class'=>'form-control'
		    ),
		));
		?>
		</div>
		<?php echo $form->error($model,'fechaRegistro',array('class'=>'label label-danger')); ?>
	</div>


	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-3')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php }?>
</div>