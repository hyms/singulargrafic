<?php
/* @var $this EmpleadoController */
/* @var $model Empleado */
/* @var $form CActiveForm */
?>
<div class="col-sm-2">
	<h2>Empleados</h2>
	<?php 
	$items = array();
	foreach ($empleados as $emp)
	{
		array_push($items,array('label'=>$emp->nombres.' '.$emp->apellidos, 'url'=>array('/empresa/empleado', 'id'=>$emp->id)));
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
				'action'=>Yii::app()->createUrl('/empresa/empleado'),
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
	<h1><?php echo $model->nombres.' '.$model->apellidos; ?></h1>
<?php if($new==true || $model->id != null){?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'empleado-empleado-form',
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
		<?php echo $form->labelEx($model,'nombres',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo $form->textField($model,'nombres',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'nombres',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'apellidos',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo $form->textField($model,'apellidos',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'apellidos',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'ci',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->textField($model,'ci',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'ci',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'telefono',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->textField($model,'telefono',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'telefono',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'email',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'cargo',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo $form->textField($model,'cargo',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'cargo',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'turno',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->textField($model,'turno',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'turno',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sueldo',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->textField($model,'sueldo',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'sueldo',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'skype',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo $form->textField($model,'skype',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'skype',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'face',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo $form->textField($model,'face',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'face',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sucursal',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo CHtml::dropDownList('sucursal', $model->sucursal, 
              $model->sucursales,
              array('empty' => 'Seleccione la Sucursal',
					'class'=>'form-control'
		));?>
		</div>
		<?php echo $form->error($model,'sucursal',array('class'=>'label label-danger')); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'superior',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo CHtml::dropDownList('superior', $model->superior, 
              $model->superiores,
              array('empty' => 'Seleccione su Superior',
					'class'=>'form-control'
		));?>
		</div>
		<?php echo $form->error($model,'superior',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'fechaIngreso',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    	    'name'=>'fechaIngreso',
			'attribute'=>'fechaIngreso',
			'language'=>'es',
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
		<?php echo $form->error($model,'fechaIngreso',array('class'=>'label label-danger')); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($user,'username',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo $form->textField($user,'username',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($user,'username',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($user,'password',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo $form->passwordField($user,'password',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($user,'password',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($user,'estado',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo CHtml::activeRadioButtonList($user,'estado',array('Activado','Desactivado'))?>
		</div>
		<?php echo $form->error($user,'estado',array('class'=>'label label-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($user,'tipo',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo CHtml::activeDropDownList($user,'tipo', 
              $user->tipos,
              array('empty' => 'Seleccione Tipo',
					'class'=>'form-control'
		));?>
		</div>
		<?php echo $form->error($user,'tipo',array('class'=>'label label-danger')); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'obs',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-5">
		<?php echo $form->textArea($model,'obs',array('maxlength' => 500,'class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'obs',array('class'=>'label label-danger')); ?>
	</div>


	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-3')); ?>
		
		<?php
			if($model->id != null)
				echo CHtml::link('Eliminar', array('empresa/empleadoDelete', 'id'=>$model->id),array("confirm" => "Esta seguro de Eliminarlo?"));
		?>
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php }?>
</div>
