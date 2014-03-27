<?php
/* @var $this AlmacenController */
/* @var $model Almacen */
/* @var $form CActiveForm */
?>
<div class="col-md-2">
	<h2>Almacenes</h2>
	<?php 
	$items = array();
	foreach ($almacenes as $alm)
	{
		array_push($items,array('label'=>$alm->nombre, 'url'=>array('/almacen/add_reduce', 'al'=>$alm->id)));
	}
	$this->widget('zii.widgets.CMenu',array(
					'htmlOptions' => array('class' => 'nav nav-pills nav-stacked'),
					'activeCssClass'	=> 'active',
					'encodeLabel' => false,
					'items'=>$items,
					)); 
	?>
</div>

<div class="col-md-10">
<?php
if($model->idAlmacen!=null)
{
	$this->renderPartial('movimientoAlamacen', array('model'=>$model));
}
else
{
if($productos->almacen!=null)
{
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productos->searchAll(),
	'filter'=>$productos,
	'ajaxUpdate'=>true,
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
			'name'=>'material',
			'value'=>'$data->Material->nombre',
			'filter'=>CHtml::listData(Material::model()->findAll(array('order'=>'nombre')),'id','nombre'),
		),
		
		array(
			'name'=>'color',
			'value'=>'$data->Color->nombre',
			'filter'=>CHtml::listData(Color::model()->findAll(array('order'=>'nombre')),'id','nombre'),
			//'filter'=>CHtml::activeTextField($productos, 'color'),
		),
		array(
			'name'=>'peso',
			'value'=>'$data->peso',
			'filter'=>CHtml::listData(Producto::model()->findAll(array('select'=>'peso','order'=>'peso','group'=>'peso')),'peso','peso'),
		),
		array(
			'name'=>'dimension',
			'value'=>'$data->dimension',
			'filter'=>CHtml::listData(Producto::model()->findAll(array('select'=>'dimension','order'=>'dimension','group'=>'dimension')),'dimension','dimension'),
		),
		array(
			'name'=>'procedencia',
			'value'=>'$data->procedencia',
			'filter'=>CHtml::listData(Producto::model()->findAll(array('select'=>'procedencia','order'=>'procedencia','group'=>'procedencia')),'procedencia','procedencia'),
		),
		array(
			'name'=>'industria',
			'value'=>'$data->Industria->nombre',
			'filter'=>CHtml::listData(Industria::model()->findAll(array('order'=>'nombre')),'id','nombre'),
		),
		array(
			'header'=>'stock Unidad',
			'value'=>'$data->Almacen->stockUnidad',
		),
		array(
			'header'=>'stock Paquete',
			'value'=>'$data->Almacen->stockPaquete',
		),
		
		array(
			'header'=>'',
			'type'=>'raw',
			'value'=>'CHtml::link("Seleccionar",array("almacen/add_reduce","id"=>$data->id))'
		),
		/*array(
			'name'=>'',
			'type'=>'raw',
			'value'=>'CHtml::link("Eliminar",array("almacen/delete","id"=>$data->id),array("confirm" => "Esta seguro de Eliminarlo?"))'
		),*/
		
	)
));
}
}
?>

</div>