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
	<?php echo CHtml::checkBox("[$index]F",false,array('id'=>'f_'.$index)); ?></div>
</td>
<td>
	<?php //echo CHtml::activeTextField($model,"[$index]nroColores",array('class'=>'form-control input-sm','id'=>'snroColores_'.$index)); ?>
	<?php echo CHtml::activeCheckBox($model,"[$index]C",array('id'=>'c_'.$index)); ?>
</td>
<td>
	<?php echo CHtml::activeCheckBox($model,"[$index]M",array('id'=>'m_'.$index)); ?>
</td>
<td>
	<?php echo CHtml::activeCheckBox($model,"[$index]Y",array('id'=>'y_'.$index)); ?>
</td>
<td>
	<?php echo CHtml::activeCheckBox($model,"[$index]K",array('id'=>'k_'.$index)); ?>
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
<td class="col-xs-1">
	<?php echo CHtml::link('Quitar', '#', array("class"=>"btn btn-danger btn-sm tabular-input-remove")).'<input type="hidden" class="tabular-input-index" value="'.$index.'" />'; ?>
</td>
</tr>
<?php  
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
