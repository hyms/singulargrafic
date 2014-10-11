<?php Yii::app()->clientScript->registerScript('ajax_newRow',"
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
		url: '".CHtml::normalizeUrl(array('ctp/addDetalle'))."',
		data: 'index='+index+'&al='+almacen+'&factura='+factura,
		dataType: 'html',
		success: function(html){
			input.append(html);
			input.siblings('.tabular-header').show();
		},
		
	});
	event.preventDefault();
}
",CClientScript::POS_HEAD);