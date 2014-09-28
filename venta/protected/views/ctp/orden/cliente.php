<div class="form-group col-xs-6">
	<?php echo CHtml::activeLabelEx($cliente,'nitCi',array('class'=>'control-label col-xs-4')); ?>
	<div class="col-xs-8">
		<?php echo CHtml::activeTextField($cliente,'nitCi',array('class'=>'form-control input-sm',"id"=>"NitCi")); ?>
	</div>
	<?php echo CHtml::error($cliente,'nitCi',array('class'=>'label label-danger')); ?>
</div>
<div class="form-group col-xs-6">
	<?php echo CHtml::activeLabelEx($cliente,'apellido',array('class'=>'control-label col-xs-4')); ?>
	<div class="col-xs-8">
		<?php echo CHtml::activeTextField($cliente,'apellido',array('class'=>'form-control input-sm',"id"=>"apellido","readonly"=>true)); ?>
	</div>
	<?php echo CHtml::error($cliente,'apellido',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group col-xs-6">
	<?php echo CHtml::activeLabelEx($ctp,'responsable',array('class'=>'control-label col-xs-4')); ?>
	<div class="col-xs-8">
		<?php echo CHtml::activeTextField($ctp,'responsable',array('class'=>'form-control input-sm',"id"=>"NitCi")); ?>
	</div>
	<?php echo CHtml::error($ctp,'responsable',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group col-xs-6">
	<?php echo CHtml::activeLabelEx($cliente,'telefono',array('class'=>'control-label col-xs-4')); ?>
	<div class="col-xs-8">
		<?php echo CHtml::activeTextField($cliente,'telefono',array('class'=>'form-control input-sm',"id"=>"NitCi")); ?>
	</div>
	<?php echo CHtml::error($cliente,'telefono',array('class'=>'label label-danger')); ?>
</div>
<?php

Yii::app()->getClientScript()->registerScript("ajax_cliente",
"
	function cliente (nitCi)
	{
		nitCi = jQuery.trim(nitCi);
		if(nitCi.length>0){
	        $.ajax({
	            url: '".CHtml::normalizeUrl(array('/distribuidora/ajaxCliente'))."', 
	            type: 'GET', 
	            data: { nitCi: nitCi},
	            success: function (data){ 
				 			data = JSON.parse(data);
							data[\"cliente\"] = JSON.parse(data[\"cliente\"]);
							if(data[\"deuda\"]==true)
							{	alert(\"El Cliente \"+data[\"cliente\"][\"apellido\"]+\" tiene una deuda\");	}
							if(data[\"cliente\"][\"apellido\"]!=\"\")
							{
								$('#apellido').prop('readonly', true);
							}
							else
							{
								$('#apellido').prop('readonly', false);
							}
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