<?php
Yii::app()->getClientScript()->registerScript("ajax_condiciones","
function formaPago(value)
{
	$('#fechaPlazo').prop('disabled', value);
	$('#autorizado').prop('disabled', value);
}
			
$('#Venta_tipoVenta_0').change(function(){
	factura(0);
});
		
$('#Venta_tipoVenta_1').change(function(){
	factura(1);
});
			
$('#Venta_formaPago_0').change(function(){
	formaPago(true);
});

$('#Venta_formaPago_1').change(function(){
	formaPago(false);
});

	function descuentoP(total,descuento)
	{
		if(descuento.indexOf('%')>0)
		{
			var tmp = parseInt(descuento.substring(0, descuento.length-1));
			descuento = parseFloat((tmp/100)*total);
			$('#descuento').val(redondeo(descuento));
		}
		total = redondeo(resta(total,descuento));
		return total;
	}
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
});

$('#descuento').keydown(function(e){
   	if(e.keyCode==13 || e.keyCode==9)
	{
		$('#total').val(descuentoP($('#total').val(),$('#descuento').val()));
		cambio();
	}
});
		
",CClientScript::POS_READY);