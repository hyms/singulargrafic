<?php Yii::app()->clientScript->registerScript("ajax_print","
	$('#print').click(function(){
		window.print();
	});
",CClientScript::POS_READY);