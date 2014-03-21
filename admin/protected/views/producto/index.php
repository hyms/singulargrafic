<?php
/* @var $this ProductoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Productos',
);

?>

<h1>Productos</h1>

<?php echo CHtml::link('Añadir',array('producto/create'), array('class' => 'btn btn-default') ); ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
