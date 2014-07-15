<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Ventas de Hoy', 'url'=>array('ctp/movimientos','d'=>date('d'))),
							array('label'=>'Ventas de Ayer', 'url'=>array('ctp/movimientos','d'=>(date('d')-1))),
							array('label'=>'Ventas del Mes', 'url'=>array('ctp/movimientos','m'=>date('m'))),
							//array('label'=>'Productos', 'url'=>array('#')),
							
						),
				)); 


?>
