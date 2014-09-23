<?php 
$this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>array(
            array('label'=>'Ventas de Hoy', 'url'=>array('distribuidora/reportDate','d'=>date('d'))),
            array('label'=>'Ventas de Ayer', 'url'=>array('distribuidora/reportDate','d'=>sprintf("%02s", (date('d')-1)))),
            array('label'=>'Ventas del Mes', 'url'=>array('distribuidora/reportDate','m'=>date('m'))),
        ),
));
