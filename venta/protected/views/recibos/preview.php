<div class="col-sm-2 hidden-print">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
	<div class="col-sm-offset-3 col-sm-7">
		<?php echo CHtml::link('Imprimir', '#', array("class"=>"btn btn-default hidden-print","onClick"=>"printView()")); ?>
	</div>
	
	<div id="print-recived" class="form-group" style="width:793px; height:529px;">
		<h4 class="text-center"><?php echo "<strong>RECIBO DE ".(($recibo->tipo==0)?"EGRESO":"INGRESO")."</strong> Nro. ".$recibo->codigo; ?></h4>
		<h4 class="col-xs-offset-8 text-right"><strong>Fecha: </strong><?php echo date("d-m-Y",strtotime($recibo->fecha));?></h4>
	
		<p class="row">
			<?php if(!empty($recibo->Cliente)){?>
			<span class="col-xs-2"> <strong><?php echo "NIT:";?></strong> <?php echo $recibo->Cliente->nitCi;?></span>
			<span class="col-xs-3" > <strong><?php echo "CLIENTE:";?></strong> <?php echo $recibo->Cliente->apellido;?></span>
			<?php }?>
			<span class="col-xs-4"> <strong><?php echo "RESPONSABLE";?></strong> <?php echo $recibo->Empleado->apellidos." ".$recibo->Empleado->nombres;?></span>
			<?php if($recibo->celular!=""){?><span class="col-xs-3"> <strong><?php echo "CELULAR";?></strong> <?php echo $recibo->celular;?></span><?php }?>
		</p>
		<p class="row">
			<span class="col-xs-12"> <strong><?php echo "Concepto:";?></strong> <?php echo $recibo->concepto;?></span>
		</p>
		<p class="row">
			<span class="col-xs-4"> <strong><?php echo "Categoria:";?></strong> <?php echo $recibo->categoria;?></span>
			<span class="col-xs-4" > <strong><?php echo "Nº:";?></strong> <?php echo $recibo->nro;?></span>
		</p>
		<p class="row">
			<span class="col-xs-offset-1 col-xs-1"> <strong><?php echo "MONTO:";?></strong></span>
			<span class="col-xs-2 text-right"> <strong><?php echo "Bs(Numeral):";?></strong></span>
			<span class="col-xs-2"> <?php echo $recibo->monto;?></span>
			<span class="col-xs-2 text-right"> <strong><?php echo "Bs(Literal):";?></strong></span>
			<span class="col-xs-4"> <?php $this->widget('ext.numerosALetras', array('valor'=>$recibo->monto,'despues'=>''))?></span>
		</p>
		<p class="row">
			<span class="col-xs-offset-1 col-xs-1"> <strong><?php echo "A/C:";?></strong></span>
			<span class="col-xs-2 text-right"> <strong><?php echo "Bs(Numeral):";?></strong></span>
			<span class="col-xs-2"> <?php echo $recibo->acuenta;?></span>
			<span class="col-xs-2 text-right"> <strong><?php echo "Bs(Literal):";?></strong></span>
			<span class="col-xs-4"> <?php $this->widget('ext.numerosALetras', array('valor'=>$recibo->acuenta,'despues'=>''))?></span>		</p>
		<p class="row">
			<span class="col-xs-offset-1 col-xs-1"> <strong><?php echo "SALDO:";?></strong></span>
			<span class="col-xs-2 text-right"> <strong><?php echo "Bs(Numeral):";?></strong></span>
			<span class="col-xs-2"> <?php echo $recibo->saldo;?></span>
			<span class="col-xs-2 text-right"> <strong><?php echo "Bs(Literal):";?></strong></span>
			<span class="col-xs-4"> <?php $this->widget('ext.numerosALetras', array('valor'=>$recibo->saldo,'despues'=>''))?></span>
		</p>
		<div class="row">
			<div class="col-xs-offset-1 col-xs-4 well">
				<br><br>
				<p class="text-center"><?php echo "firma";?></p>
				<span><?php echo "Nombre: ".((empty($recibo->Cliente))?$recibo->responsable:"")?></span>
				<p class="text-center"><?php echo "Entregue conforme";?></p>
			</div>
			<div class="col-xs-offset-1 col-xs-4 well">
				<br><br>
				<p class="text-center"><?php echo "firma";?></p>
				<span><?php echo "Nombre: ".((!empty($recibo->Cliente))?$recibo->Empleado->apellidos." ".$recibo->Empleado->nombres:"")?></span>
				<p class="text-center"><?php echo "Recibi conforme";?></p>
			</div>
		</div>
		<p class="row">
			<span class="col-xs-4"> <strong><?php echo "Obs:";?></strong> <?php echo $recibo->obs;?></span>
		</p>
		
	</div>
</div>
<?php
$script = "
		function printView()
		{
			window.print();
		}";
Yii::app()->clientScript->registerScript("print",$script,CClientScript::POS_HEAD); 
?>