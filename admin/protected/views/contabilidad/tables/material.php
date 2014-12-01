<ul class="list-group">
    <?php
    foreach($lista as $key => $item)
    {
        echo '<li class="list-group-item col-xs-6">';
        echo CHtml::link($item->idProducto0->material." ".$item->idProducto0->color." ".$item->idProducto0->detalle." ".$item->idProducto0->marca, array("contabilidad/PrecioDist","id"=>$item->idProducto,'al'=>$item->idAlmacenProducto), array("class" => "openDlg divDialog","title"=>"Nota de Venta"));
        echo '</li>';
    }
    ?>
</ul>

<?php
$this->renderPartial("scripts/modal");

$this->beginWidget('zii.widgets.jui.CJuiDialog', array('id'=>'divDialog',
    'options'=>array( 'title'=>'Producto:', 'autoOpen'=>false, 'modal'=>true, 'width'=>800)));
?>
<div class="divForForm"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>