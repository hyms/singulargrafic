<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$productos->searchDistribuidora(),
		'filter'=>$productos,
		//'ajaxUpdate'=>true,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
			array(
					'header'=>'Nro',
					'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
			),
			array(
					'header'=>'Almacen',
					'value'=>'$data->idAlmacen0->nombre',
					'filter'=>CHtml::activeDropDownList($productos,'idAlmacen',CHtml::listData(Almacen::model()->findAll(),'idAlmacen','nombre'),array("class"=>"form-control ",'empty'=>'')),
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
	if(input.find(\".tabular-input-index\").length>0)
	{
		$(\".tabular-input-index\").each(function() {
		    index = Math.max(index, parseInt(this.value)) + 1;
		});
	}		
	$.ajax({
		type: 'GET',
		url: '".CHtml::normalizeUrl(array('/caja/addDetalle'))."',
		data: 'index='+index+'&al='+almacen,
		dataType: 'html',
		success: function(html){
			input.append(html);
			input.siblings('.tabular-header').show();
		},
		
	});
	event.preventDefault();
}

$('#document').ready(function(){
    $('.openDlg').live('click', function(){
        var dialogId = $(this).attr('class').replace('openDlg ', '');
        $.ajax({
            'type': 'GET',
            'url' : $(this).attr('href'),
            success: function (data) {
            	
                $('#'+dialogId+' div.divForForm').html(data);
               $( '#'+dialogId ).dialog( 'open' );
            },
            dataType: 'html',
        });
        return false; // prevent normal submit
    })
});

",CClientScript::POS_HEAD); ?>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array('id'=>'divDialog',
    'options'=>array( 'title'=>'Añadir a Stock', 'autoOpen'=>false, 'modal'=>true, 'width'=>800)));
?>
    <div class="divForForm"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>