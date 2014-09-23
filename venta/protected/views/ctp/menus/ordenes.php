<?php
$this->widget('zii.widgets.CMenu',array(
    'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
    'activeCssClass'	=> 'active',
    'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
    'encodeLabel' => false,
    'items'=>array(
        array('label'=>'Cliente', 'url'=>array('ctp/buscar','t'=>1)),
        array('label'=>'Interna', 'url'=>array('ctp/buscar','t'=>2)),
        array('label'=>'Repeticion', 'url'=>array('ctp/buscar','t'=>3)),
    ),
));