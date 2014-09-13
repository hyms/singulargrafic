<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Mas Vendidos', 'url'=>array('#')),
							array('label'=>'Ultimos Vendidos', 'url'=>array('#')),
							array('label'=>'Por Agotarse', 'url'=>array('report/productoAgotarse')),
							array('label'=>'Saldos ', 'url'=>array('report/productoSaldo')),
							
						),
				)); 


?>
