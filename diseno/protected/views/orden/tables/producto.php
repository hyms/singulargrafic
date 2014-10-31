<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$productos->searchCTP(),
    'ajaxUpdate'=>true,
    'cssFile' => false,
    'itemsCssClass' => 'table table-hover table-condensed',
    //'pagerCssClass' => 'pagination', // override default css
    'htmlOptions' => array('class' => 'table-responsive'),
    'columns'=>array(
        array(
            'header'=>'Nro',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        array(
            'header'=>'Formato',
            'value'=>'$data->idProducto0->color',
        ),
        array(
            'header'=>'Tamaño',
            'value'=>'$data->idProducto0->detalle',
        ),
        array(
            'header'=>'Stock',
            'value'=>'$data->stockU',
        ),
        array(
            'header'=>'',
            'type'=>'raw',
            'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-ok\"></span> Añadir","#",array("onclick"=>\'newRow("\'.$data->idAlmacenProducto.\'");\',"class"=>"btn btn-success btn-sm"))',
        ),
    ),

));
?>
<?php Yii::app()->clientScript->registerScript('row',"

function newRow(almacen)
{
	var input = $(\"#yw3 tbody\");
	var index = 0;
	//var factura = $('#Ctp_tipoVenta_0').attr('checked')?0:1;
	var factura = 0;
	if(input.find(\".tabular-input-index\").length>0)
	{
		$(\".tabular-input-index\").each(function() {
		    index = Math.max(index, parseInt(this.value)) + 1;
		});
	}
	$.ajax({
		type: 'GET',
		url: '".CHtml::normalizeUrl(array('/orden/addDetalle'))."',
		data: 'index='+index+'&al='+almacen+'&costo=".$index."',
		dataType: 'html',
		success: function(html){
			input.append(html);
			input.siblings('.tabular-header').show();
		},

	});
	event.preventDefault();
}

",CClientScript::POS_HEAD); ?>