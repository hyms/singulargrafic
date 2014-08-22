<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
	<h3>Stock</h3>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Lista de Productos</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial('producto',array('productos'=>$productos))?>
	  	</div>
	</div>
	<div class = "row">
		<h3 class="col-sm-4">Notas de Venta</h3> 
		<h3 class="col-sm-4 text-center"><?php echo $venta->codigo;?></h3> 
		<h3 class="col-sm-4 text-right"><?php echo date("d/m/Y",strtotime($venta->fechaVenta));?></h3>
		
	</div>
	<?php ?>
	<?php
		$form=$this->beginWidget('CActiveForm', array(
				'id'=>'detalle-venta-detalleVenta-form',
				'action'=>CHtml::normalizeUrl(array((empty($venta->idVenta))?'/distribuidora/notas':"/distribuidora/modificar")),
				'htmlOptions'=>array(
						'class'=>'form-horizontal',
						'role'=>'form'
				),
		));
	
		echo ((!empty($venta->idVenta))?CHtml::activeHiddenField($venta,'idVenta'):'');
	?>
	
	
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Datos Cliente</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial('nota/cliente',array('cliente'=>$cliente))?>
	  	</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Datos Compra</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial('nota/detalleVenta',array('detalle'=>$detalle,'venta'=>$venta))?>
	  	</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Condiciones de Venta</strong>
		</div>
	  	<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial("nota/condicionesVenta",array('venta'=>$venta));?>
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