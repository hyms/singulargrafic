<div class="well well-sm">
    <?php
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>array(
            array('label'=>'Listar Clientes', 'url'=>array('cliente/clientes')),
            array('label'=>'Nuevo Cliente', 'url'=>array('cliente/create')),
        )));
    ?>
</div>