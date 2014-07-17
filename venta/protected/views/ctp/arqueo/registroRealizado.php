<div class="col-sm-2">
<?php $this->renderPartial('./menu'); ?>
</div>

<div class="col-sm-10">
<?php $this->renderPartial('./arqueo/menuArqueo');?>
<?php

$saldo = 0;
$saldo = CajaArqueo::model()->findByPk($arqueo->idCajaArqueo-1);
if(!isset($saldo))
	$saldo = 0;
else
	$saldo = $saldo->saldo;
?>
<?php $this->renderPartial('./arqueo/registroDiario',array('fecha'=>$fecha,'saldo'=>$saldo,'ventas'=>$ventas,'recibos'=>$recibos,'arqueo'=>$arqueo));?>
</div>