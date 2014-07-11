<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Ordenes de Trabajo', 'url'=>array('ctp/ordenes')),
							array('label'=>'Deudores', 'url'=>array('#')),
							array('label'=>'Movimientos', 'url'=>array('#')),
						),
				)); 
?>