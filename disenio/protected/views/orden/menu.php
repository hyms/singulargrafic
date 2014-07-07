<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Cliente', 'url'=>array('orden/cliente')),
							array('label'=>'Interna', 'url'=>array('orden/interna')),
							array('label'=>'Repeticion', 'url'=>array('orden/rep')),
				)));
?>
