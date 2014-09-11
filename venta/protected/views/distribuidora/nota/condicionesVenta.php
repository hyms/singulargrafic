<div class="col-sm-2">
	<?php echo CHtml::activeRadioButtonList($venta,'formaPago',array('Contado','Credito'))?>
</div>
<div class="col-sm-2">
	<?php echo CHtml::activeRadioButtonList($venta,'tipoVenta',array('Con Factura','Sin Factura'))?>
</div>
<div class="col-sm-4">
	<div class="form-group">
		<?php echo CHtml::activeLabelEx($venta,'fechaPlazo',array('class'=>'col-sm-5 control-label')); ?>
		<div class="col-sm-7">
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	    		'name'=>'fechaPlazo',
				'attribute'=>'fechaPlazo',
				'language'=>'es',
			    'model'=>$venta,
			    'options'=>array(
			        'showAnim'=>'fold',
					'dateFormat'=>'dd-mm-yy',
			    ),
			    'htmlOptions'=>array(
			        'class'=>'form-control input-sm',
					'disabled'=>(($venta->formaPago==0)?true:false),
			    ),
			));
		?>
		</div>
		<?php echo CHtml::error($venta,"fechaPlazo",array('class'=>'label label-danger')); ?>
	</div>
	<div class="form-group">
		<?php echo CHtml::activeLabelEx($venta,'autorizado',array('class'=>'col-sm-5 control-label')); ?>
		<div class="col-sm-7">
		<?php echo CHtml::activeDropDownList($venta, 'autorizado',array('Erick Paredes','Miriam Martinez'),array('class'=>'form-control input-sm','disabled'=>(($venta->formaPago==0)?true:false),'id'=>"autorizado",'empty' => 'Selecciona Responsable')); ?>
	   	</div>
	</div>
</div>
<div class="col-sm-4">
	<div class="form-group ">
		<div class="col-sm-7">
		<?php echo CHtml::checkBoxList('Descuento',false,array('Descuento')); ?>
		</div>
		<div class="col-sm-5">
		<?php echo CHtml::activeTextField($venta,'montoDescuento',array('class'=>'form-control input-sm','disabled'=>(empty($venta->montoDescuento)?true:false),'id'=>'descuento')); ?>
		</div>
	</div>
	<div class="form-group ">
		<div class="col-sm-5">
		<?php echo CHtml::activeLabelEx($venta,'factura',array('class'=>'col-sm-5 control-label')); ?>
		</div>
		<div class="col-sm-7">
		<?php echo CHtml::activeTextField($venta,'factura',array('class'=>'form-control input-sm','disabled'=>(($venta->tipoVenta==0)?false:(empty($venta->factura)?true:false)),'id'=>'factura')); ?>
		</div>
	</div>
</div>

<?php 
$id=(!empty($venta->idVenta))?(',id:'.$venta->idVenta):"";
Yii::app()->getClientScript()->registerScript("check","
function factura(tipo)
{
	jsonObj = [];
		        
	$('#yw3 > tbody  > tr').each(function(index, value) {
		id = $(this).find('#idAlmacen').val();
		index = $(this).find('#indexs').val();
		item = {};
        item ['idAlmacenProducto'] = id;
		item ['index'] = index;
		jsonObj.push(item);
	});
		
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: '".CHtml::normalizeUrl(array('/distribuidora/ajaxFactura'))."', // the url where we want to POST
			data 		: {detalle:jsonObj,tipo:tipo".$id."}, // our data object
			dataType 	: 'json', // what type of data do we expect back from the server
            encode  	: true
		})
			.done(function(data) {
				$('#codigo').text(data['codigo']);
				var key;
				for(key in data) {
					if(data.hasOwnProperty(key)) {
			    		
					$('#costoUnidad_'+data[key]['index']).val(data[key]['precioU']);
					$('#costoPaquete_'+data[key]['index']).val(data[key]['precioP']);
			    	$('#costoTotal_'+data[key]['index']).val(redondeo(suma(suma($('#stockUnidad_'+data[key]['index']).val()*$('#costoUnidad_'+data[key]['index']).val(),$('#stockPaquete_'+data[key]['index']).val()*$('#costoPaquete_'+data[key]['index']).val()),$('#adicional_'+data[key]['index']).val())));
				}}
			   	calcular_total();
				$('#factura').prop('disabled', tipo);			
			});
			
			
}

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
			
",CClientScript::POS_READY);?>