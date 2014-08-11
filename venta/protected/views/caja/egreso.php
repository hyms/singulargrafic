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
<div class="row">
<div class="text-center">
<?php echo CHtml::link('Egreso', array("caja/chica","t"=>0), array("class"=>"btn btn-default hidden-print")); ?>
<?php echo CHtml::link('Ingreso', array("caja/chica","t"=>1), array("class"=>"btn btn-default hidden-print")); ?>
</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="panel-title"><strong>Registro Egreso</strong></span>
		<span style="float:right;"><strong>Fecha:</strong> <?php echo date("d-m-Y", strtotime($model->fechaMovimiento));?></span>
	</div>
  	<div class="panel-body" style="overflow: auto;">
  	<?php
		$form=$this->beginWidget('CActiveForm', array(
				'id'=>'detalle-venta-detalleVenta-form',
				'action'=>CHtml::normalizeUrl(array('/caja/ingreso')),
				'htmlOptions'=>array(
						'class'=>'form-horizontal',
						'role'=>'form'
				),
		));
	?>
	<?php 
			$this->renderPartial('form',array(
											'model'=>$model,
											)); 
		?>
	<?php $this->endWidget(); ?>	
	</div>
</div>
</div>
