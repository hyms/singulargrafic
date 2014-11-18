<div class = "row">
    <h3 class="col-xs-4">Recibo Ingreso</h3>
    <h3 class="col-xs-4 text-center"><?php echo $recibo->codigo;?></h3>
    <h3 class="col-xs-4 text-right"><?php echo date("d/m/Y",strtotime($recibo->fechaRegistro));?></h3>

</div>
<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'detalle-venta-detalleVenta-form',
    //'action'=>CHtml::normalizeUrl(array('/distribuidora/index')),
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
        'role'=>'form'
    ),
));
?>

<?php $this->renderPartial('forms/formRecibo',array('recibo'=>$recibo)); ?>

<?php $this->endWidget(); ?>

<?php Yii::app()->getClientScript()->registerScript("ajax_cliente",
    "

	function cliente (nitCi)
	{
		nitCi = jQuery.trim(nitCi);
		if(nitCi.length>0){
	        $.ajax({
	            url: '".CHtml::normalizeUrl(array('recibos/llenado'))."',
				type: 'GET',
				data: { nitCi: nitCi},
				success: function (data){
					data = JSON.parse(data);
					llenado(data);
					//alert(data);
				},
			});
		}
	}

	function llenado(data)
	{
		$('#apellido').val(data['Cliente']['apellido']);
		$('#codigo').val(data['Venta']['codigo']);
		$('#monto').val(data['Credito']['saldo']);
		$('#categoria').val(data['categoria'])
		$('#concepto').val(data['concepto'])
	}
		$('#nitCi').keydown(function(e){
			if(e.keyCode==13 || e.keyCode==9)
			{
				if($('#nitCi').val()!=\"\")
					cliente($('#nitCi').val())
				return true;
			}
		});

		$('#nitCi').blur(function(e){
			if($('#nitCi').val()!=\"\")
				cliente($('#nitCi').val())
		});
",CClientScript::POS_READY);