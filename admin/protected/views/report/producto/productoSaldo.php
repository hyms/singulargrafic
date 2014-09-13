<div class="col-sm-2">
	<?php $this->renderPartial('./menu')?>
</div>
<div class="col-sm-10">
<div>
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
		$resultado=array();
		
		foreach ($saldoA as $key=>$item)
		{
			$resultado[$key]=array(
					'id'=>$item->idAlmacen,
					'codigo'=>$item->idAlmacen0->idProducto0->codigo,
					'detalle'=>$item->idAlmacen0->idProducto0->material.", ".$item->idAlmacen0->idProducto0->color." ".$item->idAlmacen0->idProducto0->detalle.", ".$item->idAlmacen0->idProducto0->marca,
					'saldoAnterior'=>array('saldoU'=>$item->saldoU,'saldoP'=>$item->saldoP),
					'entradas'=>array('saldoU'=>$entradas[$key]['unidad'],'saldoP'=>$entradas[$key]['paquete']),
					'salidas'=>array('saldoU'=>$salidas[$key]['unidad'],'saldoP'=>$salidas[$key]['paquete']),
					'saldoActual'=>array('saldoU'=>$saldoB[$key]->saldoU,'saldoP'=>$saldoB[$key]->saldoP),
					'costo'=>$costos[$key],
			);
		}
		//print_r($resultado);
		$dataProvider =  new CArrayDataProvider($resultado,
				array(
						'id'=>'idAlmacen',
						'keyField' => 'id',
						'keys'=>array('id','codigo','detalle','saldoAnterior','entradas','salidas','saldoActual'),
						'pagination'=>array('pageSize'=>'20',),
						'sort'=>array(
								'attributes'=>array(
										'id', 'codigo', 'detalle','saldoAnterior','entradas','salidas','saldoActual','costo',
								),
						),
				));//
		echo CHtml::link('Exportar a Excel',array('report/productoSaldo','almacen'=>$almacen,'excel'=>true),array('class'=>'btn btn-default'));
		
		$this->widget('zii.widgets.grid.CGridView', array(
				'dataProvider'=>$dataProvider,
				'itemsCssClass' => 'table table-hover table-condensed',
				'htmlOptions' => array('class' => 'table-responsive'),
				'columns'=>array(
						array(
								'name'=>'codigo',
								'value'=>'$data["codigo"]',
						),
						array(
								'name'=>'detalle',
								'value'=>'$data["detalle"]'
						),
						array(
								'header'=>'Saldo Anterior',
								'name'=>'saldoAnterior',
								'type'=>'raw',
								'value'=>'$data["saldoAnterior"]["saldoU"]."</td><td>".$data["saldoAnterior"]["saldoP"]',
								'headerHtmlOptions'=>array('colspan'=>'2','class'=>'col-sm-1'),
								'htmlOptions'=>array('class'=>'text-right'),
						),
						array(
								'header'=>'Entradas',
								'name'=>'entradas',
								'type'=>'raw',
								'value'=>'$data["entradas"]["saldoU"]."</td><td>".$data["entradas"]["saldoP"]',
								'headerHtmlOptions'=>array('colspan'=>'2','class'=>'col-sm-1'),
								'htmlOptions'=>array('class'=>'text-right'),
						),
						array(
								'header'=>'Salidas',
								'name'=>'salidas',
								'type'=>'raw',
								'value'=>'$data["salidas"]["saldoU"]."</td><td>".$data["salidas"]["saldoP"]',
								'headerHtmlOptions'=>array('colspan'=>'2','class'=>'col-sm-1'),
								'htmlOptions'=>array('class'=>'text-right'),
						),
						array(
								'header'=>'Saldo Actual',
								'name'=>'saldoActual',
								'type'=>'raw',
								'value'=>'$data["saldoActual"]["saldoU"]."</td><td>".$data["saldoActual"]["saldoP"]',
								'headerHtmlOptions'=>array('colspan'=>'2','class'=>'col-sm-1'),
								'htmlOptions'=>array('class'=>'text-right'),
						),
						array(
								'name'=>'costo',
								'type'=>'raw',
								'value'=>'$data["costo"]',
						),
						
				)
		));//*/
	?>
	</div>
	<div class="col-sm-offset-9">
		<div class="well well-sm">
		<?php 
		$total = 0;
		foreach ($costos as $costo)
		{
			$total=$total+$costo;
		}
		echo "<b>Total:</b>".$total;
		?>
		</div>
	</div>
	<?php 
	}
	?>
</div>

