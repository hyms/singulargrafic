<div class="form-group">
<?php echo "  ".CHtml::link('Añadir Cantidades',array('ctp/cantidad'),array('class' => 'openDlg divDialog')); ?>

<?php $cantidad= end($cantidades); echo "  ".CHtml::link('Eliminar Ultima Cantidad',array('ctp/delCantidad','id'=>$cantidad->idCantidadCTP),array('class' => 'btn btn-default','onClick'=>'confirm("Realmente desea eliminar la ultima cantidad de placas?")')); ?>
<?php ///echo "  ".CHtml::link('Añadir Horario',array('ctp/horario'),array('class' => 'openDlg1 divDialog1')); ?>
</div>
<div class="form" >

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'matriz-precios-ctp-precios-form',
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form'
	),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>
	<div class="form-group">
	<?php $this->renderPartial('precios',array('model'=>$model,'placas'=>$placas,'clienteTipos'=>$tiposClientes,'cantidades'=>$cantidades,'horarios'=>$horarios)); ?>
	</div>
	
	<div class="form-group">
			<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-2')); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
Yii::app()->clientScript->registerScript('row2',"
$('#document').ready(function(){
	$('.openDlg').click(function(){
		var dialogId = $(this).attr('class').replace('openDlg ', '');
		$.ajax({
			'type': 'GET',
			'url' : $(this).attr('href'),
			success: function (data) {
				 
				$('#'+dialogId+' div.divForForm').html(data);
				$( '#'+dialogId ).dialog( 'open' );
			},
			dataType: 'html',
		});
		return false; // prevent normal submit
	})
}); 
",CClientScript::POS_READY);?>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array('id'=>'divDialog',
    'options'=>array( 'title'=>'Datos', 'autoOpen'=>false, 'modal'=>true, 'width'=>800)));
?>
    <div class="divForForm"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>