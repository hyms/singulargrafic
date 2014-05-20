<?php
/* @var $this DistribuidoraController */

$this->breadcrumbs=array(
	'Recibos',
);
?>
<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
<?php $this->renderPartial("menuCaja");?>
<?php 
	if($ld)
	{
		$this->renderPartial('libroDiario',array('tabla'=>$tabla,'caja'=>$caja,));
	}
	if($ce)
	{
		$this->renderPartial('comprobante',array('caja'=>$caja));
	}
?>

</div>
<?php 
$script = "
		function printView()
		{
			window.print();
		
		}";
Yii::app()->clientScript->registerScript("print",$script,CClientScript::POS_HEAD);
?>