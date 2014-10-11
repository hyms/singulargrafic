<?php Yii::app()->getClientScript()->registerScript("ajax_detalleventa","
	$('#pagado').blur(function(e){
		$('#cambio').val(redondeo(resta($('#pagado').val(),$('#total').val())));
		return true;
	});
		
	$('#pagado').keydown(function(e){
		if(e.keyCode==13 || e.keyCode==9) 
	    { 
			$('#cambio').val(redodeo(resta($('#pagado').val(),$('#total').val())));
			$('#cambio').focus();
			return true;
		}
	});	
",CClientScript::POS_READY);