<div class="well well-sm">
    <?php
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>array(
            array('label'=>'Deposito', 'url'=>array('stock/almacen','almacen'=>1)),
            array('label'=>'Distribuidora', 'url'=>array('stock/almacen','almacen'=>2)),
            array('label'=>'Pre Prensa CTP', 'url'=>array('stock/almacen','almacen'=>3)),
        )));
    ?>
</div>