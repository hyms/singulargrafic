<?php
/* @var $this ProductoController */
/* @var $model Producto */

$this->breadcrumbs=array(
	'Productos'=>array('index'),
	'Añadir',
);

?>

<h1>Añadir Producto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>