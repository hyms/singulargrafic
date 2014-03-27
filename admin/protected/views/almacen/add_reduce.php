<?php
/* @var $this AlmacenController */
/* @var $model Almacen */
/* @var $form CActiveForm */
?>
<div class="col-md-2">
	<h2>Almacenes</h2>
	<ul class="nav nav-pills nav-stacked">
	<?php
		foreach ($almacenes as $alm)
		{
	?>
		<li><?php echo CHtml::link($alm->nombre, array('almacen/add_reduce', 'al'=>$alm->id));?></li>
	<?php 
		}
		
	?>
	</ul>
</div>

<div class="col-md-10">


<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productos->searchAll(),
	'filter'=>$productos,
	'ajaxUpdate'=>false,
	'itemsCssClass' => 'table table-hover table-condensed',
	'htmlOptions' => array('class' => 'table-responsive'),
	'columns'=>array(
		
		array(
			'header'=>'#',
			'value'=>'$row+1',       //  row is zero based
		),
		array(
			'name'=>'codigo',
			'value'=>'$data->codigo',
			'filter'=>CHtml::activeTextField($productos, 'codigo'),
		),
		array(
			'name'=>'peso',
			'value'=>'$data->peso',  
			'filter'=>CHtml::activeTextField($productos, 'peso'),  
		),
		array(
			'name'=>'color',
			'value'=>'$data->Color->nombre',
			'filter'=>CHtml::activeTextField($productos, 'color'),
		),
		/*array(
			'name'=>'',
			'type'=>'raw',
			'value'=>'CHtml::link("Editar",array("producto/update","id"=>$data->id))'
		),
		array(
			'name'=>'',
			'type'=>'raw',
			'value'=>'CHtml::link("Eliminar",array("almacen/delete","id"=>$data->id),array("confirm" => "Esta seguro de Eliminarlo?"))'
		),*/
		
	)
));
?>

<?php
	$this->renderPartial('movimientoAlamacen', array('model'=>$model));
?>
</div>