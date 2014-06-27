<div class="form-group" style="width:793px; height:529px;">
<?php if(!empty($caja)){?>
	<?php echo CHtml::link('Imprimir', '#', array("class"=>"btn btn-default hidden-print","onClick"=>"printView()")); ?>
	
<h3 class="row text-right">COMPROBANTE DE ENTREGA <?php echo $caja->idCaja0->comprobante;?></h3>
<span class="row text-right"><?php echo date("d/m/Y",strtotime($caja->fechaMovimiento));?></span>
<span class="row"><strong>Recivo de:</strong><?php echo $caja->idUser0->idEmpleado0->nombre." ".$caja->idUser0->idEmpleado0->apellido;?></span>
<span class="col-xs-6"><strong>La suma de:</strong><?php echo " ".$caja->idCaja0->entregado;?></span>
<span class="col-xs-6"><strong>Cancelado a:</strong><?php echo " ADMINISTRACION"?></span>

<span class="row"><strong>Por concepto:</strong><?php echo " ".$caja->motivo;?></span>
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