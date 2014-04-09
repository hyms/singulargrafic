<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Nueva Venta', 'url'=>array('/distribuidora/index')),
							array('label'=>'Ventas por Confirmar', 'url'=>array('/distribuidora/venta')),
							array('label'=>'Ventas realizadas', 'url'=>array('#')),
							array('label'=>'Producto', 'url'=>array('producto/index')),
						),
				)); 
?>