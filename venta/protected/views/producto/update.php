<?php
/* @var $this ProductoController */
/* @var $model Producto */

$this->breadcrumbs=array(
	'Productos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>
<div class="col-md-2">
<?php $this->renderPartial('/distribuidora/menu'); ?>
</div>

<div class="col-md-10">
<h1>Producto <?php echo $model->codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>