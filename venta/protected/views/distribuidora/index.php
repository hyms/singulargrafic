<?php
$this->breadcrumbs=array(
	'Distribuidora',
);
?>
<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Top 5 Clientes</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$ventas,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
				array(
						'header'=>'Nro',
						'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
				),
				array(
						'header'=>'NitCi',
						'type'=>'raw',
						'value'=>'$data->idCliente0->nitCi',
				),
				array(
						'header'=>'Apellido',
						'type'=>'raw',
						'value'=>'$data->idCliente0->apellido',
				),
				array(
						'header'=>'cantidad',
						'type'=>'raw',
						'value'=>'$data->cantidad',
				),
		)
	));
 ?>
 </div>
	</div>

<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Top 5 Productos</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$ventas,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
				array(
						'header'=>'Nro',
						'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
				),
				array(
						'header'=>'Codigo',
						'type'=>'raw',
						'value'=>'$data->idProducto0->codigo',
				),
				array(
						'header'=>'Detalle',
						'type'=>'raw',
						'value'=>'$data->idProducto0->material." ".$data->idProducto0->color." ".$data->idProducto0->detalle." ".$data->idProducto0->procedencia',
				),
				array(
						'header'=>'cantidad',
						'type'=>'raw',
						'value'=>'$data->cantidad',
				),
		)
	));
 ?>
 </div>
	</div>
	
</div>
