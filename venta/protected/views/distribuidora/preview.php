<div class="col-md-2 hidden-print">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-md-10" id="print">

<div class="col-sm-offset-3 col-sm-7">
<?php echo CHtml::link('Imprimir', '#', array("class"=>"btn btn-default hidden-print","onClick"=>"printView(".$venta->id.")")); ?>
<?php
	if($venta->estado==1)
	{
		echo CHtml::link('Confirmar', '#', array("class"=>"btn btn-default hidden-print","onClick"=>"confirmar(".$venta->id.")"));
		echo CHtml::link('Cancelar', '#', array("class"=>"btn btn-default hidden-print","onClick"=>"cancelar(".$venta->id.")"));
	} 
?>
</div>
<div id="print-recived" class="form-group" style="width:793px; height:529px;">

	<h4 class="col-xs-offset-10" style="text-align:right"><?php echo $venta->codigo; ?></h4>
	<h3 class="col-xs-offset-8" style="text-align:right"><?php echo "NOTA DE VENTA";?></h3>
	<p class="row">
	<span class="col-xs-3" > <strong><?php echo "CLIENTE:";?></strong> <?php echo $venta->Cliente->apellido;?></span>
	<span class="col-xs-2"> <strong><?php echo "NIT:";?></strong> <?php echo $venta->Cliente->nitCi;?></span>
	<span class="col-xs-4"> <strong><?php echo "RESPONSABLE";?></strong> <?php echo $venta->Empleado->apellidos." ".$venta->Empleado->nombres;?></span>
	<span class="col-xs-3"> <strong><?php echo "FECHA:";?></strong> <?php echo date("d-m-Y",strtotime($venta->fechaVenta));?></span>
	</p>
	
	<table class="table table-bordered table-condensed ">
		<thead>
		<tr>
			<th>
				Nº
			</th>
			<th>
				<?php echo "Codigo"; ?>
			</th>
			<th>
				<?php echo "Detalle de producto"; ?>
			</th>
			<th>
				<?php echo "Cant. Unidad"; ?>
			</th>
			<th>
				<?php echo "Cant. Paquete"; ?>
			</th>
			<th>
				<?php echo "Adicional"; ?>
			</th>
			<th>
				<?php echo "Total"; ?>
			</th>
		</tr>
		</thead>
		
		<tbody>
			<?php $i=0; foreach ($venta->Detalle as $producto){ $i++;?>
			<tr>
				<td>
					<?php echo $i;?>
				</td>
				<td>
					<?php echo $producto->Almacen->Producto->codigo; ?>
				</td>
				<td>
					<?php echo $producto->Almacen->Producto->Material->nombre." ".$producto->Almacen->Producto->Color->nombre." ".$producto->Almacen->Producto->peso." ".$producto->Almacen->Producto->dimension." ".$producto->Almacen->Producto->procedencia;?>
				</td>
				<td>
					<?php echo $producto->cantUnidad;?>
				</td>
				<td>
					<?php echo $producto->cantPaquete;?>
				</td>
				<td>
					<?php echo $producto->adicional;?>
				</td>
				<td>
					<?php echo $producto->costoTotal;?>
				</td>
			</tr>
			<?php }?>
		</tbody>
	
	</table>
	<p class="row">
	<span class="col-xs-8"><strong>Son:</strong> <?php $this->widget('ext.numerosALetras', array('valor'=>$venta->montoTotal,'despues'=>''))?></span>
	<span class="col-xs-offset-1 col-xs-3"><strong>Total:</strong> <?php echo $venta->montoTotal." Bs.";?></span>
	</p>
	<p class="row">
	<span class="col-xs-4"><strong>Forma de pago:</strong> <?php echo ($venta->formaPago==0)?CHtml::encode("Contado"):CHtml::encode("Credito")?></span>
	<span class="col-xs-4"><strong><?php echo ($venta->formaPago==1)?CHtml::encode("Fecha/Cobro:"):""?></strong> <?php echo ($venta->formaPago==1)?CHtml::encode(date("d/m/Y",strtotime($venta->fechaPlazo))):"" ?></span>
	<span class="col-xs-4"><strong><?php echo ($venta->formaPago==1)?CHtml::encode("Autorizado:"):""?></strong> <?php echo ($venta->formaPago==1)?CHtml::encode($venta->autorizado):""?></span>
	
	</p>
	<p class="row">
	<span class="col-xs-6"><strong>Observaciones: </strong ><?php echo $venta->obs; ?></span>
	<span class="col-xs-3"><strong><?php echo ($venta->formaPago==1)?CHtml::encode("a/c:"):""?></strong> <?php echo ($venta->formaPago==1)?CHtml::encode($venta->montoPagado):""?></span>
	<span class="col-xs-3"><strong><?php echo ($venta->formaPago==1)?CHtml::encode("Saldo:"):""?></strong> <?php echo ($venta->formaPago==1)?CHtml::encode($venta->montoCambio*-1):""?></span>
	</p>
	<p class="row">
	<span class="col-xs-6 "><strong>NOTA:</strong> Una vez redirada la mercancia, no se aceptan <strong>RECLAMOS, CAMBIOS NI DEVOLUCIONES</strong>.</span>
	<span class="col-xs-offset-1 col-xs-4"><strong>Firma:..................................</strong></span>
	<span class="col-xs-offset-1 col-xs-4"><strong>Apellido y Nomb ................</strong></span>
	<span class="col-xs-offset-7 col-xs-4"><strong style="text-align:center">Recibi Conforme</strong></span>
	</p>
	
</div>
</div>
<?php 

$script = "
		function printView(id)
		{
			window.print();
		}";
if($venta->estado==1)
{
	$ventana=($venta->tipoPago==0)?"var fact=prompt(\"Introdusca el numero de factura\",'');":"";
	$dato=($venta->tipoPago==0)?",factura:fact":"";
	$if=($venta->tipoPago==0)?" && fact!=\"\"":"";
	$script=$script."
		function confirmar(id)
		{
			var x;
			".$ventana."
			if (person!=null".$if.")
			{
				$.ajax({
					url: '".CHtml::normalizeUrl(array('/distribuidora/confirm'))."',
					type: 'GET',
					data: { id: id ".$dato."},
					success: function (data){
						$(location).attr('href','".CHtml::normalizeUrl(array('/distribuidora/venta'))."');
					},
				});
			}
		}
		
		function cancelar(id)
		{
			var x;

			var obs=prompt(\"Porque la cancelacion\",'');
			
			if (person!=null && obs!=\"\")
			{
				$.ajax({
					url: '".CHtml::normalizeUrl(array('/distribuidora/cancalar'))."',
					type: 'GET',
					data: { id:id,obs:obs},
					success: function (data){
						$(location).attr('href','".CHtml::normalizeUrl(array('/distribuidora/venta'))."');
					},
				});
			}
		}
		";
}
Yii::app()->clientScript->registerScript("print",$script,CClientScript::POS_HEAD); 
//*/?>