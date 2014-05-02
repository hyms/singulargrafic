<div class="form-group" style="width:793px; height:529px;">
<?php if(!empty($caja)){?>
<?php echo CHtml::link('Comprobante', array('index','ce'=>$caja->id), array("class"=>"btn btn-default hidden-print")); ?>
<?php 

	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$importe=0;
	foreach($tabla as $item)
	{
		if($item->estado==0)
		{
			$importe=$importe+($item->montoPagado-$item->montoCambio);
		}
		else
		{	
			if($item->estado==2)
			{
				$importe=$importe+$item->montoPagado;
			}	
		}
	}

?>
<p class="text-center"><strong><?php echo "REGISTRO DIARIO" ?></strong></p>
<?php if(!empty($tabla)){ ?>
	<p class="text-right"><?php echo "La Paz, ".$dias[date('w',strtotime($tabla[0]->fechaVenta))]." ".date('d',strtotime($tabla[0]->fechaVenta))." de ".$meses[date('n',strtotime($tabla[0]->fechaVenta))-1]. " del ".date('Y',strtotime($tabla[0]->fechaVenta));?></p>				
<?php	} ?>


<table class="table table-bordered table-condensed">
	<thead>
	<tr>
		<th>Nº</th>
		<th>Comprobante</th>
		<th>Detalle</th>
		<th>Ingreso</th>
		<th>Egreso</th>
		<th>Saldo</th>
	</tr>
	</thead>
	<tbody>
	<?php $index=0; $saldo=0;?>
	<tr>
		<td><?php $index++; echo $index;?></td>
		<td><?php ?></td>
		<td><?php echo "Saldo del dia Anterior"; ?></td>
		<td><?php echo $caja->saldo; ?></td>
		<td><?php echo 0; ?></td>
		<td><?php $saldo=$saldo+$caja->saldo; echo $saldo; ?></td>
	</tr>
	<tr>
		<td><?php $index++; echo $index;?></td>
		<td><?php ?></td>
		<td><?php echo "Total ventas del dia"; ?></td>
		<td><?php echo $importe; ?></td>
		<td><?php echo 0; ?></td>
		<td><?php $saldo=$saldo+$importe; echo $saldo; ?></td>
	</tr>
	<?php
		foreach ($caja->Movimiento as $item)
		{ 
	?>
		<tr>
			<td><?php $index++; echo $index;?></td>
			<td><?php ?></td>
			<td><?php echo "Saldo del dia Anterior"; ?></td>
			<?php if($item->tipo==1) {?>
			<td><?php echo $item->monto; ?></td>
			<td><?php echo 0; ?></td>
			<?php }else{?>
			<td><?php echo 0; ?></td>
			<td><?php echo $item->monto; ?></td>
			<?php }?>
			<td>
			<?php
				if($item->tipo==1)
				{$saldo=$saldo+$item->monto; echo $saldo;}
				else 
				{$saldo=$saldo-$item->monto; echo $saldo;}
			?>
			</td>
		</tr>
	<?php
		} 
		foreach ($caja->Recibo as $item)
		{
			?>
				<tr>
					<td><?php $index++; echo $index;?></td>
					<td><?php ?></td>
					<td><?php echo "Saldo del dia Anterior"; ?></td>
					<?php if($item->tipo==1) {?>
					<td><?php echo $item->monto; ?></td>
					<td><?php echo 0; ?></td>
					<?php }else{?>
					<td><?php echo 0; ?></td>
					<td><?php echo $item->monto; ?></td>
					<?php }?>
					<td>
					<?php
						if($item->tipo==1)
						{$saldo=$saldo+$item->monto; echo $saldo;}
						else 
						{$saldo=$saldo-$item->monto; echo $saldo;}
					?>
					</td>
				</tr>
			<?php
			} 
	?>
	<tr>
		<td colspan="5" class="text-right"><strong>Total Saldo</strong></td>
		<td><strong><?php echo $saldo; ?></strong></td>
	</tr>
	
	</tbody>
</table>
<?php }?>
</div>