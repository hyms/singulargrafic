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
	<div class = "row">
		<h3 class="col-xs-4">Recibo Ingreso</h3>
		<h3 class="col-xs-4 text-center"><?php echo $recibo->codigo;?></h3>
		<h3 class="col-xs-4 text-right"><?php echo date("d/m/Y",strtotime($recibo->fechaRegistro));?></h3>
		
	</div>
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
	<div class="panel panel-default">
	<div class="panel-heading">
		<span class="panel-title"><strong>Datos Cliente</strong></span>
	</div>
  	<div class="panel-body" style="overflow: auto;">
  		<div class="form-group" >
			<div class="col-xs-4">
			<?php echo CHtml::label('GRAFICA SINGULAR','name',array('class'=>'control-label col-xs-offset-5')); ?>
			</div>
			<div class="col-xs-6">
				<?php echo CHtml::activeLabelEx($recibo,'responsable',array('class'=>'control-label col-xs-4')); ?>
				<div class="col-xs-8">
					<?php echo CHtml::activeTextField($recibo,'responsable',array('class'=>'form-control')); ?>
				</div>
				<?php echo CHtml::error($recibo,'responsable',array('class'=>'label label-danger')); ?>
			</div>
		</div>
  	</div>
  	</div>
  	
  	<div class="panel panel-default">
	<div class="panel-heading">
		<span class="panel-title"><strong>Datos Recibo</strong></span>
	</div>
  	<div class="panel-body" style="overflow: auto;">
	  	<div class="form-group" >
		<div class="col-xs-8">
			<?php echo CHtml::activeLabelEx($recibo,'concepto',array('class'=>'control-label col-xs-3')); ?>
			<div class="col-xs-9">
				<?php echo CHtml::activeTextArea($recibo,'concepto',array('class'=>'form-control ',"id"=>"concepto")); ?>
			</div>
			<?php echo CHtml::error($recibo,'concepto',array('class'=>'label label-danger')); ?>
		</div>
		</div>
		<div class="form-group" >
		<div class="col-xs-4">
			<?php echo CHtml::activeLabelEx($recibo,'categoria',array('class'=>'control-label col-xs-3')); ?>
			<div class="col-xs-9">
				<?php echo CHtml::activeTextField($recibo,'categoria',array('class'=>'form-control ',"id"=>"categoria")); ?>
			</div>
			<?php echo CHtml::error($recibo,'categoria',array('class'=>'label label-danger')); ?>
		</div>
		<div class="col-xs-4">
			<?php echo CHtml::activeLabelEx($recibo,'codigoNumero',array('class'=>'control-label col-xs-3')); ?>
			<div class="col-xs-9">
				<?php echo CHtml::activeTextField($recibo,'codigoNumero',array('class'=>'form-control ',"id"=>"codigo")); ?>
			</div>
			<?php echo CHtml::error($recibo,'codigoNumero',array('class'=>'label label-danger')); ?>
		</div>
		</div>
		
		<div class="form-group" >
		<div class="col-xs-4">
			<?php echo CHtml::activeLabelEx($recibo,'monto',array('class'=>'control-label col-xs-3')); ?>
			<div class="col-xs-9">
				<?php echo CHtml::activeTextField($recibo,'monto',array('class'=>'form-control ',"id"=>"monto")); ?>
			</div>
			<?php echo CHtml::error($recibo,'monto',array('class'=>'label label-danger')); ?>
		</div>
		<div class="col-xs-4">
			<?php echo CHtml::activeLabelEx($recibo,'acuenta',array('class'=>'control-label col-xs-3')); ?>
			<div class="col-xs-9">
				<?php echo CHtml::activeTextField($recibo,'acuenta',array('class'=>'form-control ',"id"=>"acuenta")); ?>
			</div>
			<?php echo CHtml::error($recibo,'acuenta',array('class'=>'label label-danger')); ?>
		</div>
		<div class="col-xs-4">
			<?php echo CHtml::activeLabelEx($recibo,'saldo',array('class'=>'control-label col-xs-3')); ?>
			<div class="col-xs-9">
				<?php echo CHtml::activeTextField($recibo,'saldo',array('class'=>'form-control ',"id"=>"saldo","readonly"=>true)); ?>
			</div>
			<?php echo CHtml::error($recibo,'saldo',array('class'=>'label label-danger')); ?>
		</div>
		</div>
		<div class="form-group" >
		<div class="col-xs-8">
			<?php echo CHtml::activeLabelEx($recibo,'obs',array('class'=>'control-label col-xs-3')); ?>
			<div class="col-xs-9">
				<?php echo CHtml::activeTextArea($recibo,'obs',array('class'=>'form-control ')); ?>
			</div>
			<?php echo CHtml::error($recibo,'obs',array('class'=>'label label-danger')); ?>
		</div>
		</div>
		
  	</div>
  	</div>
  	<div class="form-group">
  	<div class="text-center">
  		<?php echo CHtml::resetButton('Cancelar', array('class' => 'btn btn-default hidden-print')); ?>
		<?php echo CHtml::submitButton('Continuar',array('class'=>'btn btn-default hidden-print')); ?>
	</div>
  	</div>
	
	<?php $this->endWidget(); ?>	
	

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
