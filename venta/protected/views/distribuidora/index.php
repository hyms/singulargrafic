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
	$this->renderPartial('ventaProducto',array('ventaTmp'=>$ventaTmp,'cliente'=>$cliente,'almacen'=>$almacen,'empleado'=>$empleado)); ?>
	
<?php 
	$this->renderPartial('producto',array('productos'=>$productos));	
?>
<h2>Detalle de Venta</h2>

<?php $this->renderPartial('detalleVenta',array('detalle'=>$detalle,'almacen'=>$almacen))?>

</div>
