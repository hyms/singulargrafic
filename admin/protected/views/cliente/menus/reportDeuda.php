<div class="well well-sm">
    <?php
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>array(
            array('label'=>'Distribuidoras', 'url'=>array('cliente/compradores','id'=>1)),
            array('label'=>'CTPs', 'url'=>array('cliente/deudores','id'=>2)),
        )));
    ?>
</div>