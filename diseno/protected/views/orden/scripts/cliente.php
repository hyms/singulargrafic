<?php
Yii::app()->getClientScript()->registerScript("ajax_cliente",
"
	function cliente (nitCi)
	{
		nitCi = jQuery.trim(nitCi);
		if(nitCi.length>0){
	        $.ajax({
	            url: '".CHtml::normalizeUrl(array('orden/ajaxCliente'))."',
	            type: 'GET', 
	            data: { nitCi: nitCi},
	            success: function (data){ 
				    data = JSON.parse(data);
					data[\"cliente\"] = JSON.parse(data[\"cliente\"]);
					if(data[\"deuda\"]==true)
					{
					    alert(\"El Cliente \"+data[\"cliente\"][\"apellido\"]+\" tiene una deuda\");	}
	            		if(data[\"cliente\"][\"apellido\"]!=\"\")
						{
							$('#apellido').prop('readonly', true);
						}
						else
						{
							$('#apellido').prop('readonly', false);
						}
						$('#apellido').val(data[\"cliente\"][\"apellido\"]);
	            		$('#NitCi').val(data[\"cliente\"][\"nitCi\"]);
							
					},
				error:	
					$('#apellido').prop('readonly', false),
	        });
		}
	}
",CClientScript::POS_HEAD);

Yii::app()->getClientScript()->registerScript("ajax_cliente",
    "
    $('#NitCi').keydown(function(e){ 
        if(e.keyCode==13 || e.keyCode==9) 
	    { 
	    	if($('#NitCi').val()!=\"\")
	     	{	
	           	cliente($('#NitCi').val());
				$('#apellido').focus();
	        }
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
	    	if($('#stockUnidad_0').length>0)
			{
	    		$('#stockUnidad_0').focus();
	    	}
	    	else
	    	{
	    		$('#apellido').focus();
	    	}
	      	return true; 
	    } 
           
    });
 ",CClientScript::POS_READY);
