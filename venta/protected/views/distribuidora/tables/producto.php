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
					'filter'=>CHtml::activeTextField($productos, 'codigo',array("class"=>"form-control")),
			),
			array(
					'header'=>'Material',
					'value'=>'$data->idProducto0->material',
					'filter'=>CHtml::activeDropDownList($productos,'material',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'material','select'=>'material','condition'=>'idAlmacen=2')),'material','material'),array("class"=>"form-control ",'empty'=>'')),
			),
			array(
					'header'=>'Color',
					'value'=>'$data->idProducto0->color',
					'filter'=>CHtml::activeDropDownList($productos,'color',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'color','select'=>'color','condition'=>'idAlmacen=2')),'color','color'),array("class"=>"form-control ",'empty'=>'')),
			),
			array(
					'header'=>'Detalle',
					'value'=>'$data->idProducto0->detalle',
					'filter'=>CHtml::activeTextField($productos, 'detalle',array("class"=>"form-control")),
			),
			array(
					'header'=>'Industria',
					'value'=>'$data->idProducto0->marca',
					'filter'=>CHtml::activeDropDownList($productos,'marca',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'marca','select'=>'marca','condition'=>'idAlmacen=2')),'marca','marca'),array("class"=>"form-control",'empty'=>'')),
			),
			array(
					'header'=>'Cant.xPaqt.',
					'value'=>'$data->idProducto0->cantXPaquete',
					'filter'=>CHtml::activeDropDownList($productos,'paquete',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'cantXPaquete','select'=>'cantXPaquete','condition'=>'idAlmacen=2')),'cantXPaquete','cantXPaquete'),array("class"=>"form-control",'empty'=>'')),
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
					'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-ok\"></span>","#",array("onclick"=>\'newRow("\'.$data->idAlmacenProducto.\'");\',"class"=>"btn btn-success btn-sm","title"=>"Añadir a lista"))',
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-import\"></span>",array("distribuidora/productos","id"=>$data->idAlmacenProducto), array("class" => "openDlg divDialog","title"=>"Añadir a Stock"))',
			),
		)
	));
?>
<?php
$url=CHtml::normalizeUrl(array('/distribuidora/addDetalle')); 
$this->renderPartial("scripts/addList",array('url'=>$url));
$this->renderPartial("scripts/modal");

$this->beginWidget('zii.widgets.jui.CJuiDialog', array('id'=>'divDialog',
    'options'=>array( 'title'=>'Añadir a Stock', 'autoOpen'=>false, 'modal'=>true, 'width'=>800)));
?>
    <div class="divForForm"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>