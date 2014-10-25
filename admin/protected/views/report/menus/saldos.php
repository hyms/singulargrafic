<?php
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>array(
            array('label'=>'Deposito', 'url'=>array('report/productoSaldo','almacen'=>1)),
            array('label'=>'Distribuidora', 'url'=>array('report/productoSaldo','almacen'=>2)),
            array('label'=>'CTP', 'url'=>array('report/productoSaldo','almacen'=>3)),
        ),
    ));