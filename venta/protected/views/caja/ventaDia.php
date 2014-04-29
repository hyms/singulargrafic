
<div class="form-group" style="width:793px; height:529px;">
<?php 
if(!empty($tabla))
{
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	
?>
<p class="text-center"><strong><?php echo "REPORTE DE VENTAS DEL DIA"?></strong></p>
<p class="text-right"><?php echo "La Paz, ".$dias[date('w',strtotime($tabla[0]->fechaVenta))]." ".date('d',strtotime($tabla[0]->fechaVenta))." de ".$meses[date('n',strtotime($tabla[0]->fechaVenta))-1]. " del ".date('Y',strtotime($tabla[0]->fechaVenta));?></p>
<table class="table table-bordered table-condensed">
	<thead>
		<th>Nº</th>
		<th>Codigo Venta</th>
		<th>Cliente</th>
		<th>Cod. Prod.</th>
		<th>Detalle del Producto</th>
		<th>Cant.</th>
		<th>Precio</th>
		<th>T/A</th>
		<th>Total</th>
		<th>Importe</th>
		<th>Creditos</th>
		<th>Fact.</th>
	</thead>
	<tbody>
	<?php 
	
		$i=0;
		$total=0;$importe=0;$creditos=0;$adicional=0;
		foreach($tabla as $item)
		{
			$temp=count($item->Detalle);
			foreach ($item->Detalle as $producto)
			{
				$i++;$temp--;
	?>	
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo ($item->tipoPago==0)?$item->codigo:(chr($item->serie)."-".$item->codigo);?></td>
			<td><?php echo $item->Cliente->apellido." ".$item->Cliente->nombre;?></td>
			<td><?php echo $producto->Almacen->Producto->codigo;?></td>
			<td>
				<?php 
					echo $producto->Almacen->Producto->Material->nombre
					." ".$producto->Almacen->Producto->Color->nombre
					." ".$producto->Almacen->Producto->peso
					." ".$producto->Almacen->Producto->dimension
					." ".$producto->Almacen->Producto->procedencia;
				?>
			</td>
			<td><?php echo $producto->cantUnidad."/".$producto->cantPaquete; ?></td>
			<td><?php echo ($producto->cantUnidad*(($item->tipoPago==0)?$producto->Almacen->Producto->costoCFUnidad:$producto->Almacen->Producto->costoSFUnidad)).
						"/".($producto->cantPaquete*(($item->tipoPago==0)?$producto->Almacen->Producto->costoCF:$producto->Almacen->Producto->costoSF)); ?></td>
			<td><?php echo $producto->adicional; $adicional=$adicional+$producto->adicional; ?></td>
			<td><?php echo $producto->costoTotal; $total=$total+$producto->costoTotal; ?></td>
			<td><?php echo ($item->estado==0)?(($temp==0)?($item->montoPagado-$item->montoCambio):0):(($item->estado==2)?(($temp==0)?$item->montoPagado:0):0);
				($item->estado==0)?(($temp==0)?($importe=$importe+($item->montoPagado-$item->montoCambio)):0):(($item->estado==2)?(($temp==0)?($importe=$importe+$item->montoPagado):0):0); ?></td>
			<td><?php echo ($item->estado==2)?(($temp==0)?($item->montoCambio*(-1)):0):0;
				($item->estado==2)?(($temp==0)?($creditos=$creditos+($item->montoCambio*(-1))):0):0; ?></td>
			<td><?php echo $item->factura;?></td>
		</tr>
	<?php }
			
		}
		 
	?>
	<tr>
		<td colspan="5" class="text-right"><strong>Totales</strong></td>
		<td></td>
		<td></td>
		<td><strong><?php echo $adicional; ?></strong></td>
		<td><strong><?php echo $total; ?></strong></td>
		<td><strong><?php echo $importe; ?></strong></td>
		<td><strong><?php echo $creditos; ?></strong></td>
		<td></td>
	</tr>
	</tbody>
</table>
<?php 
}
else{
	echo "No existen registros";
} 
?>

</div>