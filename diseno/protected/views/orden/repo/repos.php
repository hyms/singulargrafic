<?php
$listaResp=array("CTP"=>"CTP","Falla de Fabrica"=>"Falla de Fabrica","Proceso"=>"Proceso","Otro"=>"Otro");
$i=0;
if($repos->responsable!="")
{
	foreach ($listaResp as $item)
	{
		if($repos->responsable!=$item)
			$i++;
	} 
	if($i==4)
	{
		$otro=$repos->responsable;
		$repos->responsable = "Otro";
	}
}
?>

<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
<h3><?php echo "Reposiciones";?></h3>

	<div class = "row">
		<h3 class="col-sm-4">Orden de Trabajo</h3> 
		<h3 class="col-sm-4 text-center"><?php //echo $ctp->codigo;?></h3> 
		<h3 class="col-sm-4 text-right"><?php echo date("d/m/Y",strtotime($ctp->fechaOrden));?></h3>
		
	</div>
	
<div class="panel panel-default">
	<div class="panel-heading">
		<strong class="panel-title">Detalle de Orden</strong>
	</div>
	<div class="panel-body" style="overflow: auto;">
	<?php $this->renderPartial('repo/detalleOrden',array('detalle'=>$ctp->detalleCTPs,'ctp'=>$ctp));?>
 	</div>
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


<div class="form-group">
	<div class="col-sm-9">
		<div class="col-sm-2"><div class="text-right">Atribuible:</div></div>
		<div class="col-sm-4"><?php echo CHtml::activeDropDownList($repos,'responsable',$listaResp,array('class'=>'form-control input-sm','id'=>'resp'))?></div>
		<div class="col-sm-2"><div class="text-right"><?php echo "Diseñador:";?></div></div>
		<div class="col-sm-4"><?php echo CHtml::textField('respOtro',$otro,array('class'=>'form-control input-sm','id'=>'respOtro','disabled'=>(($otro=="")?true:false)))?></div>
	</div>
	<div class="col-sm-3"></div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<strong class="panel-title">Detalle de Repeticion</strong>
	</div>
	<div class="panel-body" style="overflow: auto;">
	<?php $this->renderPartial('repo/detalleRepos',array('detalle'=>$detalle,'ctp'=>$repos));?>
		<div class="form-group">
		<?php echo $form->labelEx($repos,'obs',array('class'=>'col-sm-1 control-label')); ?>
		<div class="col-sm-6">
			<?php echo CHtml::activeTextArea($repos,'obs',array('class'=>'form-control input-sm','id'=>'resp'))?>
		</div>
		</div>
 	</div>
</div>

	<div class="form-group">
		<div class="text-center">
		<?php echo CHtml::resetButton('Cancelar', array('class' => 'btn btn-default hidden-print')); ?>
		<?php echo CHtml::submitButton('Guardar', array('class' => 'btn btn-default hidden-print')); ?>
		</div>
	</div>
<?php $this->endWidget(); ?>	
	
</div>

<?php Yii::app()->clientScript->registerScript('otro',"

$('#resp').change(function() {
  	if($('#resp').val()=='Otro')
	{
		$('#respOtro').prop( 'disabled', false );
	}
	else
	{
		$('#respOtro').prop( 'disabled', true );
	}
});

",CClientScript::POS_READY); ?>