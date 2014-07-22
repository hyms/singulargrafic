<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
<h3><?php echo "Reposiciones";?></h3>

	<div class = "row">
		<h3 class="col-sm-4">Orden de Trabajo</h3> 
		<h3 class="col-sm-4 text-center"><?php //echo $ctp->codigo;?></h3> 
		<h3 class="col-sm-4 text-right"><?php echo date("d/m/Y",strtotime($ctp->fechaOrden));?></h3>
		
	</div>
	
<?php
		$form=$this->beginWidget('CActiveForm', array(
				'id'=>'detalle-venta-detalleVenta-form',
				'action'=>CHtml::normalizeUrl(array((empty($ctp->idCtp))?'/orden/cliente':"/ctp/modificar")),
				'htmlOptions'=>array(
						'class'=>'form-horizontal',
						'role'=>'form'
				),
		));
	
		echo ((!empty($ctp->idCtp))?CHtml::activeHiddenField($ctp,'idCtp'):'');
	?>

<div class="panel panel-default">
	<div class="panel-heading">
		<strong class="panel-title">Detalle de Orden</strong>
	</div>
	<div class="panel-body" style="overflow: auto;">
	<?php $this->renderPartial('rep/detalleOrden',array('detalle'=>$ctp->detalleCTPs,'ctp'=>$ctp));?>
 	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<strong class="panel-title">Detalle de Repeticion</strong>
	</div>
	<div class="panel-body" style="overflow: auto;">
	<?php $this->renderPartial('rep/detalleRepos',array('detalle'=>array(),'ctp'=>$repos));?>
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