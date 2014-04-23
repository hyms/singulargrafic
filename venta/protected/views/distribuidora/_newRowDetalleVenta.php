<tr class="tabular-input">
<td class="col-sm-1">
	<p class="form-control-static"><?php echo CHtml::encode($index + 1)?></p>
	<?php echo CHtml::activeHiddenField($model,"[$index]idAlmacen")?>
</td>

<td class="col-sm-2">
	<p class="form-control-static"><?php echo CHtml::encode($almacen->Producto->codigo) ?></p>
</td>

<td class="col-sm-4">
	<p class="form-control-static"><?php echo CHtml::encode($almacen->Producto->Material->nombre ." ".$almacen->Producto->Color->nombre." ".$almacen->Producto->peso." ".$almacen->Producto->dimension." ".$almacen->Producto->procedencia) ?></p>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField($model,"[$index]cantUnidad",array('class'=>'form-control input-sm','id'=>'stockUnidad_'.$index)); ?>
	<?php echo CHtml::hiddenField("unidad".$index,$factura?$almacen->Producto->costoSFUnidad:$almacen->Producto->costoCFUnidad)?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField($model,"[$index]cantPaquete",array('class'=>'form-control input-sm','id'=>'stockPaquete_'.$index)); ?>
	<?php echo CHtml::hiddenField("paquete".$index,$factura?$almacen->Producto->costoSF:$almacen->Producto->costoCF)?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField($model,"[$index]adicional",array('class'=>'form-control input-sm','id'=>'adicional_'.$index)); ?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField($model,"[$index]costoTotal",array('class'=>'costo form-control input-sm','readonly'=>true,'id'=>'costoTotal_'.$index)); ?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::link('Quitar', '#', array("class"=>"btn btn-danger tabular-input-remove")).'<input type="hidden" class="tabular-input-index" value="'.$index.'" />'; ?>
</td>
</tr>
<?php  echo 
"
<script>
	$('#stockUnidad_". $index ."').blur(function(e){ 
	    $('#costoTotal_". $index ."').val(suma(suma($('#stockUnidad_".  $index ."').val()*$('#unidad". $index ."').val(),$('#stockPaquete_". $index ."').val()*$('#paquete". $index ."').val()),$('#adicional_". $index ."').val()));
		calcular_total();
		return true;
	});
	
	$('#stockPaquete_". $index ."').blur(function(e){ 
	    $('#costoTotal_". $index ."').val(suma(suma($('#stockUnidad_". $index ."').val()*$('#unidad". $index ."').val(),$('#stockPaquete_". $index ."').val()*$('#paquete". $index ."').val()),$('#adicional_". $index ."').val()));
		calcular_total();
	  	return true;
	});
	
	$('#adicional_". $index ."').blur(function(e){ 
	    $('#costoTotal_". $index ."').val(suma(suma($('#stockUnidad_". $index ."').val()*$('#unidad". $index ."').val(),$('#stockPaquete_". $index ."').val()*$('#paquete". $index ."').val()),$('#adicional_". $index ."').val()));
		calcular_total();
	  	return true;
	});
	$('#costoTotal_". $index ."').change(function(e){ 
	    calcular_total();
		return true;
	})
</script>

";?>
