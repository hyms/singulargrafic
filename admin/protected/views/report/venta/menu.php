<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Ventas del Dia', 'url'=>array('#')),
							array('label'=>'Ventas de la Semana', 'url'=>array('#')),
							array('label'=>'Ventas del Mes', 'url'=>array('#')),
							array('label'=>'Ventas del Año', 'url'=>array('#')),
							array('label'=>'Todas las Ventas', 'url'=>array('#')),
							
						),
				)); 


?>
