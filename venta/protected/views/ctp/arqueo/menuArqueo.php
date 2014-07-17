<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Hoy', 'url'=>array('ctp/arqueo','d'=>date('d'))),
							array('label'=>'Ayer', 'url'=>array('ctp/arqueo','d'=>(date('d')-1))),
							array('label'=>'Reporte de Arqueos', 'url'=>array('ctp/arqueo',)),
							//array('label'=>'Productos', 'url'=>array('#')),
							
						),
				)); 


?>