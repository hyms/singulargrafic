<div class="well well-sm">
    <?php
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>array(
            array('label'=>'Listar Productos', 'url'=>array('productos/productos')),
            array('label'=>'Nuevo Producto', 'url'=>array('productos/new')),
            array('label'=>'Añadir a Almacen', 'url'=>array('productos/#')),
        )));
    ?>
</div>