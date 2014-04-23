<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Nuevo Recivo Ingreso', 'url'=>array('recibos/index')),
							array('label'=>'Nuevo Recivo Egreso', 'url'=>array('recibos/index')),
							array('label'=>'Recibos Realizados', 'url'=>array('#')),
						),
				)); 
?>