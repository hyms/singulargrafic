<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Ordenes de Trabajo', 'url'=>array('ctp/ordenes')),
							array('label'=>'Buscar Ordenes', 'url'=>array('ctp/buscar')),
							array('label'=>'Deudores', 'url'=>array('ctp/deudores')),
							array('label'=>'Movimientos', 'url'=>array('ctp/movimientos')),
							array('label'=>'Arqueo', 'url'=>array('ctp/arqueo')),
							array('label'=>'Material', 'url'=>array('ctp/material')),
						),
				)); 
?>