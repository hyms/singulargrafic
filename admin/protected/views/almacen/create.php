<?php
/* @var $this AlmacenController */
/* @var $model Almacen */

$this->breadcrumbs=array(
	'Almacens'=>array('index'),
	'Create',
);

?>

<h1>Create Almacen</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>