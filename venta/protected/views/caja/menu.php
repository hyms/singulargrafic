<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Reportes', 'url'=>array('caja/index')),
							array('label'=>'Registrar Egresos', 'url'=>array('caja/egreso')),
							array('label'=>'Registrar Ingresos', 'url'=>array('caja/ingreso')),
							array('label'=>'Arqueo', 'url'=>array('caja/arqueo')),
						),
				)); 
?>