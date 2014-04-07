
	<div class="form-group col-md-6">
		<?php echo $form->labelEx($cliente,'nitCi',array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<?php echo $form->textField($cliente,'nitCi',array('class'=>'form-control ',"id"=>"NitCi")); ?>
		</div>
		<?php echo $form->error($cliente,'nitCi'); ?>
	</div>
	<div class="form-group col-md-6">
		<?php echo $form->labelEx($cliente,'apellido',array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<?php echo $form->textField($cliente,'apellido',array('class'=>'form-control',"id"=>"apellido")); ?>
		</div>
		<?php echo $form->error($cliente,'apellido'); ?>
	</div>
	<div class="form-group col-md-6">
		<?php echo $form->labelEx($empleado,'nombres',array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<?php echo $form->textField($empleado,'nombres',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($empleado,'nombres'); ?>
	</div>
	<div class="form-group col-md-6">
		<?php echo $form->labelEx($ventaTmp,'fechaModifcacion',array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<?php echo $form->hiddenField($ventaTmp,'fechaModifcacion'); ?>
			<p class=" form-control "><?php echo date("d/m/Y");?></p>
		</div>
		<?php echo $form->error($ventaTmp,'fechaModifcacion'); ?>
	</div>
