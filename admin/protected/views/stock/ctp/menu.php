<?php 
$this->widget('zii.widgets.CMenu',
		array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Inventario', 'url'=>array('stock/distribuidora')),
							array('label'=>'Movimiento', 'url'=>array('#')),
							
						),
				)
		); 

?>
