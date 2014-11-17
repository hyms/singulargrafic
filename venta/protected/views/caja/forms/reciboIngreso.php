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
<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title"><strong>Datos Cliente</strong></span>
    </div>
    <div class="panel-body" style="overflow: auto;">
        <div class="form-group" >
            <div class="col-xs-4">
                <?php echo CHtml::activeLabelEx($cliente,'nitCi',array('class'=>'control-label col-xs-4')); ?>
                <div class="col-xs-8">
                    <?php echo CHtml::activeTextField($cliente,'nitCi',array('class'=>'form-control ',"id"=>"nitCi")); ?>
                </div>
                <?php echo CHtml::error($cliente,'nitCi',array('class'=>'label label-danger')); ?>
            </div>
            <div class="col-xs-5">
                <?php echo CHtml::activeLabelEx($cliente,'apellido',array('class'=>'control-label col-xs-4')); ?>
                <div class="col-xs-8">
                    <?php echo CHtml::activeTextField($cliente,'apellido',array('class'=>'form-control',"id"=>"apellido")); ?>
                </div>
                <?php echo CHtml::error($cliente,'apellido',array('class'=>'label label-danger')); ?>
            </div>
        </div>
        <div class="form-group" >
            <div class="col-xs-4">
                <?php echo CHtml::activeLabelEx($recibo,'celular',array('class'=>'control-label col-xs-4')); ?>
                <div class="col-xs-8">
                    <?php echo CHtml::activeTextField($recibo,'celular',array('class'=>'form-control')); ?>
                </div>
                <?php echo CHtml::error($recibo,'celular',array('class'=>'label label-danger')); ?>
            </div>
            <div class="col-xs-5">
                <?php echo CHtml::activeLabelEx($recibo,'responsable',array('class'=>'control-label col-xs-4')); ?>
                <div class="col-xs-8">
                    <?php echo CHtml::activeTextField($recibo,'responsable',array('class'=>'form-control ')); ?>
                </div>
                <?php echo CHtml::error($recibo,'responsable',array('class'=>'label label-danger')); ?>
            </div>
        </div>
    </div>
</div>

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