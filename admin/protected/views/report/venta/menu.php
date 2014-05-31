<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Ventas de Hoy', 'url'=>array('report/venta','d'=>date('d'))),
							array('label'=>'Ventas de Ayer', 'url'=>array('report/venta','d'=>(date('d')-1))),
							array('label'=>'Ventas del Mes', 'url'=>array('report/venta','m'=>date('m'))),
							array('label'=>'Todas las Ventas', 'url'=>array('report/venta','t'=>'all')),
						),
				)); 


?>
