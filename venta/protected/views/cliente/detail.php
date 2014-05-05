<div class="col-sm-2 hidden-print">
<?php $this->renderPartial('menu'); ?>
</div>
<div class="col-sm-10">
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="panel-title"><strong>NitCi: </strong><?php echo $cliente->nitCi?> </span>
		<span class="panel-title"><strong>Cliente: </strong><?php echo $cliente->apellido." ".$cliente->nombre?> </span>
		<span style="float:right;" class="panel-title"><strong>Fecha Registro: </strong><?php echo date("d-m-Y",strtotime($cliente->fechaRegistro));?></span>
	</div>
  	<div class="panel-body" style="overflow: auto;">
		<div>
		<h3>Deudas</h3>
		<table class="table table-bordered table-condensed">
			<thead>
				<tr>
					<th>Detalle producto</th>
					<th>Fecha de Compra</th>
					<th>Fecha de Vencimiento</th>
					<th>Monto</th>	
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($datos["deuda"] as $dato)
				{
				?>
				<tr>
					<td><?php echo $dato["nombre"]?></td>
					<td><?php echo $dato["fechaVenta"]?></td>
					<td><?php echo $dato["fechaPlazo"]?></td>
					<td><?php echo $dato["monto"]?></td>
				</tr>
				<?php
				}
			?>
			</tbody>
		</table>
		</div>
		<h3 >Compras con Factura</h3>
		<div class ="col-xs-12">
			<div class ="col-xs-6">
				<h4 >Contado</h4>
				<table class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th>Detalle producto</th>
							<th>Cantidad</th>	
						</tr>
					</thead>
					<tbody>
					<?php
						foreach ($datos["00"] as $dato)
						{
						?>
						<tr>
							<td><?php echo $dato["nombre"]?></td>
							<td><?php echo $dato["cant"]?></td>
						</tr>
						<?php
						}
					?>
					</tbody>
				</table>
			</div>
			<div class ="col-xs-6">
				<h4 >Credito</h4>
				<table class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th>Detalle producto</th>
							<th>Cantidad</th>	
						</tr>
					</thead>
					<tbody>
					<?php
						foreach ($datos["01"] as $dato)
						{
						?>
						<tr>
							<td><?php echo $dato["nombre"]?></td>
							<td><?php echo $dato["cant"]?></td>
						</tr>
						<?php
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
		<h3 >Compras sin Factura</h3>
		<div class ="col-xs-12">
			<div class ="col-xs-6">
				<h4 >Contado</h4>
				<table class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th>Detalle producto</th>
							<th>Cantidad</th>	
						</tr>
					</thead>
					<tbody>
					<?php
						foreach ($datos["10"] as $dato)
						{
						?>
						<tr>
							<td><?php echo $dato["nombre"]?></td>
							<td><?php echo $dato["cant"]?></td>
						</tr>
						<?php
						}
					?>
					</tbody>
				</table>
			</div>
			<div class ="col-xs-6">
				<h4 >Credito</h4>
				<table class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th>Detalle producto</th>
							<th>Cantidad</th>	
						</tr>
					</thead>
					<tbody>
					<?php
						foreach ($datos["11"] as $dato)
						{
						?>
						<tr>
							<td><?php echo $dato["nombre"]?></td>
							<td><?php echo $dato["cant"]?></td>
						</tr>
						<?php
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>