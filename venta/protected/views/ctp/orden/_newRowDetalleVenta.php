<tr class="tabular-input">
<td >
	<p class="form-control-static"><?php echo CHtml::encode($index + 1)?></p>
	<?php echo CHtml::activeHiddenField($model,"[$index]idAlmacenProducto")?>
</td>

<td>
	<p class="form-control-static"><?php echo CHtml::encode($almacen->idProducto0->detalle) ?></p>
</td>

<td>
	<?php echo CHtml::activeTextField($model,"[$index]nroPlacas",array('class'=>'form-control input-sm','readonly'=>true,'id'=>'nroPlacas_'.$index)); ?>
	<?php echo CHtml::hiddenField("[$index]costo",$costo,array('id'=>'costo_'.$index)); ?>
</td>

<td>
	<?php //echo CHtml::activeTextField($model,"[$index]nroColores",array('class'=>'form-control input-sm','id'=>'snroColores_'.$index)); ?>
	<div class="checkbox"><?php echo CHtml::activeCheckBox($model,"[$index]C",array('id'=>'c_'.$index)); ?></div>
</td>
<td>
	<div class="checkbox"><?php echo CHtml::activeCheckBox($model,"[$index]M",array('id'=>'m_'.$index)); ?></div>
</td>
<td>
	<div class="checkbox"><?php echo CHtml::activeCheckBox($model,"[$index]Y",array('id'=>'y_'.$index)); ?></div>
</td>
<td>
	<div class="checkbox"><?php echo CHtml::activeCheckBox($model,"[$index]K",array('id'=>'k_'.$index)); ?></div>
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
	<?php echo CHtml::activeTextField($model,"[$index]costoAdicional",array('class'=>'form-control input-sm','readonly'=>true,'id'=>'adicional_'.$index)); ?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField($model,"[$index]costoTotal",array('class'=>'costo form-control input-sm','readonly'=>true,'id'=>'costoTotal_'.$index)); ?>
</td>

</tr>
<?php  
echo "
<script>
	$('#nroPlacas_". $index ."').blur(function(e){ 
	    $('#costoTotal_". $index ."').val(suma($('#nroPlacas_".  $index ."').val()*$('#costo_". $index ."').val(),$('#adicional_". $index ."').val()).toFixed(1));
		calcular_total();
		return true;
	});
	
	$('#adicional_". $index ."').blur(function(e){ 
	    $('#costoTotal_". $index ."').val(suma($('#nroPlacas_".  $index ."').val()*$('#costo_". $index ."').val(),$('#adicional_". $index ."').val()).toFixed(1));
		calcular_total();
	  	return true;
	});
			
	$('#costoTotal_". $index ."').change(function(e){ 
	    calcular_total();
		return true;
	})
</script>
";?>