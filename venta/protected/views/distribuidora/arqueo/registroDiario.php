<?php 
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$fecha=$dias[date('w',strtotime($fecha))]." ".date('d',strtotime($fecha))." de ".$meses[date('n',strtotime($fecha))-1]. " del ".date('Y',strtotime($fecha));
?>
<p class="text-center"><strong><?php echo "REGISTRO DIARIO"?></strong></p>
<p class="text-right"><?php echo "La Paz, ".$fecha;?></p>

<table class="table table-hover table-condensed">
	<thead>
	<tr>
		<th>Comprobante</th>
		<th>Detalle</th>
		<th>Ingreso</th>
		<th>Egreso</th>
		<th>Saldo</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td></td>
		<td><?php echo "Saldo del día anterior";?></td>
		<td><?php echo $saldo;?></td>
		<td></td>
		<td><?php echo $saldo;?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo "Total Ventas del día";?></td>
		<td><?php echo $ventas;?></td>
		<td></td>
		<td><?php echo ($saldo+$ventas);?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo "Recibos del día";?></td>
		<td><?php echo $recibos;?></td>
		<td></td>
		<td><?php echo ($saldo+$ventas+$recibos);?></td>
	</tr>
	<?php if($arqueo!=""){?>
	<tr>
		<td><?php echo $comprobante;?></td>
		<td><?php echo $detalle;?></td>
		<td></td>
		<td><?php echo $arqueo;?></td>
		<td><?php echo ($saldo+$ventas+$recibos-$arqueo);?></td>
	</tr>
	<?php }?>
	<tr>
		<td colspan="4" class="text-right"><strong>Total Saldo</strong></td>
		<td><?php echo ($saldo+$ventas+$recibos-$arqueo);?></td>
	</tr>
	</tbody>
</table>

	<div class="row">
		<div class="col-xs-offset-1 col-xs-4 well">
			<br><br>
			<p class="text-center"><?php echo "firma";?></p>
			<?php $empleado=Users::model()->with('idEmpleado0')->findByPk(Yii::app()->user->id)?>
			<span><?php echo "Nombre: ".$empleado->idEmpleado0->nombre." ".$empleado->idEmpleado0->apellido?></span>
			<p class="text-center"><?php echo "Entregue conforme";?></p>
		</div>
		<div class="col-xs-offset-1 col-xs-4 well">
			<br><br>
			<p class="text-center"><?php echo "firma";?></p>
			<span><?php echo "Nombre: Miriam Martinez";?></span>
			<p class="text-center"><?php echo "Recibi conforme";?></p>
		</div>
	</div>