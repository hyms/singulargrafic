
	<h3>Nuevo Envio</h3>
	<div class="panel-group" id="accordion">
		<div class="panel panel-default" >
			<div class="panel-heading">
				<strong class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Lista de Productos</a></strong>
			</div>
			<div id="collapseOne" class="panel-collapse collapse in">
		  	<div class="panel-body" style="overflow: auto;">
		  	<?php $this->renderPartial('envios/producto',array('productos'=>$productos))?>
		  	</div>
		  	</div>
		</div>
		
	<div class = "row">
		<h3 class="col-xs-4">Datos de Envio</h3>
		<h3 class="col-xs-4 text-center"><?php // echo $venta->codigo;?></h3>
		<h3 class="col-xs-4 text-right"><?php //echo date("d/m/Y",strtotime($venta->fechaVenta));?></h3>
		
	</div>
	<?php ?>
	<?php
		$form=$this->beginWidget('CActiveForm', array(
				'id'=>'detalle-envio-detalleEnvio-form',
				//'action'=>CHtml::normalizeUrl(array((empty($venta->idVenta))?'/distribuidora/notas':"/distribuidora/modificar")),
				'htmlOptions'=>array(
						'class'=>'form-horizontal',
						'role'=>'form'
				),
		));
		
	?>
	<div class="form-group">
	<div class="col-xs-4">
        <?php echo $form->labelEx($model,'origen',array('class'=>'col-xs-4 control-label')); ?>
        <div class="col-xs-8">
        <?php echo $form->textField($model,'origen',array('class'=>'form-control')); ?>
        </div>
        <?php echo $form->error($model,'origen',array('class'=>'label label-danger')); ?>
    </div>
	
    <div class="col-xs-4">
        <?php echo $form->labelEx($model,'destino',array('class'=>'col-xs-4 control-label')); ?>
        <div class="col-xs-8">
        <?php echo $form->textField($model,'destino',array('class'=>'form-control')); ?>
        </div>
        <?php echo $form->error($model,'destino',array('class'=>'label label-danger')); ?>
    </div>
    
	<div class="col-xs-4">
        <?php echo $form->labelEx($model,'responsable',array('class'=>'col-xs-4 control-label')); ?>
        <div class="col-xs-8">
        <?php echo $form->textField($model,'responsable',array('class'=>'form-control')); ?>
        </div>
        <?php echo $form->error($model,'responsable',array('class'=>'label label-danger')); ?>
    </div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="panel-title">Detalle de Envio</strong>
		</div>
		<div class="panel-body" style="overflow: auto;">
	  	<?php $this->renderPartial('envios/detalleEnvio',array('envio'=>$model,'detalle'=>$detalle))?>
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