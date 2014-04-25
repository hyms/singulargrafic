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
		<span class="panel-title"><strong>Recibo Ingreso</strong> <?php echo $recibo->codigo;?></span>
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
			<div class="col-sm-4">
				<?php echo CHtml::activeLabelEx($cliente,'nitCi',array('class'=>'control-label col-sm-4')); ?>
				<div class="col-sm-8">
					<?php echo CHtml::activeTextField($cliente,'nitCi',array('class'=>'form-control ',"id"=>"nitCi")); ?>
				</div>
				<?php echo CHtml::error($cliente,'nitCi',array('class'=>'label label-danger')); ?>
			</div>
			<div class="col-sm-5">
				<?php echo CHtml::activeLabelEx($cliente,'apellido',array('class'=>'control-label col-sm-4')); ?>
				<div class="col-sm-8">
					<?php echo CHtml::activeTextField($cliente,'apellido',array('class'=>'form-control',"id"=>"apellido","readonly"=>true)); ?>
				</div>
				<?php echo CHtml::error($cliente,'apellido',array('class'=>'label label-danger')); ?>
			</div>
		</div>
		<div class="form-group" >
			<div class="col-sm-4">
				<?php echo CHtml::activeLabelEx($recibo,'celular',array('class'=>'control-label col-sm-4')); ?>
				<div class="col-sm-8">
					<?php echo CHtml::activeTextField($recibo,'celular',array('class'=>'form-control')); ?>
				</div>
				<?php echo CHtml::error($recibo,'celular',array('class'=>'label label-danger')); ?>
			</div>
			<div class="col-sm-5">
				<?php echo CHtml::activeLabelEx($recibo,'responsable',array('class'=>'control-label col-sm-4')); ?>
				<div class="col-sm-8">
					<?php echo CHtml::activeTextField($recibo,'responsable',array('class'=>'form-control ')); ?>
				</div>
				<?php echo CHtml::error($recibo,'responsable',array('class'=>'label label-danger')); ?>
			</div>
		</div>
		<?php 
			$this->renderPartial('form',array(
											'recibo'=>$recibo,
											'venta'=>$venta,
											)); 
		?>
	<?php $this->endWidget(); ?>	
	</div>
</div>
</div>

<?php Yii::app()->getClientScript()->registerScript("ajax_cliente",
		"
  
	function cliente (nitCi)
	{
		nitCi = jQuery.trim(nitCi);
		if(nitCi.length>0){
	        $.ajax({
	            url: '".CHtml::normalizeUrl(array('/recibos/llenado'))."',
				type: 'GET',
				data: { nitCi: nitCi},
				success: function (data){
					data = JSON.parse(data);
					llenado(data);
					//alert(data);
				},
			});
		}
	}
	
	function llenado(data)
	{
		$('#apellido').val(data['Cliente']['apellido']);
		$('#codigo').val(data['Venta']['codigo']);
		$('#monto').val(data['Credito']['saldo']);
		$('#categoria').val(data['categoria'])
		$('#concepto').val(data['concepto'])
	}
		$('#nitCi').keydown(function(e){
			if(e.keyCode==13 || e.keyCode==9)
			{
				if($('#nitCi').val()!=\"\")
					cliente($('#nitCi').val())
				return true;
			}
		});

		$('#nitCi').blur(function(e){
			if($('#nitCi').val()!=\"\")
				cliente($('#nitCi').val())
		});
",CClientScript::POS_READY);
?>
