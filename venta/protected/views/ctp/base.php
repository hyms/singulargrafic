<div class="col-sm-2 hidden-print">
<?php $this->renderPartial('menus/principal'); ?>
</div>
<div class="col-sm-10">
<?php
switch ($render){
	case "ordenes":
        $this->renderPartial('tables/ordenes',array('ordenes'=>$ordenes,'estado'=>$estado));
		break;
	case "orden":
		$this->renderPartial('forms/orden',array('ctp'=>$ctp,'detalle'=>$detalle,'cliente'=>$cliente));
        $this->renderPartial('scripts/save');
		break;
    case "deudores":
        $this->renderPartial('tables/deudores',array('deudores'=>$deudores));
        break;
    case "movimientos":
        $this->renderPartial('menus/movimientos');
        $this->renderPartial('tables/movimientos',array('ventas'=>$ventas,'saldo'=>$saldo,'cond3'=>$cond3,'cf'=>$cf,'sf'=>$sf));
        break;
    case "preview":
        $this->renderPartial('prints/preview',array('ctp'=>$ctp,'tipo'=>$tipo));
        $this->renderPartial('scripts/print');
        break;
    case "previewTI":
        $this->renderPartial('previewTI',array('ctp'=>$ctp,'tipo'=>$tipo,'titulo'=>$titulo));
        $this->renderPartial('scripts/print');
        break;
    case "previewSC":
        $this->renderPartial('previewSC',array('ctp'=>$ctp,'tipo'=>$tipo,'titulo'=>$titulo));
        $this->renderPartial('scripts/print');
        break;
    case "previewDay":
        $this->renderPartial('menus/movimientos');
        $this->renderPartial("movimientos/previewVentas",array('tabla'=>$tabla,));
        $this->renderPartial('scripts/print');
        break;
	default:
		$this->renderPartial('index');
		break;
}
?>
</div>