<div class="col-sm-2">
<?php $this->renderPartial('distribuidora/menu');?>
</div>
<div class="col-sm-10">
<?php
if($index==1)
{
	$this->renderPartial('distribuidora/productos',array('productos'=>$productos));
}	
?>
</div>