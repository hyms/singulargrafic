<td class="col-sm-1">
	<p class="form-control-static"><?php echo CHtml::encode($index + 1)?></p>
	<?php echo CHtml::activeHiddenField($almacen,"[$index]id")?>
</td>

<td class="col-sm-2">
	<p class="form-control-static"><?php echo CHtml::encode($almacen->Producto->codigo) ?></p>
</td>

<td class="col-sm-5">
	<p class="form-control-static"><?php echo CHtml::encode($almacen->Producto->Material->nombre ." ".$almacen->Producto->Color->nombre." ".$almacen->Producto->peso." ".$almacen->Producto->dimension." ".$almacen->Producto->procedencia) ?></p>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField(Almacen::model(),"[$index]stockUnidad",array('class'=>'form-control input-sm','id'=>'stockUnidad_'.$index)); ?>
	<?php echo CHtml::error(Almacen::model(),"[$index]stockUnidad"); ?>
</td>

<td class="col-sm-1">
	<?php echo CHtml::activeTextField(Almacen::model(),"[$index]stockPaquete",array('class'=>'form-control input-sm','id'=>'stockPaquete_'.$index)); ?>
	<?php echo CHtml::error(Almacen::model(),"[$index]stockPaquete"); ?>
</td>
<td class="col-sm-1">
	<?php echo CHtml::activeTextField($detalle,"[$index]costoTotal",array('class'=>'form-control input-sm','disabled'=>true,'id'=>'costoTotal_'.$index)); ?>
</td>

<script type="text/javascript">
	function suma(a,b)
	{
		var c;
		a=a*<?php echo $almacen->Producto->costoCFUnidad ?>;
		b=b*<?php echo $almacen->Producto->costoCF ?>;
		return (a+b);
	}
		
	$('#stockUnidad_<?php echo $index ?>').blur(function(e){ 
	    $('#costoTotal_<?php echo $index ?>').val(suma($('#stockUnidad_<?php echo $index ?>').val(),$('#stockPaquete_<?php echo $index ?>').val()));
		return true;
	});
	
	$('#stockPaquete_<?php echo $index ?>').blur(function(e){ 
	    $('#costoTotal_<?php echo $index ?>').val(suma($('#stockUnidad_<?php echo $index ?>').val(),$('#stockPaquete_<?php echo $index ?>').val()));
	  	return true;
	});
</script>