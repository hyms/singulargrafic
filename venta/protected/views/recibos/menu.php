<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Recibos Realizados', 'url'=>array('recibos/index')),
							array('label'=>'Nuevo Ingreso', 'url'=>array('recibos/ingreso')),
							array('label'=>'Nuevo Egreso', 'url'=>array('recibos/egreso')),
							
						),
				)); 
?>