<?php
$this->breadcrumbs=array(
	'Empleados'=>array('index'),
	'Create',
);

?>

<h1>Producto Nuevo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>