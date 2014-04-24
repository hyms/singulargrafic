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
		<span class="panel-title"><strong>Recibo Egreso</strong> <?php echo $recibo->codigo;?></span>
		<span style="float:right;"><strong>Fecha:</strong> <?php echo date("d-m-Y", strtotime($recibo->fecha));?></span>
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
			<div class="col-md-4">
			<?php echo CHtml::label('GRAFICA SINGULAR','name',array('class'=>'control-label col-sm-offset-5')); ?>
			</div>
			<div class="col-md-6">
				<?php echo CHtml::activeLabelEx($recibo,'responsable',array('class'=>'control-label col-sm-4')); ?>
				<div class="col-sm-8">
					<?php echo CHtml::activeTextField($recibo,'responsable',array('class'=>'form-control',"readonly"=>true)); ?>
				</div>
				<?php echo CHtml::error($recibo,'responsable',array('class'=>'label label-danger')); ?>
			</div>
		</div>
		<?php 
			$this->renderPartial('form',array(
											'recibo'=>$recibo,
											)); 
		?>
	<?php $this->endWidget(); ?>	
	</div>
</div>
</div>
