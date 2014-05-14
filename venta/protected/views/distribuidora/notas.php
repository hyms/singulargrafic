<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
	<h3>Stock</h3>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Lista de Productos</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial('producto',array('productos'=>$productos))?>
	  	</div>
	</div>
	<h3>Notas de Venta</h3>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Datos Cliente</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial('cliente',array('cliente'=>$cliente))?>
	  	</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Datos Compra</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial('detalleVenta',array('detalle'=>$detalle))?>
	  	</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Condiciones de Venta</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
	  	</div>
	</div>
<?php
?>
</div>