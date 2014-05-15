<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
	<h3>Stock</h3>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Lista de Productos</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial('producto',array('productos'=>$productos))?>
	  	</div>
	</div>
	<div class = "row">
		<h3 class="col-sm-3">Notas de Venta</h3> 
		<h3 class="col-sm-2"><?php echo $venta->codigo;?></h3> 
		<h3 class="col-sm-3"><?php echo date("d/m/Y",strtotime($venta->fechaVenta));?></h3>
		<div class="col-sm-4">
			<?php echo CHtml::link("Nuevo",array("/distribuidora/notas"),array("class"=>"btn btn-default "))?>
			<?php echo CHtml::link("Buscar","#",array("class"=>"btn btn-default"))?>
			<?php echo CHtml::link("Modificar","#",array("class"=>"btn btn-default"))?>
		</div>
	</div>
	<?php
		$form=$this->beginWidget('CActiveForm', array(
				'id'=>'detalle-venta-detalleVenta-form',
				'action'=>CHtml::normalizeUrl(array('/distribuidora/index')),
				'htmlOptions'=>array(
						'class'=>'form-horizontal',
						'role'=>'form'
				),
		));
	?>
	
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Datos Cliente</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial('cliente',array('cliente'=>$cliente))?>
	  	</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Datos Compra</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial('detalleVenta',array('detalle'=>$detalle,'venta'=>$venta))?>
	  	</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Condiciones de Venta</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial("condicionesVenta",array('venta'=>$venta));?>
	  	</div>
	</div>
	<?php $this->endWidget(); ?>	
</div>