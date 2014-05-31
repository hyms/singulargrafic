<?php
/* @var $this EmpleadoController */
/* @var $model Empleado */

$this->breadcrumbs=array(
	'Empleados'=>array('index'),
	'Update',
);

?>

<h1>Empleado <?php echo $model->nombre." ".$model->apellido; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>