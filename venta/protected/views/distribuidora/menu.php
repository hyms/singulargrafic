<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Nueva Venta', 'url'=>array('distribuidora/notas')),
							array('label'=>'Buscar Venta', 'url'=>array('distribuidora/buscar')),
							array('label'=>'Deudores', 'url'=>array('#')),
							array('label'=>'Movimientos', 'url'=>array('#')),
							
						),
				)); 


?>
