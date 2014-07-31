<div class="col-sm-2">
<?php $this->renderPartial('./menu'); ?>
</div>

<div class="col-sm-10">
<?php $this->renderPartial('./arqueo/menuArqueo');?>
<?php

//$saldo = CajaArqueo::model()->findByPk($arqueo->idCajaArqueo-1);
//$saldo = CajaArqueo::model()->find(array('condition'=>"idCajaArqueo=".($arqueo->idCajaArqueo-1)." and idCaja=2"));
$saldo = CajaArqueo::model()->find(array('condition'=>"idCaja=2 and idCajaArqueo<".$arqueo->idCajaArqueo,'order'=>'idCajaArqueo Desc'));
//print_r($saldo);
if(empty($saldo))
	$saldo = 0;
else
	$saldo = $saldo->saldo;
?>
<?php $this->renderPartial('./arqueo/registroDiario',array('fecha'=>$fecha,'saldo'=>$saldo,'ventas'=>$ventas,'recibos'=>$recibos,'arqueo'=>$arqueo));?>
</div>