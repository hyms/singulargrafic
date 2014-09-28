<?php
/* @var $this DistribuidoraController */

$this->breadcrumbs=array(
	'Recibos',
);
?>
<div class="col-xs-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-xs-10">
<?php $this->renderPartial("menuCaja");?>

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="panel-title"><strong>Arqueo</strong></span>
		
	</div>
  	<div class="panel-body" style="overflow: auto;">
  	<?php
		$form=$this->beginWidget('CActiveForm', array(
				'id'=>'detalle-venta-detalleVenta-form',
				//'action'=>CHtml::normalizeUrl(array('/distribuidora/index')),
				'htmlOptions'=>array(
						'class'=>'form-horizontal',
						'role'=>'form'
				),
		));
	?>
	<div class="form-group col-xs-6" >
		<?php echo CHtml::label('Monto en Caja','saldo',array('class'=>'control-label col-xs-5')); ?>
		<div class="col-xs-4">
			<?php echo CHtml::activeTextField($caja,'saldo',array('class'=>'form-control ',"id"=>"concepto",'readonly'=>true)); ?>
		</div>
		<?php echo CHtml::error($caja,'saldo',array('class'=>'label label-danger')); ?>
		
	</div>
	<div class="form-group col-xs-6" >
		<?php echo CHtml::label('Monto a Entregar','monto',array('class'=>'control-label col-xs-5')); ?>
		<div class="col-xs-4">
			<?php echo CHtml::activeTextField($movimiento,'monto',array('class'=>'form-control ',"id"=>"concepto")); ?>
		</div>
		<?php echo CHtml::error($movimiento,'monto',array('class'=>'label label-danger')); ?>
	
	</div>
	<?php echo CHtml::submitButton('Continuar',array('class'=>'btn btn-default col-xs-offset-1')); ?>
	<?php $this->endWidget(); ?>	
	</div>
</div>
</div>
