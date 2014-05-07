<?php
/* @var $this DistribuidoraController */

$this->breadcrumbs=array(
	'Recibos',
);
?>
<div class="col-sm-2 hidden-print">
<?php $this->renderPartial('menu'); ?>
</div>


<div class="col-sm-10">
<?php $this->renderPartial('listaCliente',array('cliente'=>$cliente,'datos'=>$datos,'pages' => $pages));?>
</div>
