<div class="well well-sm">
    <?php
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>array(
            array('label'=>'Notas de Venta', 'url'=>array('distribuidora/reportDate')),
            array('label'=>'Productos', 'url'=>array('distribuidora/reportProducto')),
            array('label'=>'Saldos', 'url'=>array('report/productoSaldo','almacen'=>2)),
        )));
    ?>
</div>