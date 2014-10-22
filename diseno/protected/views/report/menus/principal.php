<div class="well well-sm">
    <?php
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>array(
            array('label'=>'Ordenes', 'url'=>array('report/ordenes')),
            array('label'=>'Placas', 'url'=>array('report/placas')),
            array('label'=>'Deudas', 'url'=>array('report/deuda')),
        )));
    ?>
</div>