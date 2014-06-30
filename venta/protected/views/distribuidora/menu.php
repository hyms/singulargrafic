<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Nueva Venta', 'url'=>array('distribuidora/notas')),
							array('label'=>'Buscar Venta', 'url'=>array('distribuidora/buscar')),
							array('label'=>'Deudores', 'url'=>array('distribuidora/deudores')),
							array('label'=>'Movimientos', 'url'=>array('distribuidora/movimientos')),
							array('label'=>'Productos', 'url'=>array('distribuidora/productos')),
							array('label'=>'Arqueo', 'url'=>array('distribuidora/arqueo')),
				)));
?>
