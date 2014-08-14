<tr >
<td >
	<p class="form-control-static"><?php echo CHtml::encode($index + 1)?></p>
	<?php echo CHtml::activeHiddenField($model,"[$index]idAlmacenProducto")?>
</td>

<td>
	<p class="form-control-static"><?php echo CHtml::encode($almacen->idProducto0->detalle) ?></p>
</td>

<td>
	<?php echo CHtml::activeTextField($model,"[$index]nroPlacas",array('class'=>'form-control input-sm')); ?>
</td>
<td>

</td>
<td>
	<?php //echo CHtml::activeTextField($model,"[$index]nroColores",array('class'=>'form-control input-sm','id'=>'snroColores_'.$index)); ?>
	<div class="checkbox"><?php echo CHtml::activeCheckBox($model,"[$index]C"); ?></div>
</td>
<td>
	<div class="checkbox"><?php echo CHtml::activeCheckBox($model,"[$index]M"); ?></div>
</td>
<td>
	<div class="checkbox"><?php echo CHtml::activeCheckBox($model,"[$index]Y"); ?></div>
</td>
<td>
	<div class="checkbox"><?php echo CHtml::activeCheckBox($model,"[$index]K"); ?></div>
</td>

<td>
	<?php echo CHtml::activeTextField($model,"[$index]trabajo",array('class'=>'form-control input-sm')); ?>
</td>

<td>
	<?php echo CHtml::activeTextField($model,"[$index]pinza",array('class'=>'form-control input-sm')); ?>
</td>
<td>
	<?php echo CHtml::activeTextField($model,"[$index]resolucion",array('class'=>'form-control input-sm')); ?>
</td>
<td class="col-sm-1">
	<?php echo CHtml::link('Reponer', '#', array("class"=>"btn btn-warning btn-sm","onclick"=>'newRow('.$model->idDetalleCTP.')')) ?>
</td>
</tr>
	