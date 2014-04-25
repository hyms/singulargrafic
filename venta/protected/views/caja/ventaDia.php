
<div class="form-group" style="width:793px; height:529px;">
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
	if(!empty($tabla))
	{
		$i=0;
		foreach($tabla as $item)
		{
			foreach ($item->Detalle as $producto)
			{
				$i++;
	?>	
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $item->codigo;?></td>
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
			<td><?php echo $producto->cantUnidad."/".$producto->cantPaquete;?></td>
			<td><?php echo ($producto->cantUnidad*(($item->tipoPago==0)?$producto->Almacen->Producto->costoCFUnidad:$producto->Almacen->Producto->costoSFUnidad)).
						"/".($producto->cantPaquete*(($item->tipoPago==0)?$producto->Almacen->Producto->costoCF:$producto->Almacen->Producto->costoSF));?></td>
			<td><?php echo $producto->adicional;?></td>
			<td><?php echo $producto->costoTotal;?></td>
			<td><?php echo ($item->estado==0)?$producto->costoTotal:0;?></td>
			<td><?php echo ($item->estado==2)?$item->montoPagado:0;?></td>
			<td><?php echo $item->factura;?></td>
		</tr>
	<?php } } }?>
	</tbody>
</table>
</div>