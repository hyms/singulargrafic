<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">

<div class="panel panel-default">
	<div class="panel-heading">
		<strong class="panel-title">Placas</strong>
	</div>
	<div class="panel-body" style="overflow: auto;">
	<?php $this->renderPartial('producto',array('productos'=>$productos));?>
 	</div>
</div>

	<div class = "row">
		<h3 class="col-sm-4">Orden de Trabajo</h3> 
		<h3 class="col-sm-4 text-center"><?php echo $ctp->codigo;?></h3> 
		<h3 class="col-sm-4 text-right"><?php echo date("d/m/Y",strtotime($ctp->fechaOrden));?></h3>
		
	</div>
	
<?php
		$form=$this->beginWidget('CActiveForm', array(
				'id'=>'detalle-venta-detalleVenta-form',
				'action'=>CHtml::normalizeUrl(array((empty($ctp->idVenta))?'/ctp/orden':"/ctp/modificar")),
				'htmlOptions'=>array(
						'class'=>'form-horizontal',
						'role'=>'form'
				),
		));
	
		echo ((!empty($venta->idVenta))?CHtml::activeHiddenField($ctp,'idCtp'):'');
	?>
	
<div class="panel panel-default">
	<div class="panel-heading">
		<strong class="panel-title">Datos de Cliente</strong>
	</div>
	<div class="panel-body" style="overflow: auto;">
		<?php $this->renderPartial('orden/cliente',array('cliente'=>$cliente,'ctp'=>$ctp));?>
 	</div>
</div>


<div class="panel panel-default">
	<div class="panel-heading">
		<strong class="panel-title">Datos de Orden</strong>
	</div>
	<div class="panel-body" style="overflow: auto;">
	<?php $this->renderPartial('orden/detalleOrden',array('detalle'=>$detalle,'ctp'=>$ctp));?>
 	</div>
</div>

	<div class="form-group">
		<div class="text-center">
		<?php echo CHtml::resetButton('Cancelar', array('class' => 'btn btn-default hidden-print')); ?>
		<?php echo CHtml::submitButton('Guardar', array('class' => 'btn btn-default hidden-print')); ?>
		</div>
	</div>
<?php $this->endWidget(); ?>	
	
</div>