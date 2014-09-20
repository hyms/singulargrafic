<div class="hidden-print">
	<?php echo CHtml::link('<span class="glyphicon glyphicon-print"></span>', '#', array("class"=>"btn btn-default","id"=>"print")); ?>
</div>
	
<div class="form-group" style="width:793px; height:529px;">
	<h3 class="text-right">COMPROBANTE DE ENTREGA <?php echo $arqueo->comprobante;?></h3>
	<div class="text-right"><strong><?php echo date("d/m/Y",strtotime($arqueo->fechaVentas));?></strong></div>
	<span class="col-xs-12"><strong>Recivo de:</strong><?php echo " ".$arqueo->idUser0->idEmpleado0->nombre." ".$arqueo->idUser0->idEmpleado0->apellido;?></span>
	<span class="col-xs-5"><strong>La suma de:</strong><?php echo " ".$arqueo->monto;?> Bs.</span>
	<span class="col-xs-7"><strong>Por concepto:</strong><?php echo " ".$arqueo->cajaMovimientoVenta->motivo;?></span>
	<span class="col-xs-5"><strong>Cancelado a:</strong><?php echo " ADMINISTRACION"?></span>
	<div class="col-xs-12">
		<div class="col-xs-offset-1 col-xs-4 well">
			<br><br>
			<p class="text-center"><strong><?php echo "firma";?></strong></p>
			<p class="text-justify"><strong><?php echo "Nombre y AP: ";?></strong><?php echo $arqueo->idUser0->idEmpleado0->nombre." ".$arqueo->idUser0->idEmpleado0->apellido;?></p>
			<p class="text-justify"><strong><?php echo "CI: ";?></strong><?php echo $arqueo->idUser0->idEmpleado0->ci;?></p>
			<p class="text-center"><strong><?php echo "Entregue conforme";?></strong></p>
		</div>
		<div class="col-xs-offset-1 col-xs-4 well">
			<br><br>
			<p class="text-center"><strong><?php echo "firma";?></strong></p>
			<p class="text-justify"><strong><?php echo "Nombre y AP:";?></strong></p>
			<p class="text-justify"><strong><?php echo "CI:";?></strong></p>
			<p class="text-center"><strong><?php echo "Recibi conforme";?></strong></p>
		</div>
	</div>
</div>