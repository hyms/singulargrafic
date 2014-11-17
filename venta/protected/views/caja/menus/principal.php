<div class="well well-sm">
    <?php
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>array(
            //array('label'=>'Reportes', 'url'=>array('caja/reporte')),
            //array('label'=>'Caja Chica', 'url'=>array('caja/egreso')),
            array('label'=>'Recibo Ingreso', 'url'=>array('caja/reciboIngreso')),
            //array('label'=>'Recibo Egreso', 'url'=>array('caja/reciboEgreso')),
            array('label'=>'Buscar Recibos', 'url'=>array('caja/buscar')),
            //array('label'=>'Envios', 'url'=>array('caja/envios')),
        ),
    ));
    ?>
</div>