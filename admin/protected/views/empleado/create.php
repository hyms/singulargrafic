<?php
/* @var $this EmpleadoController */
/* @var $model Empleado */

$this->breadcrumbs=array(
	'Empleados'=>array('index'),
	'Create',
);

?>

<h1>Empleado Nuevo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>