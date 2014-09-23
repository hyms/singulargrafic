<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Hoy', 'url'=>array('distribuidora/arqueo','d'=>date('d'))),
							array('label'=>'Ayer', 'url'=>array('distribuidora/arqueo','d'=>(date('d')-1))),
							array('label'=>'Reporte de Arqueos', 'url'=>array('distribuidora/arqueo','list'=>true)),
							//array('label'=>'Productos', 'url'=>array('#')),
							
						),
				));