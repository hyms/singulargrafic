<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Diario Caja', 'url'=>array('caja/index')),
							array('label'=>'Recibo Ingreso', 'url'=>array('caja/reciboIngreso')),
							//array('label'=>'Recibo Egreso', 'url'=>array('caja/reciboEgreso')),
							array('label'=>'Buscar Recibos', 'url'=>array('caja/buscar')),
						),
				)); 
?>