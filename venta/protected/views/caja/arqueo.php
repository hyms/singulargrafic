<?php
/* @var $this DistribuidoraController */

$this->breadcrumbs=array(
	'Recibos',
);
?>
<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
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
	
	<div class="form-group" >
		<?php echo CHtml::label('Monto a Entregar','monto',array('class'=>'control-label col-sm-2')); ?>
		<div class="col-sm-2">
			<?php echo CHtml::activeTextField($movimiento,'monto',array('class'=>'form-control ',"id"=>"concepto")); ?>
		</div>
		<?php echo CHtml::error($movimiento,'monto',array('class'=>'label label-danger')); ?>
		<?php echo CHtml::submitButton('Continuar',array('class'=>'btn btn-default col-sm-offset-1')); ?>

	</div>
	
	<?php $this->endWidget(); ?>	
	</div>
</div>
</div>
