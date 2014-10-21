<div class="col-xs-2">
    <?php echo CHtml::activeRadioButtonList($ctp,'formaPago',array('Contado','Credito'))?>
</div>
<div class="col-xs-2">
    <?php echo CHtml::activeRadioButtonList($ctp,'tipoOrden',array('Con Factura','Sin Factura'))?>
</div>
<div class="col-xs-4">
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($ctp,'fechaPlazo',array('class'=>'col-xs-5 control-label')); ?>
        <div class="col-xs-7">
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name'=>'fechaPlazo',
                'attribute'=>'fechaPlazo',
                'language'=>'es',
                'model'=>$ctp,
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'dd-mm-yy',
                ),
                'htmlOptions'=>array(
                    'class'=>'form-control input-sm',
                    'disabled'=>(($ctp->formaPago==0)?true:false),
                ),
            ));
            ?>
        </div>
        <?php echo CHtml::error($ctp,"fechaPlazo",array('class'=>'label label-danger')); ?>
    </div>
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($ctp,'autorizado',array('class'=>'col-xs-5 control-label')); ?>
        <div class="col-xs-7">
            <?php echo CHtml::activeDropDownList($ctp, 'autorizado',array('Erick Paredes','Miriam Martinez'),array('class'=>'form-control input-sm','disabled'=>(($ctp->formaPago==0)?true:false),'id'=>"autorizado",'empty' => 'Selecciona Responsable')); ?>
        </div>
    </div>
</div>
<div class="col-xs-4">
    <div class="form-group ">
        <div class="col-xs-7">
            <?php echo CHtml::checkBoxList('Descuento',false,array('Descuento')); ?>
        </div>
        <div class="col-xs-5">
            <?php echo CHtml::activeTextField($ctp,'montoDescuento',array('class'=>'form-control input-sm','disabled'=>(empty($ctp->montoDescuento)?true:false),'id'=>'descuento')); ?>
        </div>
    </div>
    <div class="form-group ">
        <div class="col-xs-5">
            <?php echo CHtml::activeLabelEx($ctp,'factura',array('class'=>'col-xs-5 control-label')); ?>
        </div>
        <div class="col-xs-7">
            <?php echo CHtml::activeTextField($ctp,'factura',array('class'=>'form-control input-sm','disabled'=>(($ctp->tipoOrden==0)?false:(empty($ctp->factura)?true:false)),'id'=>'factura')); ?>
        </div>
    </div>
</div>

<?php
Yii::app()->getClientScript()->registerScript("check","
function factura(tipo)
{
	jsonObj = [];
	nitCi = $('#NitCi').val();
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
			url 		: '".CHtml::normalizeUrl(array('ctp/ajaxFactura'))."', // the url where we want to POST
			data 		: {detalle:jsonObj,tipo:tipo,id:".$ctp->idCTP.",cliente:nitCi}, // our data object
			dataType 	: 'json', // what type of data do we expect back from the server
            encode  	: true
		})
			.done(function(data) {
				$('#codigo').text(data['codigo']);
			    var key;
				for(key in data) {
					if(data.hasOwnProperty(key)) {

					$('#costo_'+key).val(data[key]['costo']);
			        $('#costoTotal_'+key).val(redondeo(suma($('#nroPlacas_'+key).val()*$('#costo_'+key).val(),$('#adicional_'+key).val())));
				}}
			   	calcular_total();
				$('#factura').prop('disabled', tipo);
				//alert(JSON.stringify(data));
			});
}

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
		$('#total').val(redondeo(resta($('#total').val(),$('#descuento').val())));
		cambio();
	}
	else
	{
		value = true;
		calcular_total()
	}
	$('#descuento').prop('disabled', value);
});

$('#descuento').blur(function(e){
	$('#total').val(redondeo(resta($('#total').val(),$('#descuento').val())));
	cambio();
});
",CClientScript::POS_READY);?>