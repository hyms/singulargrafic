<div class="well well-sm">
    <?php
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>array(
            array('label'=>'Reposicion', 'url'=>array('repos/rep')),
            array('label'=>'Buscar Reposicion', 'url'=>array('repos/buscar')),

        )));
    ?>
</div>