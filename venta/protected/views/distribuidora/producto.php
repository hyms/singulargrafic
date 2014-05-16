<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$productos->searchDistribuidora(),
		'filter'=>$productos,
		'ajaxUpdate'=>true,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
			array(
					'header'=>'Nro',
					'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
			),
			array(
					'header'=>'Codigo',
					'value'=>'$data->idProducto0->codigo',
					'filter'=>CHtml::activeTextField($productos, 'codigo',array("class"=>"form-control input-sm")),
			),
			array(
					'header'=>'Material',
					'value'=>'$data->idProducto0->material',
					'filter'=>CHtml::activeDropDownList($productos,'material',CHtml::listData(Producto::model()->findAll(array('group'=>'material','select'=>'material')),'material','material'),array("class"=>"form-control input-sm",'empty'=>'')),
			),
			array(
					'header'=>'Color',
					'value'=>'$data->idProducto0->color',
					'filter'=>CHtml::activeDropDownList($productos,'color',CHtml::listData(Producto::model()->findAll(array('group'=>'color','select'=>'color')),'color','color'),array("class"=>"form-control input-sm",'empty'=>'')),
			),
			array(
					'header'=>'Detalle',
					'value'=>'$data->idProducto0->detalle',
					'filter'=>CHtml::activeTextField($productos, 'detalle',array("class"=>"form-control input-sm")),
			),
			array(
					'header'=>'Industria',
					'value'=>'$data->idProducto0->marca',
					'filter'=>CHtml::activeDropDownList($productos,'marca',CHtml::listData(Producto::model()->findAll(array('group'=>'marca','select'=>'marca')),'marca','marca'),array("class"=>"form-control input-sm",'empty'=>'')),
			),
			array(
					'header'=>'Cant.xPaqt.',
					'value'=>'$data->idProducto0->cantXPaquete',
					'filter'=>CHtml::activeDropDownList($productos,'paquete',CHtml::listData(Producto::model()->findAll(array('group'=>'cantXPaquete','select'=>'cantXPaquete')),'cantXPaquete','cantXPaquete'),array("class"=>"form-control input-sm",'empty'=>'')),
			),
			array(
					'header'=>'Precio CF',
					'value'=>'$data->idProducto0->precioCFU."/".$data->idProducto0->precioCFP',
			),
			array(
					'header'=>'Precio SF',
					'value'=>'$data->idProducto0->precioSFU."/".$data->idProducto0->precioSFP',
			),
			array(
					'header'=>'Stock Unidad',
					'value'=>'$data->stockU',
			),
			array(
					'header'=>'Stock Paquete',
					'value'=>'$data->stockP',
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("Añadir","#",array("onclick"=>\'newRow("\'.$data->idAlmacenProducto.\'");\',"class"=>"btn btn-success btn-sm"))',
			),
		)
	));
?>
<?php Yii::app()->clientScript->registerScript('row',"

function newRow(almacen)
{
	
	var input = $(\"#yw3 tbody\");
	var index = 0;
	var factura = $('#Venta_tipoVenta_0').attr('checked')?0:1;
	if(input.find(\".tabular-input-index\").length>0)
	{
		$(\".tabular-input-index\").each(function() {
		    index = Math.max(index, parseInt(this.value)) + 1;
		});
	}		
	$.ajax({
		type: 'GET',
		url: '".CHtml::normalizeUrl(array('/distribuidora/addDetalle'))."',
		data: 'index='+index+'&al='+almacen+'&factura='+factura,
		dataType: 'html',
		success: function(html){
			input.append(html);
			input.siblings('.tabular-header').show();
		},
		
	});
	event.preventDefault();
}

",CClientScript::POS_HEAD); ?>