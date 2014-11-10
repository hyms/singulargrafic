<?php Yii::app()->getClientScript()->registerScript("ajax_remove","
	$(document).on('click','#yw3 .tabular-input-remove', function(event) {
		event.preventDefault();
		$(this).parents('.tabular-input:first').remove();
		$('.tabular-input-container').filter(function(){return $.trim($(this).text())==='' && $(this).children().length == 0}).siblings('.tabular-header').hide();
	});
",CClientScript::POS_READY);