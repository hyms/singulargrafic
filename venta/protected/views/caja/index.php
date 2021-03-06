<div class="col-xs-2 hidden-print">
    <?php $this->renderPartial('menus/principal'); ?>
</div>
<div class="col-xs-10">
    <?php
    switch($render) {
        case "deuda":
        case "reciboIngreso":
            $this->renderPartial("forms/reciboIngreso", array('cliente' => $cliente, 'recibo' => $recibo,));
            break;
        case "preview":
            $this->renderPartial('prints/preview', array('recibo' => $recibo));
            break;
        case "buscar":
            $this->renderPartial("tables/buscar", array('recibos' => $recibos));
            break;
        case "modificar":
            if ($recibo->tipoRecivo == 1)
                $this->renderPartial("forms/reciboIngreso", array('recibo' => $recibo,));
            if ($recibo->tipoRecivo == 0)
                $this->renderPartial("forms/reciboEgreso", array('recibo' => $recibo,));
            break;
        case "clientes":
            $this->renderPartial('tables/clientes',array('clientes'=>$clientes,));
            break;
        default:
            break;
    }
    ?>
</div>


<?php

/*

);
?>
<div class="col-xs-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-xs-10">
<?php $this->renderPartial("menuCaja");?>
<?php if(count($tabla)>0 && is_array($tabla)){?>
<table class="table table-hover table-condensed">
<tr>
	<td><strong><?php echo "Nro.";?></strong></td>
	<td><strong><?php echo "Detalle";?></strong></td>
	<td><strong><?php echo "Ingreso";?></strong></td>
	<td><strong><?php echo "N. de Factura";?></strong></td>
	<?php foreach ($caja->cajaChicaTipos as $tipo){?>
	<td><strong><?php echo $tipo->idTipoMovimiento0->nombre;?></strong></td>
	<?php }?>
	<td><strong><?php echo "Observaciones";?></strong></td>
</tr>
<?php
$i=0; 
foreach ($tabla as $item){
$i++;
?>
<tr>
	<td><?php echo $i;?></td>
	<td><?php echo $tabla->detalle;?></td>
	<td><?php echo $tabla->saldo;?></td>
	<td><?php echo $tabla->factura;?></td>
	<?php foreach ($caja->cajaChicaTipos as $tipo){?>
		<?php if($tipo->idTipoMovimiento == $tabla->tipoMovimiento){?>
		<td><?php echo $tabla->monto;?></td>
		<?php }else{?>
		<td><?php echo "0";?></td>
		<?php }?>
	<?php }?>
	<td><?php echo $tabla->obs;?></td>
</tr>
<?php }?>
</table>
<?php }else{?>
<p><?php echo "No Existen datos";?></p>
<?php }?>
</div>
<?php 
$script = "
		function printView()
		{
			window.print();
		
		}";
Yii::app()->clientScript->registerScript("print",$script,CClientScript::POS_HEAD);
?>