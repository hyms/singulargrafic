<div class = "row">
	<h3 class="col-xs-4">Orden de Trabajo</h3>
	<h3 class="col-xs-4 text-center" id="codigo"><?php echo $ctp->codigo;?></h3>
	<h3 class="col-xs-4 text-right"><?php echo date("d/m/Y",strtotime($ctp->fechaOrden));?></h3>
</div>
	
<?php
	$form=$this->beginWidget('CActiveForm', array(
			'id'=>'form',
			'htmlOptions'=>array(
					'class'=>'form-horizontal',
					'role'=>'form'
			),
	));

	echo CHtml::activeHiddenField($ctp,'idCTP');
?>

<?php if($ctp->tipoCTP !=3){?>
    <div class="panel panel-default">
	    <div class="panel-heading">
			<strong class="panel-title">Datos Cliente</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial('forms/cliente',array('cliente'=>$cliente,'ctp'=>$ctp))?>
	  	</div>
	</div>
<?php }?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Datos de Orden</strong>
		</div>
		<div class="panel-body" style="overflow: auto;">
		<?php $this->renderPartial('forms/detalleOrden',array('detalle'=>$detalle,'ctp'=>$ctp));?>
	 	</div>
	</div>
	<?php if($ctp->tipoCTP ==1){?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Condiciones de Venta</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial("forms/condicionesVenta",array('ctp'=>$ctp));?>
	  	</div>
	</div>
	<?php }?>
	<div class="form-group">
		<div class="text-center">
            <?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
            <?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-default hidden-print','id'=>'save')); ?>
		<?php //echo CHtml::submitButton('Guardar', array('class' => 'btn btn-default hidden-print')); ?>
		</div>
	</div>
	<?php $this->endWidget(); ?>
</div>
