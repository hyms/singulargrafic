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
						'value'=>'($row+1)',
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
		'dataProvider'=>$productos,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
				array(
						'header'=>'Nro',
						'value'=>'($row+1)',
				),
				array(
						'header'=>'Codigo',
						'type'=>'raw',
						'value'=>'$data->idAlmacenProducto0->idProducto0->codigo',
				),
				array(
						'header'=>'Detalle',
						'type'=>'raw',
						'value'=>'$data->idAlmacenProducto0->idProducto0->material." ".$data->idAlmacenProducto0->idProducto0->color." ".$data->idAlmacenProducto0->idProducto0->detalle." ".$data->idAlmacenProducto0->idProducto0->marca',
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
	