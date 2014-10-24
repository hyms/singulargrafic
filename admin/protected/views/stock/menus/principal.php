<div class="well well-sm">
    <?php
    $almacences = Almacen::model()->findAll('idSucursal IS NOT NULL and idSucursal<>""');
    $items = array();
    foreach($almacences as $key => $item)
    {
        $items[$key] = array('label'=>$item->nombre, 'url'=>array('stock/almacen','almacen'=>$item->idAlmacen));
    }
    array_push($items,array('label'=>'Movimientos', 'url'=>array('stock/movimientos')));

    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>$items,
        /*array(
        array('label'=>'Deposito', 'url'=>array('stock/almacen','almacen'=>1)),
        array('label'=>'Movimientos', 'url'=>array('stock/movimientos')),
        )*/
    ));
    ?>
</div>