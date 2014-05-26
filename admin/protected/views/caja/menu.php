<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Cajas', 'url'=>array('#')),
							array('label'=>'Libro Mayor', 'url'=>array('#')),
							array('label'=>'Libro Diario', 'url'=>array('#')),
						),
				)); 
?>