<div class="col-xs-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-xs-10">

<div class="panel panel-default">
	<div class="panel-heading">
		<strong class="panel-title">Placas</strong>
	</div>
	<div class="panel-body" style="overflow: auto;">
	<?php $this->renderPartial('producto',array('productos'=>$productos,'index'=>'cliente'));?>
 	</div>
</div>

	<div class = "row">
		<h3 class="col-xs-4">Orden de Trabajo</h3>
		<h3 class="col-xs-4 text-center"><?php //echo $ctp->codigo;?></h3>
		<h3 class="col-xs-4 text-right"><?php echo date("d/m/Y",strtotime($ctp->fechaOrden));?></h3>
		
	</div>
	
<?php
		$form=$this->beginWidget('CActiveForm', array(
				'id'=>'detalle-venta-detalleVenta-form',
				//'action'=>CHtml::normalizeUrl(array((empty($ctp->idCtp))?'/orden/cliente':"/ctp/modificar")),
				'htmlOptions'=>array(
						'class'=>'form-horizontal',
						'role'=>'form'
				),
		));
	
		echo ((!empty($ctp->idCtp))?CHtml::activeHiddenField($ctp,'idCtp'):'');
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