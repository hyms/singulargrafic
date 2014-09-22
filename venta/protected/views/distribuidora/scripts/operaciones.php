<?php Yii::app()->getClientScript()->registerScript("ajax_operaciones",
"
   	function suma(a,b)
	{
		return ((a*1) + (b*1));
	}
	
	function resta(a,b)
	{
		return ((a*1) - (b*1));
	}
   
	function redondeo(num)
	{
		return (Math.round(num*10)/10);
	}
",CClientScript::POS_HEAD); ?>