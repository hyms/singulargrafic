<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Ventas', 'url'=>array('report/venta')),
							array('label'=>'Clientes', 'url'=>array('report/cliente')),
							array('label'=>'Productos', 'url'=>array('report/producto')),
							
						),
				)); 


?>
