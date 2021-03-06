<div class="col-xs-2">
    <?php echo CHtml::activeRadioButtonList($venta,'formaPago',array('Contado','Credito'))?>
</div>
<div class="col-xs-2">
    <?php echo CHtml::activeRadioButtonList($venta,'tipoVenta',array('Con Factura','Sin Factura'))?>
</div>
<div class="col-xs-4">
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($venta,'fechaPlazo',array('class'=>'col-xs-5 control-label')); ?>
        <div class="col-xs-7">
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
        <?php echo CHtml::activeLabelEx($venta,'autorizado',array('class'=>'col-xs-5 control-label')); ?>
        <div class="col-xs-7">
            <?php echo CHtml::activeDropDownList($venta, 'autorizado',array('Erick Paredes','Miriam Martinez'),array('class'=>'form-control input-sm','disabled'=>(($venta->formaPago==0)?true:false),'id'=>"autorizado",'empty' => 'Selecciona Responsable')); ?>
        </div>
    </div>
</div>
<div class="col-xs-4">
    <div class="form-group ">
        <div class="col-xs-7">
            <?php echo CHtml::checkBoxList('Descuento',false,array('Descuento')); ?>
        </div>
        <div class="col-xs-5">
            <?php echo CHtml::activeTextField($venta,'montoDescuento',array('class'=>'form-control input-sm','disabled'=>(empty($venta->montoDescuento)?true:false),'id'=>'descuento')); ?>
        </div>
    </div>
    <div class="form-group ">
        <div class="col-xs-5">
            <?php echo CHtml::activeLabelEx($venta,'factura',array('class'=>'col-xs-5 control-label')); ?>
        </div>
        <div class="col-xs-7">
            <?php echo CHtml::activeTextField($venta,'factura',array('class'=>'form-control input-sm','disabled'=>(($venta->tipoVenta==0)?false:(empty($venta->factura)?true:false)),'id'=>'factura')); ?>
        </div>
    </div>
</div>

<?php
$id=(!empty($venta->idVenta))?(',id:'.$venta->idVenta):"";
$url=CHtml::normalizeUrl(array('/distribuidora/ajaxFactura'));
$this->renderPartial("scripts/factura",array('id'=>$id,'url'=>$url));
$this->renderPartial("scripts/condicionesVenta");
?>