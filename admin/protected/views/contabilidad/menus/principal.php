<div class="well well-sm">
    <?php
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>array(
            array('label'=>'CTP', 'url'=>array('contabilidad/matrizPrecios')),
            array('label'=>'Distribuidora', 'url'=>array('contabilidad/precios')),
        )));
    ?>
</div>