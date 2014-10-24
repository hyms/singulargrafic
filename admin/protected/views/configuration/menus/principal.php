<div class="well well-sm">
    <?php
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>
            array(
                array('label'=>'Sucursales', 'url'=>array('configuration/sucursales')),
                array('label'=>'Cajas', 'url'=>array('configuration/cajas')),
                array('label'=>'Almacenes', 'url'=>array('configuration/almacenes')),
            )
    ));
    ?>
</div>