<h3>Stock</h3>
 
<div class="panel-group" id="accordion">
	<div class="panel panel-default" >
		<div class="panel-heading">
			<strong class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Lista de Productos</a></strong>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in">
	  	<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial('tables/producto',array('productos'=>$productos))?>
	  	</div>
	  	</div>
	</div>
	
	<div class = "row">
		<h3 class="col-sm-4">Notas de Venta</h3> 
		<h3 class="col-sm-4 text-center" id="codigo"><?php echo $venta->codigo;?></h3> 
		<h3 class="col-sm-4 text-right"><?php echo date("d/m/Y",strtotime($venta->fechaVenta));?></h3>
		
	</div>
	
	<?php
		$form=$this->beginWidget('CActiveForm', array(
				'id'=>'form',
				'action'=>CHtml::normalizeUrl(array(($venta->isNewRecord)?'/distribuidora/notas':"/distribuidora/modificar")),
				'htmlOptions'=>array(
						'class'=>'form-horizontal',
						'role'=>'form'
				),
		));
	
		echo ((!$venta->isNewRecord)?CHtml::activeHiddenField($venta,'idVenta'):'');
	?>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Datos Cliente</strong>
		</div>
		<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial('forms/cliente',array('cliente'=>$cliente))?>
	  	</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTree">Datos Compra</a></strong>
		</div>
		<div id="collapseTree" class="panel-collapse collapse in">
	  	<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial('forms/detalleVenta',array('detalle'=>$detalle,'venta'=>$venta))?>
	  	</div>
	  	</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Condiciones de Venta</strong>
		</div>
		<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial("forms/condicionesVenta",array('venta'=>$venta));?>
	  	</div>
	</div>
	
	<div class="form-group">
		<div class="text-center">
		<?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
		<?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-default hidden-print','id'=>'save')); ?>
		</div>
	</div>
	
	<?php $this->endWidget(); ?>
</div>	

<?php
	$this->renderPartial("scripts/operaciones");	
	$this->renderPartial("scripts/save");
	$this->renderPartial("scripts/reset");
?>