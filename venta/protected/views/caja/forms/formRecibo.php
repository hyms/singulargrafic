<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title"><strong>Datos Recibo</strong></span>
    </div>
    <div class="panel-body">
        <div class="form-group" >
            <div class="col-xs-8">
                <?php echo CHtml::activeLabelEx($recibo,'concepto',array('class'=>'control-label col-xs-3')); ?>
                <div class="col-xs-9">
                    <?php echo CHtml::activeTextArea($recibo,'concepto',array('class'=>'form-control ',"id"=>"concepto")); ?>
                </div>
                <?php echo CHtml::error($recibo,'concepto',array('class'=>'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group" >
            <div class="col-xs-4">
                <?php echo CHtml::activeLabelEx($recibo,'categoria',array('class'=>'control-label col-xs-3')); ?>
                <div class="col-xs-9">
                    <?php //echo CHtml::activeTextField($recibo,'categoria',array('class'=>'form-control ',"id"=>"categoria")); ?>
                    <?php echo CHtml::activeDropDownList($recibo,'categoria',array('Nota de Venta'=>'Nota de Venta','Orden de Trabajo'=>'Orden de Trabajo'),array('class'=>'form-control ',"id"=>"concepto")); ?>

                </div>
                <?php echo CHtml::error($recibo,'categoria',array('class'=>'label label-danger')); ?>
            </div>
            <div class="col-xs-4">
                <?php echo CHtml::activeLabelEx($recibo,'codigoNumero',array('class'=>'control-label col-xs-3')); ?>
                <div class="col-xs-9">
                    <?php echo CHtml::activeTextField($recibo,'codigoNumero',array('class'=>'form-control ',"id"=>"codigo")); ?>
                </div>
                <?php echo CHtml::error($recibo,'codigoNumero',array('class'=>'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group" >
            <div class="col-xs-4">
                <?php echo CHtml::activeLabelEx($recibo,'monto',array('class'=>'control-label col-xs-3')); ?>
                <div class="col-xs-9">
                    <?php echo CHtml::activeTextField($recibo,'monto',array('class'=>'form-control ',"id"=>"monto")); ?>
                </div>
                <?php echo CHtml::error($recibo,'monto',array('class'=>'label label-danger')); ?>
            </div>
            <div class="col-xs-4">
                <?php echo CHtml::activeLabelEx($recibo,'acuenta',array('class'=>'control-label col-xs-3')); ?>
                <div class="col-xs-9">
                    <?php echo CHtml::activeTextField($recibo,'acuenta',array('class'=>'form-control ',"id"=>"acuenta")); ?>
                </div>
                <?php echo CHtml::error($recibo,'acuenta',array('class'=>'label label-danger')); ?>
            </div>
            <div class="col-xs-4">
                <?php echo CHtml::activeLabelEx($recibo,'saldo',array('class'=>'control-label col-xs-3')); ?>
                <div class="col-xs-9">
                    <?php echo CHtml::activeTextField($recibo,'saldo',array('class'=>'form-control ',"id"=>"saldo","readonly"=>true)); ?>
                </div>
                <?php echo CHtml::error($recibo,'saldo',array('class'=>'label label-danger')); ?>
            </div>
        </div>
        <div class="form-group" >
            <div class="col-xs-8">
                <?php echo CHtml::activeLabelEx($recibo,'obs',array('class'=>'control-label col-xs-3')); ?>
                <div class="col-xs-9">
                    <?php echo CHtml::activeTextArea($recibo,'obs',array('class'=>'form-control ')); ?>
                </div>
                <?php echo CHtml::error($recibo,'obs',array('class'=>'label label-danger')); ?>
            </div>
        </div>

    </div>
</div>
<div class="form-group">
    <div class="text-center">
        <?php echo CHtml::resetButton('Cancelar', array('class' => 'btn btn-default hidden-print')); ?>
        <?php echo CHtml::submitButton('Continuar',array('class'=>'btn btn-default hidden-print')); ?>
    </div>
</div>