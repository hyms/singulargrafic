<?php
/* @var $this EmpresaController */
/* @var $model Empresa */
/* @var $form CActiveForm */
?>
<div class="col-sm-2">
	<h2>Empresa</h2>
	<ul class="nav nav-pills nav-stacked">
	<?php
		foreach ($sucursal as $suc)
		{
	?>
		<li class="form-group"><?php echo CHtml::link($suc->nombre, array('empresa/sucursal', 'id'=>$suc->id));?></li>
	<?php 
		}
		$form=$this->beginWidget('CActiveForm', array(
				'id'=>'empresa-empresa-form',
				'action'=>Yii::app()->createUrl('/empresa/sucursal'),
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
		echo CHtml::hiddenField('new','true');
	?>
	<div class="form-group">
		<?php echo CHtml::submitButton('Añadir',array('class'=>'btn btn-default col-sm-offset-2')); ?>
	</div>

	<?php $this->endWidget(); ?>
	</ul>
</div>
<div class="form col-sm-10">
	<h1><?php echo $model->nombre; ?></h1>
<?php if($new==true || $model->id != null){?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'empresa-empresa-form',
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

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nombre',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'nombre',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'ciudad',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo CHtml::dropDownList('ciudad', $model->ciudad, 
              $model->ciudades,
              array('empty' => 'Seleccione la Ciudad',
					'class'=>'form-control'
		));?>
		</div>
		<?php echo $form->error($model,'ciudad'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'calle',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-5">
		<?php echo $form->textField($model,'calle',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'calle'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'maps',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-5">
		<?php echo $form->textField($model,'maps',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'maps'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'fax',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->textField($model,'fax',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'fax'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'telefono',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-2">
		<?php echo $form->textField($model,'telefono',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'correo',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'correo',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'correo'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'horarios',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo $form->textField($model,'horarios',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'horarios'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'skype',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'skype',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'skype'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'facebook',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'facebook',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'facebook'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'patern',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo CHtml::dropDownList('Superior', $model->patern, 
              $model->superiores,
              array('empty' => 'Seleccione su Superior',
					'class'=>'form-control'
		));?>
		</div>
		<?php echo $form->error($model,'patern'); ?>
	</div>
	<div class="form-group">
	<?php echo Chtml::label('Servicios','servicio',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-3">
		<?php echo CHtml::dropDownList('Servicios', $servicios->nombre, 
              $model->servicios,
              array('empty' => 'Seleccione el Servicio',
					'class'=>'form-control'
		));?>
		</div>
	
	</div>
	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-2')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php }?>
</div>

<script type="text/javascript">

	var startingNo = 3;
	var $node = "";
	for(varCount=0;varCount<=startingNo;varCount++){
	    var displayCount = varCount+1;
	    $node += '<p><label for="var'+displayCount+'">Variable '+displayCount+': </label><input type="text" name="var'+displayCount+'" id="var'+displayCount+'"><span class="removeVar">Remove Variable</span></p>';
	}
	//add them to the DOM
	$('form').prepend($node);
	//remove a textfield    
	$('form').on('click', '.removeVar', function(){
	   $(this).parent().remove();
	  
	});
	//add a new node
	$('#addVar').on('click', function(){
	varCount++;
	$node = '<p><label for="var'+varCount+'">Variable '+varCount+': </label><input type="text" name="var'+varCount+'" id="var'+varCount+'"><span class="removeVar">Remove Variable</span></p>';
	$(this).parent().before($node);
	});
		
</script>
