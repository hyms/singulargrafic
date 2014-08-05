<div class="col-xs-6">
	<h3><?php echo $placa; ?></h3>
	<h3><?php echo $clienteTipo; ?></h3>
	<h3><?php echo $cantidad; ?></h3>
	<div class="form-group">
	<span class="col-xs-3"><strong><?php echo $horario; ?></strong></span>
	<div class="col-xs-9">
		<div class="form-group col-xs-4">
			<?php echo CHtml::activeLabelEx($model,"[$placa][$clienteTipo][$cantidad][$horario]precioSF",array('class'=>'control-label')); ?>
			<?php echo CHtml::activeTextField($model,"[$placa][$clienteTipo][$cantidad][$horario]precioSF",array('class'=>'form-control')); ?>
			<?php echo CHtml::error($model,"[$placa][$clienteTipo][$cantidad][$horario]precioSF"); ?>
		</div>
		
		<div class="form-group col-xs-4">
			<?php echo CHtml::activeLabelEx($model,"[$placa][$clienteTipo][$cantidad][$horario]precioCF",array('class'=>'control-label')); ?>
			<?php echo CHtml::activeTextField($model,"[$placa][$clienteTipo][$cantidad][$horario]precioCF",array('class'=>'form-control')); ?>
			<?php echo CHtml::error($model,"[$placa][$clienteTipo][$cantidad][$horario]precioCF"); ?>
		</div>
			
		<div class="form-group col-xs-4">
			<?php echo CHtml::activeLabelEx($model,"[$placa][$clienteTipo][$cantidad][$horario]nombre",array('class'=>'control-label')); ?>
			<?php echo CHtml::activeTextField($model,"[$placa][$clienteTipo][$cantidad][$horario]nombre",array('class'=>'form-control')); ?>
			<?php echo CHtml::error($model,"[$placa][$clienteTipo][$cantidad][$horario]nombre"); ?>
		</div>
	</div>
	</div>
</div>