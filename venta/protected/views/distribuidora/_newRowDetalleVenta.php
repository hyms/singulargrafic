<td class="col-sm-1">
	<p class="form-control-static"><?php echo CHtml::encode($index + 1)?></p>
	<?php echo CHtml::activeHiddenField($almacen,"[$index]id")?>
</td>

<td class="col-sm-2">
	<p class="form-control-static"><?php echo CHtml::encode($almacen->Producto->codigo) ?></p>
</td>

<td class="col-sm-4">
	<p class="form-control-static"><?php echo CHtml::encode($almacen->Producto->Material->nombre ." ".$almacen->Producto->Color->nombre." ".$almacen->Producto->peso." ".$almacen->Producto->dimension." ".$almacen->Producto->procedencia) ?></p>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField(Almacen::model(),"[$index]stockUnidad",array('class'=>'form-control input-sm','id'=>'stockUnidad_'.$index)); ?>
	<?php echo CHtml::error(Almacen::model(),"[$index]stockUnidad"); ?>
	<?php echo CHtml::hiddenField("unidad".$index,$almacen->Producto->costoCFUnidad)?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField(Almacen::model(),"[$index]stockPaquete",array('class'=>'form-control input-sm','id'=>'stockPaquete_'.$index)); ?>
	<?php echo CHtml::error(Almacen::model(),"[$index]stockPaquete"); ?>
	<?php echo CHtml::hiddenField("paquete".$index,$almacen->Producto->costoCF)?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField($detalle,"[$index]adicional",array('class'=>'form-control input-sm','id'=>'adicional_'.$index)); ?>
	<?php echo CHtml::error($detalle,"[$index]adicional"); ?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField($detalle,"[$index]costoTotal",array('class'=>'costo form-control input-sm','disabled'=>true,'id'=>'costoTotal_'.$index)); ?>
</td>

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