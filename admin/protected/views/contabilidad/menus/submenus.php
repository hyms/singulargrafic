<?php
$items = array();
if($tipo=="ctp") {
    $almacenes = Almacen::model()->findAll('nombre like "CTP%"');
    foreach ($almacenes as $key => $item) {
        $items[$key] = array('label' => $item->nombre, 'url' => array('contabilidad/matrizPrecios', 'id' => $item->idAlmacen));
    }
}
if($tipo=="dist"){
    $almacenes = Almacen::model()->findAll('nombre like "Distribuidora%"');
    foreach ($almacenes as $key => $item) {
        $items[$key] = array('label' => $item->nombre, 'url' => array('contabilidad/precios', 'id' => $item->idAlmacen));
    }
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