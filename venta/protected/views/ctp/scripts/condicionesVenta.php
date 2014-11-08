<?php
Yii::app()->getClientScript()->registerScript("ajax_condiciones","
function formaPago(value)
{
	$('#fechaPlazo').prop('disabled', value);
	$('#autorizado').prop('disabled', value);
}

$('#CTP_tipoOrden_0').change(function(){
	factura(0);
});

$('#CTP_tipoOrden_1').change(function(){
	factura(1);
});

$('#CTP_formaPago_0').change(function(){
	formaPago(true);
});

$('#CTP_formaPago_1').change(function(){
	formaPago(false);
});

$('#Descuento_0').change(function(){
	var value;
	if($('#Descuento_0').is(':checked'))
	{
		value = false;
		$('#total').val(descuentoP($('#total').val(),$('#descuento').val()));
		cambio();
	}
	else
	{
		value = true;
		calcular_total()
	}
	$('#descuento').prop('disabled', value);
	$('#autorizado').prop('disabled', value);
});

$('#descuento').keydown(function(e){
   	if(e.keyCode==13 || e.keyCode==9)
	{
		$('#total').val(descuentoP($('#total').val(),$('#descuento').val()));
		cambio();
	}
});
		
",CClientScript::POS_READY);