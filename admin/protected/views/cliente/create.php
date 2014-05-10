<?php
/* @var $this EmpleadoController */
/* @var $model Empleado */

$this->breadcrumbs=array(
	'Cliente'=>array('index'),
	'Create',
);

?>
<h1>Cliente Nuevo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>