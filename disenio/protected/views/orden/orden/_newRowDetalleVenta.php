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
</td>

<td>
	<?php echo CHtml::activeTextField($model,"[$index]nroColores",array('class'=>'form-control input-sm','id'=>'snroColores_'.$index)); ?>
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

<td>
	<?php echo CHtml::activeTextField($model,"[$index]costoAdicional",array('class'=>'form-control input-sm','id'=>'adicional_'.$index)); ?>
</td>

<td>
	<?php echo CHtml::activeTextField($model,"[$index]costoTotal",array('class'=>'costo form-control input-sm','readonly'=>true,'id'=>'costoTotal_'.$index)); ?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::link('Quitar', '#', array("class"=>"btn btn-danger btn-sm tabular-input-remove")).'<input type="hidden" class="tabular-input-index" value="'.$index.'" />'; ?>
</td>
</tr>
<?php  
echo "
<script>
	$('#stockUnidad_". $index ."').blur(function(e){ 
	    $('#costoTotal_". $index ."').val(suma(suma($('#stockUnidad_".  $index ."').val()*$('#costoUnidad_". $index ."').val(),$('#stockPaquete_". $index ."').val()*$('#costoPaquete_". $index ."').val()),$('#adicional_". $index ."').val()));
		calcular_total();
		return true;
	});
	
	$('#stockPaquete_". $index ."').blur(function(e){ 
	    $('#costoTotal_". $index ."').val(suma(suma($('#stockUnidad_". $index ."').val()*$('#costoUnidad_". $index ."').val(),$('#stockPaquete_". $index ."').val()*$('#costoPaquete_". $index ."').val()),$('#adicional_". $index ."').val()));
		calcular_total();
	  	return true;
	});
	
	$('#adicional_". $index ."').blur(function(e){ 
	    $('#costoTotal_". $index ."').val(suma(suma($('#stockUnidad_". $index ."').val()*$('#costoUnidad_". $index ."').val(),$('#stockPaquete_". $index ."').val()*$('#costoPaquete_". $index ."').val()),$('#adicional_". $index ."').val()));
		calcular_total();
	  	return true;
	});
	$('#costoTotal_". $index ."').change(function(e){ 
	    calcular_total();
		return true;
	})
</script>
";?>
