<?php Yii::app()->getClientScript()->registerScript("ajax_reset",
"
 $('#reset').click(function(){
		//alert('se guardaran los datos');
		//document.getElementById('form').reset();
		parent.history.back();
        return false;
});
",CClientScript::POS_READY);