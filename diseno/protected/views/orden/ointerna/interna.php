<div class="form-group col-sm-6">
	<?php echo CHtml::activeLabelEx($ctp,'responsable',array('class'=>'control-label col-sm-4')); ?>
	<div class="col-sm-8">
		<?php echo CHtml::activeTextField($ctp,'responsable',array('class'=>'form-control input-sm')); ?>
	</div>
	<?php echo CHtml::error($ctp,'responsable',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group col-sm-6">
	<?php echo CHtml::activeLabelEx($ctp,'idImprenta',array('class'=>'control-label col-sm-4')); ?>
	<div class="col-sm-8">
		<?php echo CHtml::activeTextField($ctp,'idImprenta',array('class'=>'form-control input-sm')); ?>
	</div>
	<?php echo CHtml::error($ctp,'idImprenta',array('class'=>'label label-danger')); ?>
</div>
<div class="form-group col-sm-6">
	<?php echo CHtml::activeLabelEx($cliente,'nitCi',array('class'=>'control-label col-sm-4')); ?>
	<div class="col-sm-8">
		<?php echo CHtml::activeTextField($cliente,'nitCi',array('class'=>'form-control input-sm',"id"=>"NitCi")); ?>
	</div>
	<?php echo CHtml::error($cliente,'nitCi',array('class'=>'label label-danger')); ?>
</div>
<div class="form-group col-sm-6">
	<?php echo CHtml::activeLabelEx($cliente,'apellido',array('class'=>'control-label col-sm-4')); ?>
	<div class="col-sm-8">
		<?php echo CHtml::activeTextField($cliente,'apellido',array('class'=>'form-control input-sm',"id"=>"apellido")); ?>
	</div>
	<?php echo CHtml::error($cliente,'apellido',array('class'=>'label label-danger')); ?>
</div>
<?php

Yii::app()->getClientScript()->registerScript("ajax_cliente",
"
	function cliente (nitCi)
	{
		nitCi = jQuery.trim(nitCi);
		if(nitCi.length>0){
	        $.ajax({
	            url: '".CHtml::normalizeUrl(array('/orden/ajaxCliente'))."', 
	            type: 'GET', 
	            data: { nitCi: nitCi},
	            success: function (data){ 
				 			data = JSON.parse(data);
							data[\"cliente\"] = JSON.parse(data[\"cliente\"]);
							if(data[\"deuda\"]==true)
							{	alert(\"El Cliente \"+data[\"cliente\"][\"apellido\"]+\" tiene una deuda\");	}
	            			$('#apellido').val(data[\"cliente\"][\"apellido\"]); 
	            			$('#clienteNit').val(data[\"cliente\"][\"nitCi\"]);
						 },
				error:	$('#clienteNit').val(nitCi),
	        });
		}
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