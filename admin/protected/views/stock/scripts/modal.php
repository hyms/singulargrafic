<?php
Yii::app()->clientScript->registerScript('row',"
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
",CClientScript::POS_READY);