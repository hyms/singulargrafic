<?php
/* @var $this ProductoController */
/* @var $model Producto */

$this->breadcrumbs=array(
	'Productos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Producto <?php echo $model->codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>