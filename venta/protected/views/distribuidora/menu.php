<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Nueva Venta', 'url'=>array('/distribuidora/index')),
							array('label'=>'Confirmar Venta', 'url'=>array('#')),
							array('label'=>'Lista de Ventas', 'url'=>array('#')),
							array('label'=>'Producto', 'url'=>array('producto/index')),
						),
				)); 
?>