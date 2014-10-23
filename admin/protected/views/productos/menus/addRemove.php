<?php
$items = array();
foreach($almacenes as $key => $item)
{
    if($item->idAlmacen > 1)
    {
        $items[$key]=array('label'=>$item->nombre, 'url'=>array('productos/productoAdd','almacen'=>$item->idAlmacen));
    }
}


    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>$items,
          //  array('label'=>'Deposito', 'url'=>array('productos/productoAdd','almacen'=>1)),

        ));