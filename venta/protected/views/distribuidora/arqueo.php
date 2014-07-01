<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
<?php $this->renderPartial('arqueo/menuArqueo');?>
<?php $arqueo->fechaVentas=$fecha;?>
	<div class="panel panel-default hidden-print">
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
		<div class="form-group col-sm-6" >
			<?php echo CHtml::label('Monto en Caja','saldo',array('class'=>'control-label col-sm-5')); ?>
			<div class="col-sm-4">
				<?php echo CHtml::activeTextField($caja,'saldo',array('class'=>'form-control ','readonly'=>true)); ?>
			</div>
			<?php echo CHtml::error($caja,'saldo',array('class'=>'label label-danger')); ?>
			
		</div>
		<div class="form-group col-sm-6" >
			<?php echo CHtml::label('Monto a Entregar','monto',array('class'=>'control-label col-sm-5')); ?>
			<div class="col-sm-4">
				<?php echo CHtml::activeTextField($arqueo,'monto',array('class'=>'form-control')); ?>
				<?php echo CHtml::activeHiddenField($arqueo,'fechaVentas',array('class'=>'form-control')); ?>
			</div>
			<?php echo CHtml::error($arqueo,'monto',array('class'=>'label label-danger')); ?>
		
		</div>
		<?php echo CHtml::submitButton('Continuar',array('class'=>'btn btn-default col-sm-offset-1')); ?>
		<?php $this->endWidget(); ?>	
		</div>
	</div>
	
	<?php
	$comprobante='';
	$detalle='';
	$arqueo='';
	$this->renderPartial('arqueo/registroDiario',
						array(	'fecha'=>$fecha,
								'saldo'=>($caja->saldo-($ventas+$recibos)),
								'ventas'=>$ventas,
								'recibos'=>$recibos,
								'comprobante'=>$comprobante,
								'detalle'=>$detalle,
								'arqueo'=>$arqueo,
	));
	?>
</div>