<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'venta-producto-form',
		'htmlOptions'=>array(
				//'class'=>'form-inline',
				'role'=>'form'
		),
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// See class documentation of CActiveForm for details on this,
		// you need to use the performAjaxValidation()-method described there.
		'enableAjaxValidation'=>false,
));
?>

	<div class="form-group col-md-3">
		<?php echo $form->labelEx($cliente,'nitCi',array('class'=>'control-label')); ?>
		<div >
			<?php echo $form->textField($cliente,'nitCi',array('class'=>'form-control',"id"=>"NitCi")); ?>
		</div>
		<?php echo $form->error($cliente,'nitCi'); ?>
	</div>
	<div class="form-group col-md-3">
		<?php echo $form->labelEx($cliente,'apellido',array('class'=>'control-label')); ?>
		<div >
			<?php echo $form->textField($cliente,'apellido',array('class'=>'form-control',"id"=>"apellido")); ?>
		</div>
		<?php echo $form->error($cliente,'apellido'); ?>
	</div>
	<div class="form-group col-md-3">
		<?php echo $form->labelEx($empleado,'nombres',array('class'=>'control-label')); ?>
		<div >
			<?php echo $form->textField($empleado,'nombres',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($empleado,'nombres'); ?>
	</div>
	<div class="form-group col-md-3">
		<?php echo $form->labelEx($ventaTmp,'fechaModifcacion',array('class'=>'control-label')); ?>
		<div>
			<?php echo $form->hiddenField($ventaTmp,'fechaModifcacion'); ?>
			<p class=" form-control "><?php echo date("d/m/Y");?></p>
		</div>
		<?php echo $form->error($ventaTmp,'fechaModifcacion'); ?>
	</div>
<!-- 
<div class="form-group">
	<?php echo CHtml::Button('Añadir',array('class'=>'btn btn-default')); ?>
</div>
	 -->
<?php $this->endWidget(); ?>
<?php $url_action = CHtml::normalizeUrl(array('/distribuidora/ajaxCliente')); ?>
<?php Yii::app()->getClientScript()->registerScript("ajax_cliente",
"
   
	function cliente (nitCi)
	{
		nitCi = jQuery.trim(nitCi);
        $.ajax({
            url: '$url_action', 
            type: 'GET', 
            data: { nitCi: nitCi},
            success: function (data){ 
            			$('#apellido').val(data['apellido']); 
            			$('#clienteNit').val(data['nitCi']);
					 },
			error:	$('#clienteNit').val(nitCi),
        });
	}
		
    $('#NitCi').keydown(function(e){ 
        if(e.keyCode==13 || e.keyCode==9) 
	    { 
	    	if($('#NitCi').val()!=\"\")
	     		cliente($('#NitCi').val())
	      	return true; 
	    } 
           
    });
    
    $('#NitCi').blur(function(e){ 
        if($('#NitCi').val()!=\"\")
	     	cliente($('#NitCi').val())
    });
    
    $('#apellido').keydown(function(e){ 
        if(e.keyCode==13 || e.keyCode==9) 
	    { 
	    	$('#clienteApellido').val($('#apellido').val());
	      	return true; 
	    } 
           
    });
    
    $('#apellido').blur(function(e){ 
        $('#clienteApellido').val($('#apellido').val());
	      	return true;
    });
    
",CClientScript::POS_READY); ?>
</div><!-- form -->