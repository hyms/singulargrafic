<div class="col-sm-2">
	<?php $this->renderPartial('menu')?>
</div>
<div class="col-sm-10">
	<?php $this->renderPartial('producto/menu')?>
	<?php
	$this->widget('zii.widgets.CMenu',array(
			'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
			'activeCssClass'	=> 'active',
			'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
			'encodeLabel' => false,
			'items'=>array(
					array('label'=>'Deposito', 'url'=>array('report/productoSaldo','almacen'=>1)),
					array('label'=>'Distribuidora', 'url'=>array('report/productoSaldo','almacen'=>2)),
					array('label'=>'CTP', 'url'=>array('report/productoSaldo','almacen'=>3)),
						
			),
	));
	
	if(!empty($saldoA))// && !empty($entradas) && !empty($salidas) && !empty($saldoB))
	{
		$dataProvider =  new CArrayDataProvider($saldoA,
												array(
														'id'=>'idSaldoProducto',
														'keyField' => 'id',
														'keys'=>array('id'),
														'pagination'=>array('pageSize'=>'20',),
												));//*/
		echo "<br>Fecha: <b>".date("Y-m-d",strtotime($saldoA[0]->fechaSaldo))."</b>";
		$this->widget('zii.widgets.grid.CGridView', array(
				'dataProvider'=>$dataProvider,
				'itemsCssClass' => 'table table-hover table-condensed',
				'htmlOptions' => array('class' => 'table-responsive'),
				'columns'=>array(
						array(
								'header'=>'Codigo',
								'value'=>'$data->idAlmacen0->idProducto0->codigo'
						),
						array(
								'header'=>'Detalle',
								'value'=>'$data->idAlmacen0->idProducto0->material.", ".$data->idAlmacen0->idProducto0->color." ".$data->idAlmacen0->idProducto0->detalle.", ".$data->idAlmacen0->idProducto0->marca'
						),
						array(
								'header'=>'Cant. Unidad',
								'value'=>'$data->saldoU'
						),
						array(
								'header'=>'Cant. Paquete',
								'value'=>'$data->saldoP'
						),
				)
		));
	} 
	?>
</div>