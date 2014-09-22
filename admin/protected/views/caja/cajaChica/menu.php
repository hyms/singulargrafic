<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Cajas Chicas', 'url'=>array('caja/chicas')),
							array('label'=>'Tipos de Movimientos', 'url'=>array('caja/tipo')),
						),
				)); 
?>