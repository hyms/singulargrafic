<div class="col-sm-2">
<?php $this->renderPartial('menus/principal'); ?>
</div>
<div class="col-sm-10">
<?php
switch ($render){
	case "ordenes":
        $this->renderPartial('tables/ordenes',array('ordenes'=>$ordenes,'estado'=>$estado));
		break;
	case "orden":
		$this->renderPartial('orden',array('ctp'=>$ctp,'detalle'=>$detalle,'cliente'=>$cliente));
		break;
	default:
		$this->renderPartial('index');
		break;
}
?>
</div>