<?php
$items = array();
$almacenes = Almacen::model()->findAll('nombre like "CTP%"');
foreach($almacenes as $key => $item)
{
    $items[$key] = array('label'=>$item->nombre, 'url'=>array('contabilidad/matrizPrecios','id'=>$item->idAlmacen));
}

$this->widget('zii.widgets.CMenu',array(
    'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
    'activeCssClass'	=> 'active',
    'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
    'encodeLabel' => false,
    'items'=>$items
        /*array(
        array('label'=>'', 'url'=>array('report/productoSaldo','almacen'=>1)),
    ),*/
));