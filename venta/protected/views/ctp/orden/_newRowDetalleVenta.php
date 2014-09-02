<tr class="tabular-input">
<td >
	<p class="form-control-static"><?php echo CHtml::encode($index + 1)?></p>
	<?php echo CHtml::activeHiddenField($model,"[$index]idAlmacenProducto",array('id'=>'idAlmacen'))?>
</td>

<td>
	<p class="form-control-static"><?php echo CHtml::encode($almacen->idProducto0->color) ?></p>
</td>

<td>
	<?php echo CHtml::activeTextField($model,"[$index]nroPlacas",array('class'=>'form-control input-sm','readonly'=>true,'id'=>'nroPlacas_'.$index)); ?>
</td>

<td>
	<?php echo CHtml::activeCheckBox($model,"[$index]C",array('id'=>'c_'.$index,'onClick'=>"return false")); ?>
</td>
<td>
	<?php echo CHtml::activeCheckBox($model,"[$index]M",array('id'=>'m_'.$index,'onClick'=>"return false")); ?>
</td>
<td>
	<?php echo CHtml::activeCheckBox($model,"[$index]Y",array('id'=>'y_'.$index,'onClick'=>"return false")); ?>
</td>
<td>
	<?php echo CHtml::activeCheckBox($model,"[$index]K",array('id'=>'k_'.$index,'onClick'=>"return false")); ?>
</td>

<td>
	<?php echo CHtml::activeTextField($model,"[$index]trabajo",array('class'=>'form-control input-sm','readonly'=>true,'id'=>'trabajo_'.$index)); ?>
</td>

<td>
	<?php echo CHtml::activeTextField($model,"[$index]pinza",array('class'=>'form-control input-sm','readonly'=>true,'id'=>'pinza_'.$index)); ?>
</td>
<td>
	<?php echo CHtml::activeTextField($model,"[$index]resolucion",array('class'=>'form-control input-sm','readonly'=>true,'id'=>'resolucion_'.$index)); ?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField($model,"[$index]costo",array('class'=>'form-control input-sm','readonly'=>true,'id'=>'costo_'.$index)); ?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField($model,"[$index]costoAdicional",array('class'=>'form-control input-sm','readonly'=>true,'id'=>'adicional_'.$index)); ?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField($model,"[$index]costoTotal",array('class'=>'costo form-control input-sm','readonly'=>true,'id'=>'costoTotal_'.$index)); ?>
</td>

</tr>