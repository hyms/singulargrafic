<div class="col-sm-2">
	<?php $this->renderPartial('menu')?>
</div>
<div class="col-sm-10">
	<?php $this->renderPartial('venta/menu')?>
	<?php $this->renderPartial('venta/movimientos',array('ventas'=>$ventas,'cond1'=>$cond1,'cond2'=>$cond2,'saldo'=>$saldo,'cf'=>$cf,'sf'=>$sf))?>
</div>
