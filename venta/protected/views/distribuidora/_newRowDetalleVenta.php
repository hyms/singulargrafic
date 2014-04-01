<td>
	<p class="form-control-static"><?php echo CHtml::encode($index + 1)?></p>
</td>

<td>
	<p class="form-control-static"><?php echo CHtml::encode($model->with('Producto')->Producto) ?></p>
</td>

<td>
	<p class="form-control-static"><?php echo CHtml::encode($model->with('Producto')->Producto) ?></p>
</td>

<td>
	<?php //print_r($model);?>
	<?php echo CHtml::activeTextField(Almacen::model(),"[$index]stockUnidad",array('class'=>'form-control input-sm')); ?>
	<?php echo CHtml::error(Almacen::model(),"[$index]stockUnidad"); ?>
</td>

<td>
	<?php //print_r($model);?>
	<?php echo CHtml::activeTextField(Almacen::model(),"[$index]stockPaquete",array('class'=>'form-control input-sm')); ?>
	<?php echo CHtml::error(Almacen::model(),"[$index]stockPaquete"); ?>
</td>
<td>
	<p class="form-control-static"><?php echo CHtml::encode('xx')?></p>
</td>