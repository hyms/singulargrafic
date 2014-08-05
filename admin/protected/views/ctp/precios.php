<?php foreach ($placas as $placa){?>
<?php foreach ($clienteTipos as $clienteTipo){?>

<div class="col-xs-6">

	<h4><strong><?php echo $placa->idProducto0->detalle; ?></strong></h4>
	<h4><strong><?php echo $clienteTipo->nombre; ?></strong></h4>
	
	<table class="table table-condensed table-hover">
	<tr>
		<td></td>
		<?php foreach ($cantidades as $cantidad){?>
		<td><strong><?php echo CHtml::link($cantidad->Inicio."-".$cantidad->final,array('ctp/cantidad','id'=>$cantidad->idCantidadCTP), array('class' => 'openDlg divDialog')); //echo $cantidad->Inicio."-".$cantidad->final; ?></strong></td>
		<?php }?>
	</tr>
	<?php foreach ($horarios as $horario){?>
	<tr>
		<td><strong><?php echo CHtml::link($horario->inicio."-".$horario->final,array('ctp/horario','id'=>$horario->idHorario), array('class' => 'openDlg divDialog')); ?></strong></td>
		<?php foreach ($cantidades as $cantidad){?>
		<td>
			<div class="col-xs-6">
			<div class="form-group">
				<?php echo CHtml::activeLabelEx($model,"[$placa->idProducto][$clienteTipo->idTiposClientes][$cantidad->idCantidadCTP][$horario->idHorario]precioSF",array('class'=>'control-label')); ?>
				<?php echo CHtml::activeTextField($model,"[$placa->idProducto][$clienteTipo->idTiposClientes][$cantidad->idCantidadCTP[$horario->idHorario]precioSF",array('class'=>'form-control')); ?>
				<?php echo CHtml::error($model,"[$placa->idProducto][$clienteTipo->idTiposClientes][$cantidad->idCantidadCTP][$horario->idHorario]precioSF"); ?>
			</div>
			</div>
			<div class="col-xs-6"> 
			<div class="form-group">
				<?php echo CHtml::activeLabelEx($model,"[$placa->idProducto][$clienteTipo->idTiposClientes][$cantidad->idCantidadCTP][$horario->idHorario]precioCF",array('class'=>'control-label')); ?>
				<?php echo CHtml::activeTextField($model,"[$placa->idProducto][$clienteTipo->idTiposClientes][$cantidad->idCantidadCTP][$horario->idHorario]precioCF",array('class'=>'form-control')); ?>
				<?php echo CHtml::error($model,"[$placa->idProducto][$clienteTipo->idTiposClientes][$cantidad->idCantidadCTP][$horario->idHorario]precioCF"); ?>
			</div>
			</div>
		</td>
		<?php }?>
	</tr>
	<?php }?>
	</table>
	
	
</div>

<?php }?>
<?php }?>
