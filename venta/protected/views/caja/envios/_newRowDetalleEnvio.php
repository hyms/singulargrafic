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

<td class="col-xs-1">
	<?php echo CHtml::activeTextField($model,"[$index]cantidadU",array('class'=>'form-control input-sm','id'=>'stockUnidad_'.$index)); ?>
</td>

<td class="col-xs-1">
	<?php echo CHtml::activeTextField($model,"[$index]cantidadP",array('class'=>'form-control input-sm','id'=>'stockPaquete_'.$index)); ?>
</td>

<td class="col-xs-1">
	<?php echo CHtml::link('Quitar', '#', array("class"=>"btn btn-danger btn-sm tabular-input-remove")).'<input type="hidden" class="tabular-input-index" value="'.$index.'" />'; ?>
</td>
</tr>
<?php  
echo "
<script>
			
	$('#stockUnidad_". $index ."').keydown(function(e){ 
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
			
</script>
";?>
