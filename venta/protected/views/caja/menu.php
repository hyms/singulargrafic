<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Registrar Egresos', 'url'=>array('caja/egreso')),
							array('label'=>'Registrar Ingresos', 'url'=>array('caja/ingreso')),
							array('label'=>'Arqueo', 'url'=>array('caja/arqueo')),
							array('label'=>'Reportes', 'url'=>array('#')),
						),
				)); 
?>