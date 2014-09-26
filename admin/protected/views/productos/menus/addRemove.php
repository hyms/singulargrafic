<?php
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>array(
          //  array('label'=>'Deposito', 'url'=>array('productos/productoAdd','almacen'=>1)),
            array('label'=>'Distribuidora', 'url'=>array('productos/productoAdd','almacen'=>2)),
            array('label'=>'Pre Prensa CTP', 'url'=>array('productos/productoAdd','almacen'=>3)),
        )));