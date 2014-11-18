<div class="hidden-print">
    <?php echo CHtml::link('<span class="glyphicon glyphicon-print"></span>', '#', array("class"=>"btn btn-default","id"=>"print")); ?>
</div>

<div class="form-group" style="width:793px; height:529px;">

    <h3 class="text-center"><?php echo "<strong>RECIBO DE ".(($recibo->tipoRecivo==0)?"EGRESO":"INGRESO")." ".$recibo->codigo."</strong> "; ?></h3>

    <div class="row">
        <span class="col-xs-6"><strong><?php echo "Nombre:";?></strong> <?php echo $recibo->responsable;?></span>
        <span class="col-xs-3"><strong><?php echo "Nit/Ci:";?></strong> <?php echo $recibo->celular;?></span>
        <span class="col-xs-3"><strong>Fecha: </strong><?php echo date("d-m-Y",strtotime($recibo->fechaRegistro));?></span>

        <span class="col-xs-12"><strong><?php echo "Concepto: ";?></strong><?php echo $recibo->concepto;?></span>
        <span class="col-xs-12"><strong><?php echo "Categoria: ";?></strong><?php echo $recibo->categoria . " Nº " . $recibo->codigoNumero;?></span>
    </div>
    <div class="row">
        <div class="col-xs-6"><div class="well well-sm"> <strong>Saldo: </strong>Bs. <?php echo $recibo->monto;?> ( <?php $this->widget('ext.numerosALetras', array('valor'=>$recibo->monto,'despues'=>''))?>)</div></div>
        <div class="col-xs-3"><div class="well well-sm"><strong>A/C: </strong>Bs. <?php echo $recibo->acuenta;?></div></div>
        <div class="col-xs-3"><div class="well well-sm"><strong>Total: </strong>Bs. <?php echo ($recibo->saldo+$recibo->acuenta+$recibo->monto);?></div></div>
    </div>
    <div class="row">
        <div class="col-xs-offset-1 col-xs-4 well">
            <br><br>
            <p class="text-center"><?php echo "firma";?></p>
            <span><?php echo "Nombre: ".((empty($recibo->idCliente0))?$recibo->responsable:"")?></span>
            <p class="text-center"><?php echo "Entregue conforme";?></p>
        </div>
        <div class="col-xs-offset-1 col-xs-4 well">
            <br><br>
            <p class="text-center"><?php echo "firma";?></p>
            <?php $empleado=Users::model()->with('idEmpleado0')->findByPk(Yii::app()->user->id)?>
            <span><?php echo "Nombre: ".$empleado->idEmpleado0->nombre." ".$empleado->idEmpleado0->apellido?></span>
            <p class="text-center"><?php echo "Recibi conforme";?></p>
        </div>
    </div>
    <p class="row">
        <span class="col-xs-4"> <strong><?php echo "Obs:";?></strong> <?php echo $recibo->obs;?></span>
    </p>

</div>
<?php
$this->renderPartial('scripts/print');
?>