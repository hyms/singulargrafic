<?php
$this->widget('zii.widgets.CMenu',array(
    'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
    'activeCssClass'	=> 'active',
    'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
    'encodeLabel' => false,
    'items'=>array(
        array('label'=>'Recibos Ingreso', 'url'=>array("caja/buscar","t"=>1)),
        array('label'=>'Recibos Egreso', 'url'=>array("caja/buscar","t"=>0)),
    ),
));
