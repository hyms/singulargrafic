
	<div class="form-group col-md-6">
		<?php echo $form->labelEx($cliente,'nitCi',array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<?php echo $form->textField($cliente,'nitCi',array('class'=>'form-control ',"id"=>"NitCi")); ?>
		</div>
		<?php echo $form->error($cliente,'nitCi',array('class'=>'label label-danger')); ?>
	</div>
	<div class="form-group col-md-6">
		<?php echo $form->labelEx($cliente,'apellido',array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<?php echo $form->textField($cliente,'apellido',array('class'=>'form-control',"id"=>"apellido")); ?>
		</div>
		<?php echo $form->error($cliente,'apellido',array('class'=>'label label-danger')); ?>
	</div>
	<div class="form-group col-md-6">
		<?php echo $form->labelEx($empleado,'nombres',array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<?php echo $form->textField($empleado,'nombres',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($empleado,'nombres'); ?>
	</div>
	<div class="form-group col-md-6">
		<?php echo $form->labelEx($venta,'fechaVenta',array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<?php echo $form->hiddenField($venta,'fechaVenta'); ?>
			<p class=" form-control "><?php echo $venta->fechaVenta;?></p>
		</div>
	</div>
