<div class="col-sm-2 hidden-print">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10" >

<div class="col-sm-offset-3 col-sm-7">
<?php echo CHtml::link('Imprimir', '#', array("class"=>"btn btn-default hidden-print","onClick"=>"printView()")); ?>
</div>
<div class="form-group" style="width:793px; height:529px;">

	<h3 class="col-xs-offset-2 col-xs-7 text-center"><strong><?php echo "Orden de Trabajo";?></strong></h3>
	
	<h4 class="col-xs-offset-2 text-right"><strong><?php echo $ctp->codigo; ?></strong></h4>
	<h4 class="col-xs-offset-8 text-right"><strong><?php echo "FECHA:";?></strong> <?php echo date("d-m-Y",strtotime($ctp->fechaOrden));?></h4>
	<small class="col-xs-offset-3 col-xs-5 text-center"><?php echo $tipo?></small>
	<div class="col-xs-4 well well-sm">Fecha de Entrega:</div>
	<div class="row">
	<span class="col-xs-3"><strong><?php echo "CLIENTE:";?></strong> <?php echo $ctp->idCliente0->apellido;?></span>
	<span class="col-xs-2"><strong><?php echo "NIT:";?></strong> <?php echo $ctp->idCliente0->nitCi;?></span>
	<span class="col-xs-4"><strong><?php echo "RESPONSABLE:";?></strong> <?php echo $ctp->responsable;?></span>
	<span class="col-xs-3"><strong><?php echo "TELEFONO:";?></strong> <?php echo $ctp->idCliente0->telefono;;?></span>
	</div>
	
	<div class="row well well-sm" style="min-height:220px;">
	  <table class="table table-hover table-condensed">
		<thead>
		<tr>
			<th><?php echo "Nº"; ?></th>
			<th><?php echo "Nº Placas"; ?></th>
			<th><?php echo "Colores"; ?></th>
			<th><?php echo "Formato"; ?></th>
			<th><?php echo "Trabajo"; ?></th>
			<th><?php echo "Pinza"; ?></th>
			<th><?php echo "Resol."; ?></th>
			<th><?php echo "Adicional"; ?></th>
			<th><?php echo "Total"; ?></th>
		</tr>
		</thead>
		
		<tbody>
			<?php $i=0; foreach ($ctp->detalleCTPs as $producto){ $i++;?>
			<tr>
				<td>
					<?php echo $i;?>
				</td>
				<td>
					<?php echo $producto->nroPlacas; ?>
				</td>
				<td>
					<?php echo (($producto->C)?"<strong>C </strong>":"").(($producto->M)?"<strong>M </strong>":"").(($producto->Y)?"<strong>Y </strong>":"").(($producto->K)?"<strong>B </strong>":"");?>
				</td>
				<td>
					<?php echo $producto->formato;?>
				</td>
				<td>
					<?php echo $producto->trabajo;?>
				</td>
				<td>
					<?php echo $producto->pinza;?>
				</td>
				<td>
					<?php echo $producto->resolucion;?>
				</td>
				<td>
					<?php echo $producto->costoAdicional;?>
				</td>
				<td>
					<?php echo $producto->costoTotal;?>
				</td>
			</tr>
			<?php }?>
		</tbody>
	
	</table>
	  
	<!--   </div> -->
	</div>
	
	<div class="row">
	<span class="col-xs-7"><strong>Recepcionado Por:</strong> <?php echo $ctp->idUserOT0->idEmpleado0->nombre." ".$ctp->idUserOT0->idEmpleado0->apellido;?></span>
	<span class="col-xs-5"><strong>Son:</strong> <?php $this->widget('ext.numerosALetras', array('valor'=>$ctp->montoVenta,'despues'=>''))?></span>
	</div>
	
	<div class="row">
		<div class="col-xs-7">
			<div class="col-xs-5 well well-sm">
				<br><br>
				<p class="text-center"><?php echo "firma Cliente";?></p>
				<span><?php echo "Nombre: "?></span>
				<p class="text-center"><small><?php echo "Autorizo su elavoración de la presente orden";?></small></p>
			</div>
			<div class="col-xs-offset-1 col-xs-5 well">
				<br><br>
				<p class="text-center"><?php echo "firma";?></p>
				<span><?php echo "Nombre: "?><?php echo $ctp->idUserVenta0->idEmpleado0->nombre." ".$ctp->idUserVenta0->idEmpleado0->apellido;?></span>
				<p class="text-center"><small><?php echo "Recibi conforme";?></small></p>
			</div>
		</div>
		<div class="col-xs-5">
			<span class="col-xs-offset-6 col-xs-6"><strong>Total:</strong> <?php echo $ctp->montoVenta." Bs.";?></span>
			<span class="col-xs-6"><strong>Desc:</strong> <?php echo $ctp->montoDescuento." Bs.";?></span>
			<span class="col-xs-6"><strong>A/C:</strong> <?php echo $ctp->montoPagado." Bs.";?></span>
			<span class="col-xs-offset-6 col-xs-6"><strong>Saldo:</strong> <?php echo ((($ctp->montoVenta-$ctp->montoPagado)>0)?($ctp->montoVenta-$ctp->montoPagado):"0")." Bs.";?></span>
			<span class="col-xs-12"><strong>Aut. por:</strong> <?php echo ($ctp->formaPago==1)?CHtml::encode(($ctp->autorizado==0)?'Erick Paredes':'Miriam Martinez'):""?></span>
			<span class="col-xs-12"><strong>obs:</strong></span>
		</div>
		
	</div>
	
</div>
</div>

<?php 

$script = "
		function printView()
		{
			window.print();
		}";

Yii::app()->clientScript->registerScript("print",$script,CClientScript::POS_HEAD); 
//*/?>
