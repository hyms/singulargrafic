<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Inventario de <?php echo $title;?></strong>
    </div>
    <div class="panel-body" style="overflow: auto;">

    <?php echo CHtml::link('Dercargar Excel <span class="glyphicon glyphicon-save"></span>',array('stock/almacen','excel'=>true), array('class' => 'btn btn-default') ); ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        //'dataProvider'=>$productos,
        'dataProvider'=>$productos->search(),
        'filter'=>$productos,
        'itemsCssClass' => 'table table-hover table-condensed',
        'htmlOptions' => array('class' => 'table-responsive'),
        'columns'=>array(
            array(
                    'header'=>'Nro',
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            ),

            array(
                    'header'=>'Codigo',
                    'value'=>'$data->idProducto0->codigo',
                    'filter'=>CHtml::activeTextField($productos, 'codigo',array("class"=>"form-control")),
            ),
            array(
                    'header'=>'Material',
                    'value'=>'$data->idProducto0->material',
                    'filter'=>CHtml::activeDropDownList($productos,'material',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'material','select'=>'material','condition'=>'idAlmacen='.$almacen)),'material','material'),array("class"=>"form-control ",'empty'=>'')),
            ),
            array(
                'header'=>'Color',
                'value'=>'$data->idProducto0->color',
                'filter'=>CHtml::activeDropDownList($productos,'color',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'color','select'=>'color','condition'=>'idAlmacen='.$almacen)),'color','color'),array("class"=>"form-control ",'empty'=>'')),
            ),
            array(
                    'header'=>'Detalle',
                    'value'=>'$data->idProducto0->detalle',
                    'filter'=>CHtml::activeTextField($productos, 'detalle',array("class"=>"form-control")),
            ),
            array(
                'header'=>'Marca',
                'value'=>'$data->idProducto0->marca',
                'filter'=>CHtml::activeDropDownList($productos,'marca',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'marca','select'=>'marca','condition'=>'idAlmacen='.$almacen)),'marca','marca'),array("class"=>"form-control ",'empty'=>'')),
            ),
            array(
                    'header'=>'Precio S/F',
                    'value'=>'$data->idProducto0->precioSFU."/".$data->idProducto0->precioSFP'
            ),
            array(
                    'header'=>'Precio C/F',
                    'value'=>'$data->idProducto0->precioCFU."/".$data->idProducto0->precioCFP'
            ),
            array(
                    'header'=>'Industria',
                    'value'=>'$data->idProducto0->industria',
                    'filter'=>CHtml::activeDropDownList($productos,'industria',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'industria','select'=>'industria','condition'=>'idAlmacen='.$almacen)),'industria','industria'),array("class"=>"form-control",'empty'=>'')),
            ),
            array(
                    'header'=>'Cant.xPaqt.',
                    'value'=>'$data->idProducto0->cantXPaquete'
            ),
            array(
                    'header'=>'Stock Unidad',
                    'value'=>'$data->stockU'
            ),
            array(
                    'header'=>'Stock Paquete',
                    'value'=>'$data->stockP'
            ),
            array(
                    'header'=>'',
                    'type'=>'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-import\"></span>",array("stock/stockAdd","id"=>$data->idAlmacenProducto,"almacen"=>$data->idAlmacen), array("class" => "openDlg divDialog","title"=>"Añadir a Stock"))',
            ),
        )
        ));
    ?>
    </div>
</div>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array('id'=>'divDialog',
    'options'=>array( 'title'=>'Añadir a Stock', 'autoOpen'=>false, 'modal'=>true, 'width'=>800)));
?>
<div class="divForForm"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
