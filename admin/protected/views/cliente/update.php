<?php
/* @var $this EmpleadoController */
/* @var $model Empleado */

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	'Update',
);
?>

<h1>Cliente <?php echo $model->nombre." ".$model->apellido; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>