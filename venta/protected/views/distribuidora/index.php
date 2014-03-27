<?php
/* @var $this DistribuidoraController */

$this->breadcrumbs=array(
	'Distribuidora',
);
?>
<div class="col-md-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-md-10">
<h2>Nueva Venta</h2>
<?php 
	$this->renderPartial('ventaProducto',array('model'=>$model)); ?>
	
<?php 
	$this->renderPartial('producto',array(
			'dataProvider'=>$dataProvider,
	)); ?>
</div>