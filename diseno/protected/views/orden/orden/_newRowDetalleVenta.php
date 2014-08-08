<tr class="tabular-input">
<td >
	<p class="form-control-static"><?php echo CHtml::encode($index + 1)?></p>
	<?php echo CHtml::activeHiddenField($model,"[$index]idAlmacenProducto")?>
</td>

<td>
	<p class="form-control-static"><?php echo CHtml::encode($almacen->idProducto0->detalle) ?></p>
</td>

<td>
	<?php echo CHtml::activeTextField($model,"[$index]nroPlacas",array('class'=>'form-control input-sm','id'=>'nroPlacas_'.$index)); ?>
	<?php echo CHtml::hiddenField("[$index]costo",$costo,array('id'=>'costo_'.$index)); ?>
</td>
<td>
	<div class="checkbox"><?php echo CHtml::checkBox("[$index]F",false,array('id'=>'f_'.$index)); ?></div>
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
	<?php echo CHtml::activeTextField($model,"[$index]trabajo",array('class'=>'form-control input-sm','id'=>'trabajo_'.$index)); ?>
</td>

<td>
	<?php echo CHtml::activeTextField($model,"[$index]pinza",array('class'=>'form-control input-sm','id'=>'pinza_'.$index)); ?>
</td>
<td>
	<?php echo CHtml::activeTextField($model,"[$index]resolucion",array('class'=>'form-control input-sm','id'=>'resolucion_'.$index)); ?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField($model,"[$index]costoAdicional",array('class'=>'form-control input-sm','id'=>'adicional_'.$index)); ?>
</td>
<?php /*?>
<td class="col-sm-1">
	<?php echo CHtml::activeTextField($model,"[$index]costoTotal",array('class'=>'costo form-control input-sm','readonly'=>true,'id'=>'costoTotal_'.$index)); ?>
</td>
<?php */?>
<td class="col-sm-1">
	<?php echo CHtml::link('Quitar', '#', array("class"=>"btn btn-danger btn-sm tabular-input-remove")).'<input type="hidden" class="tabular-input-index" value="'.$index.'" />'; ?>
</td>
</tr>
<?php

/*
 
 $('#nroPlacas_". $index ."').blur(function(e){ 
	    $('#costoTotal_". $index ."').val(suma($('#nroPlacas_".  $index ."').val()*$('#costo_". $index ."').val(),$('#adicional_". $index ."').val()));
		calcular_total();
		return true;
	});
	
	$('#adicional_". $index ."').blur(function(e){ 
	    $('#costoTotal_". $index ."').val(suma($('#nroPlacas_".  $index ."').val()*$('#costo_". $index ."').val(),$('#adicional_". $index ."').val()));
		calcular_total();
	  	return true;
	});
			
	$('#costoTotal_". $index ."').change(function(e){ 
	    calcular_total();
		return true;
	})
	
	
 
 */
echo "
<script>
	$('#f_". $index ."').change(function(e){ 
	    $('#c_". $index ."').prop('checked',$('#f_". $index ."').is(':checked'));
		$('#m_". $index ."').prop('checked',$('#f_". $index ."').is(':checked'));
		$('#y_". $index ."').prop('checked',$('#f_". $index ."').is(':checked'));
		$('#k_". $index ."').prop('checked',$('#f_". $index ."').is(':checked'));
		return true;
	})	
</script>
";?>
