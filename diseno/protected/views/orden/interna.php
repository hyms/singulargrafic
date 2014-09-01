<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">

<div class="panel panel-default">
	<div class="panel-heading">
		<strong class="panel-title">Placas</strong>
	</div>
	<div class="panel-body" style="overflow: auto;">
	<?php $this->renderPartial('producto',array('productos'=>$productos,'index'=>'interna'));?>
 	</div>
</div>

	<div class = "row">
		<h3 class="col-sm-5 text-left"><?php echo "Ordenes de trabajo Internas";?></h3>
		<h3 class="col-sm-3 text-center"><?php //echo $ctp->codigo;?></h3> 
		<h3 class="col-sm-4 text-right"><?php echo date("d/m/Y",strtotime($ctp->fechaOrden));?></h3>
		
	</div>
	
<?php
		$form=$this->beginWidget('CActiveForm', array(
				'id'=>'detalle-venta-detalleVenta-form',
				//'action'=>CHtml::normalizeUrl(array('/orden/interna')),
				'htmlOptions'=>array(
						'class'=>'form-horizontal',
						'role'=>'form'
				),
		));
	
		echo ((!empty($ctp->idCtp))?CHtml::activeHiddenField($ctp,'idCtp'):'');
	?>

	
<div class="panel panel-default">
	<div class="panel-heading">
		<strong class="panel-title">Datos de Orden</strong>
	</div>
	<div class="panel-body" style="overflow: auto;">
	<?php $this->renderPartial('ointerna/interna',array('cliente'=>$cliente,'ctp'=>$ctp));?>
 	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<strong class="panel-title">Detalle de Orden</strong>
	</div>
	<div class="panel-body" style="overflow: auto;">
	<?php $this->renderPartial('ointerna/detalleOrden',array('detalle'=>$detalle,'ctp'=>$ctp));?>
 	</div>
</div>

	<div class="form-group">
		<div class="text-center">
		<?php echo CHtml::resetButton('Cancelar', array('class' => 'btn btn-default hidden-print')); ?>
		<?php echo CHtml::button('Guardar', array('class' => 'btn btn-default hidden-print','id'=>'save')); ?>
		</div>
	</div>
<?php $this->endWidget(); ?>	
	
</div>
<?php Yii::app()->getClientScript()->registerScript("ajax_send",
"
 $('#save').click(function(){
		//alert('se guardaran los datos');
		$('form').submit();
});
",CClientScript::POS_READY); ?>