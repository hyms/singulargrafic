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
		<span class="panel-title"><strong>Registro Ingreso</strong></span>
		<span style="float:right;"><strong>Fecha:</strong> <?php echo date("d-m-Y", strtotime($model->fecha));?></span>
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
	<?php 
			$this->renderPartial('form',array(
											'model'=>$model,
											)); 
		?>
	<?php $this->endWidget(); ?>	
	</div>
</div>
</div>
