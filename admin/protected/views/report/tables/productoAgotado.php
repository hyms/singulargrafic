<?php
    if(!empty($resultado))// && !empty($entradas) && !empty($salidas) && !empty($saldoB))
	{
?>
<div class="panel panel-default">
    <div class="panel-body" style="overflow: auto;">
<?php
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
	//echo CHtml::link('Exportar a Excel',array('report/productoAgotarse','almacen'=>$almacen,'excel'=>true),array('class'=>'btn btn-default'));
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
?>
    </div>
</div>
<?php
	}
?>

