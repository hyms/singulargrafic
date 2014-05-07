<div class="form-group" style="width:793px; height:529px;">
<?php if(!empty($caja)){?>
<h3 class="row text-right">COMPROBANTE DE ENTREGA <?php echo $caja->idComprovante;?></h3>
<span class="row text-right"><?php echo date("d/m/Y",strtotime($caja->fecha));?></span>
<span class="row"><strong>Recivo de:</strong><?php echo $caja->Empleado->nombre." ".$caja->Empleado->apellido;?></span>
<span class="col-xs-6"><strong>La suma de:</strong><?php echo " ".$caja->monto;?></span>
<span class="col-xs-6"><strong>Cancelado a:</strong><?php echo " ADMINISTRACION"?></span>

<span class="row"><strong>Por concepto:</strong><?php " ".$caja->obs;?></span>
<div class="row">
	<div class="col-xs-offset-1 col-xs-4 well">
		<br><br>
		<p class="text-center"><?php echo "firma";?></p>
		<p class="text-justify"><?php echo "Nombre y AP:";?></p>
		<p class="text-center"><?php echo "Entregue conforme";?></p>
	</div>
	<div class="col-xs-offset-1 col-xs-4 well">
		<br><br>
		<p class="text-center"><?php echo "firma";?></p>
		<p class="text-justify"><?php echo "Nombre y AP:";?></p>
		<p class="text-center"><?php echo "Recibi conforme";?></p>
	</div>
</div>
<?php }?>
</div>