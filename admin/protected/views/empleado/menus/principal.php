<div class="well well-sm">
    <?php
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>array(
            array('label'=>'Listar Empleados', 'url'=>array('empleado/empleados')),
            array('label'=>'Nuevo Empleado', 'url'=>array('empleado/create')),
        )));
    ?>
</div>