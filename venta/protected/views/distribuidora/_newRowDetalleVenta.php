<tr class="tabular-input">
<td >
	<p class="form-control-static"><?php echo CHtml::encode($index + 1)?></p>
	<?php echo CHtml::activeHiddenField($model,"[$index]idAlmacenProducto",array('id'=>'idAlmacen'))?>
	<?php echo CHtml::hiddenField('index',$index,array('id'=>'indexs'))?>
</td>

<td>
	<p class="form-control-static"><?php echo CHtml::encode($almacen->idProducto0->codigo) ?></p>
</td>

<td>
	<p class="form-control-static"><?php echo CHtml::encode($almacen->idProducto0->material." ".$almacen->idProducto0->color." ".$almacen->idProducto0->detalle.", ".$almacen->idProducto0->marca) ?></p>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField($model,"[$index]cantidadU",array('class'=>'form-control input-sm','id'=>'stockUnidad_'.$index)); ?>
</td>
<td class="col-sm-1">
	<?php echo CHtml::activeTextField($model,"[$index]costoU",array('class'=>'form-control input-sm','id'=>'costoUnidad_'.$index)); ?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField($model,"[$index]cantidadP",array('class'=>'form-control input-sm','id'=>'stockPaquete_'.$index)); ?>
</td>
<td class="col-sm-1">
	<?php echo CHtml::activeTextField($model,"[$index]costoP",array('class'=>'form-control input-sm','id'=>'costoPaquete_'.$index)); ?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField($model,"[$index]costoAdicional",array('class'=>'form-control input-sm','id'=>'adicional_'.$index)); ?>
</td>

<td class="col-sm-1">
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
	    $('#costoTotal_". $index ."').val(redondeo(suma(suma($('#stockUnidad_".  $index ."').val()*$('#costoUnidad_". $index ."').val(),$('#stockPaquete_". $index ."').val()*$('#costoPaquete_". $index ."').val()),$('#adicional_". $index ."').val())));
		calcular_total();
		return true;
	});
	
	$('#stockPaquete_". $index ."').blur(function(e){ 
	    $('#costoTotal_". $index ."').val(redondeo(suma(suma($('#stockUnidad_". $index ."').val()*$('#costoUnidad_". $index ."').val(),$('#stockPaquete_". $index ."').val()*$('#costoPaquete_". $index ."').val()),$('#adicional_". $index ."').val())));
		calcular_total();
	  	return true;
	});
	
	$('#adicional_". $index ."').blur(function(e){ 
	    $('#costoTotal_". $index ."').val(redondeo(suma(suma($('#stockUnidad_". $index ."').val()*$('#costoUnidad_". $index ."').val(),$('#stockPaquete_". $index ."').val()*$('#costoPaquete_". $index ."').val()),$('#adicional_". $index ."').val())));
		calcular_total();
	  	return true;
	});
	$('#costoTotal_". $index ."').change(function(e){ 
	    calcular_total();
		return true;
	})

			
	$('#stockUnidad_". $index ."').keydown(function(e){ 
        if(e.keyCode==13 || e.keyCode==9) 
	    { 
	    	$('#costoUnidad_". $index ."').focus();
	      	return true; 
	    } 
           
    });	
	$('#costoUnidad_". $index ."').keydown(function(e){ 
        if(e.keyCode==13 || e.keyCode==9) 
	    { 
	    	$('#stockPaquete_". $index ."').focus();
	      	return true; 
	    } 
           
    });
	$('#stockPaquete_". $index ."').keydown(function(e){ 
        if(e.keyCode==13 || e.keyCode==9) 
	    { 
	    	$('#costoPaquete_". $index ."').focus();
	      	return true; 
	    } 
           
    });	
	$('#costoPaquete_". $index ."').keydown(function(e){ 
        if(e.keyCode==13 || e.keyCode==9) 
	    { 
	    	$('#adicional_". $index ."').focus();
	      	return true; 
	    } 
           
    });
	$('#adicional_". $index ."').keydown(function(e){ 
        if(e.keyCode==13 || e.keyCode==9) 
	    { 
	    	if($('#stockUnidad_".($index+1)."').length>0)
			{
	    		$('#stockUnidad_".($index+1)."').focus();
	    	}
	    	else
	    	{
	    		$('#pagado').focus();
	    	}
	      	return true; 
	    } 
           
    });		
	
</script>
";?>
