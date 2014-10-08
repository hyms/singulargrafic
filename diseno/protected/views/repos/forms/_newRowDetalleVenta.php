<tr >
<td >
	<p class="form-control-static"><?php echo CHtml::encode($index + 1)?></p>
	<?php echo CHtml::activeHiddenField($model,"[$index]idAlmacenProducto")?>
</td>

<td>
	<p class="form-control-static"><?php echo CHtml::encode($almacen->idProducto0->detalle) ?></p>
</td>

<td>
	<?php echo CHtml::activeTextField($model,"[$index]nroPlacas",array('class'=>'form-control input-sm','readonly'=>true)); ?>
</td>
<td>
	<?php //echo CHtml::activeTextField($model,"[$index]nroColores",array('class'=>'form-control input-sm','id'=>'snroColores_'.$index)); ?>
	<?php echo CHtml::activeCheckBox($model,"[$index]C",array('onClick'=>"return false")); ?>
</td>
<td>
	<?php echo CHtml::activeCheckBox($model,"[$index]M",array('onClick'=>"return false")); ?>
</td>
<td>
	<?php echo CHtml::activeCheckBox($model,"[$index]Y",array('onClick'=>"return false")); ?>
</td>
<td>
	<?php echo CHtml::activeCheckBox($model,"[$index]K",array('onClick'=>"return false")); ?>
</td>

<td>
	<?php echo CHtml::activeTextField($model,"[$index]trabajo",array('class'=>'form-control input-sm','readonly'=>true)); ?>
</td>

<td>
	<?php echo CHtml::activeTextField($model,"[$index]pinza",array('class'=>'form-control input-sm','readonly'=>true)); ?>
</td>
<td>
	<?php echo CHtml::activeTextField($model,"[$index]resolucion",array('class'=>'form-control input-sm','readonly'=>true)); ?>
</td>
<td class="col-xs-1">
	<?php echo CHtml::link('Reponer', '#', array("class"=>"btn btn-warning btn-sm","onclick"=>'newRow('.$model->idDetalleCTP.')')) ?>
</td>
</tr>
	