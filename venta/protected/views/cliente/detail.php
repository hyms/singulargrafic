<div class="col-sm-2 hidden-print">
<?php $this->renderPartial('menu'); ?>
</div>
<div class="col-sm-10">
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="panel-title"><strong>Cliente: </strong><?php echo $cliente->apellido." ".$cliente->nombre?></span>
		<span style="float:right;" class="panel-title"><strong>Fecha Registro: </strong><?php echo date("d-m-Y",strtotime($cliente->fechaRegistro));?></span>
	</div>
  	<div class="panel-body" style="overflow: auto;">
		<div>
		<h3>Deudas</h3>
		<table>
			<thead>
				<tr>
					<td>Detalle producto</td>
					<td>Fecha de Compra</td>
					<td>Fecha de Vencimiento</td>
					<td>Monto</td>	
				</tr>
			</thead>
		</table>
		</div>
		<h3>Compras con Factura</h3>
		<div>
			<div class ="col-xs-6">
				<h4 >Contado</h4>
				<table>
					<thead>
						<tr>
							<td>Detalle producto</td>
							<td>Monto</td>
							<td>Cantidad</td>	
						</tr>
					</thead>
				</table>
			</div>
			<div class ="col-xs-6">
				<h4 >Credito</h4>
				<table>
					<thead>
						<tr>
							<td>Detalle producto</td>
							<td>Monto</td>
							<td>Cantidad</td>	
						</tr>
					</thead>
				</table>
			</div>
		</div>
		<h3>Compras sin Factura</h3>
		<div>
			<div class ="col-xs-6">
				<h4 >Contado</h4>
				<table>
					<thead>
						<tr>
							<td>Detalle producto</td>
							<td>Monto</td>
							<td>Cantidad</td>	
						</tr>
					</thead>
				</table>
			</div>
			<div class ="col-xs-6">
				<h4 >Credito</h4>
				<table>
					<thead>
						<tr>
							<td>Detalle producto</td>
							<td>Monto</td>
							<td>Cantidad</td>	
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
</div>