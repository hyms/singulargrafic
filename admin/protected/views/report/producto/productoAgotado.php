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
					array('label'=>'Deposito', 'url'=>array('report/productoAgotarse','almacen'=>1)),
					array('label'=>'Distribuidora', 'url'=>array('report/productoAgotarse','almacen'=>2)),
					array('label'=>'CTP', 'url'=>array('report/productoAgotarse','almacen'=>3)),
						
			),
	));
	
	if(!empty($resultado))// && !empty($entradas) && !empty($salidas) && !empty($saldoB))
	{
		//$resultado=array();
		
		//print_r($resultado);
		$dataProvider =  new CArrayDataProvider($resultado,
				array(
						'id'=>'idAlmacenProducto',
						'keyField' => 'id',
						'keys'=>array('id','codigo','detalle','stockU','stockP'),
						'pagination'=>array('pageSize'=>'20',),
						'sort'=>array(
								'attributes'=>array(
										'id', 'codigo', 'detalle','stockU','stockP',
								),
						),
				));//
		//echo CHtml::link('Exportar a Excel',array('report/productoSaldo','almacen'=>$almacen,'excel'=>true),array('class'=>'btn btn-default'));
		
		$this->widget('zii.widgets.grid.CGridView', array(
				'dataProvider'=>$dataProvider,
				'itemsCssClass' => 'table table-hover table-condensed',
				'htmlOptions' => array('class' => 'table-responsive'),
				'columns'=>array(
						array(
								'name'=>'codigo',
								'value'=>'$data->idProducto0->codigo',
						),
						array(
								'name'=>'detalle',
								'value'=>'$data->idProducto0->material.", ".$data->idProducto0->color." ".$data->idProducto0->detalle.", ".$data->idProducto0->marca',
						),
						array(
								'name'=>'stockU',
								'header'=>'Unidad',
								'value'=>'$data->stockU',
						),
						array(
								'name'=>'stockP',
								'header'=>'Paquete',
								'value'=>'$data->stockP',
						),
				)
		));
	
	}
	?>
</div>

