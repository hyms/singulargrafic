<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Registrar Egresos', 'url'=>array('#')),
							array('label'=>'Registrar Ingresos', 'url'=>array('#')),
							array('label'=>'Arqueo', 'url'=>array('#')),
							array('label'=>'Reportes', 'url'=>array('#')),
						),
				)); 
?>