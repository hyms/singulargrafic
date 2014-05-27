<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Notas de Ventas', 'url'=>array('report/venta')),
							array('label'=>'Ordenes de Trabajo', 'url'=>array('#')),
							array('label'=>'Clientes', 'url'=>array('report/cliente')),
							array('label'=>'Productos', 'url'=>array('report/producto')),
							
						),
				)); 


?>
