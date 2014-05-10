<?php

$this->breadcrumbs=array(
	'Inventario'=>array('index'),
	'Update',
);
?>

<h1>Producto <?php echo $model->codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>