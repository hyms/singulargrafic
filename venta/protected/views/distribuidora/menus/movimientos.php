<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Ventas de Hoy', 'url'=>array('distribuidora/movimientos','d'=>date('d'))),
							array('label'=>'Ventas de Ayer', 'url'=>array('distribuidora/movimientos','d'=>sprintf("%02s", (date('d')-1)))),
							array('label'=>'Ventas del Mes', 'url'=>array('distribuidora/movimientos','m'=>date('m'))),
							array('label'=>'Productos', 'url'=>array('distribuidora/movimientosProducto')),
							
						),
				)); 


?>
