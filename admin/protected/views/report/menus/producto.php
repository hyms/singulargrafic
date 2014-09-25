<div class="well well-sm">
    <?php
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>array(
            array('label'=>'Por Agotarse', 'url'=>array('report/productoAgotarse')),
            array('label'=>'Saldos', 'url'=>array('report/productoSaldo')),
        ),
    ));
    ?>
</div>