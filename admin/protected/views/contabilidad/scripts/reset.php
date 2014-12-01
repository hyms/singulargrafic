<?php Yii::app()->getClientScript()->registerScript("ajax_reset",
"
 $('#reset').click(function(){
		//alert('se guardaran los datos');
		parent.history.back();
        return false;
});
",CClientScript::POS_READY); ?>