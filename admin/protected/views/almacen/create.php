<?php
/* @var $this AlmacenController */
/* @var $model Almacen */

$this->breadcrumbs=array(
	'Almacens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Almacen', 'url'=>array('index')),
	array('label'=>'Manage Almacen', 'url'=>array('admin')),
);
?>

<h1>Create Almacen</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>