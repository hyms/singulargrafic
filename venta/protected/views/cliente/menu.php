<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Registrar Cliente', 'url'=>array('cliente/register')),
							array('label'=>'Reportes', 'url'=>array('cliente/index')),
						),
				)); 
?>