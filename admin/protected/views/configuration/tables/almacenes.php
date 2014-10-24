<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Lista de Productos</strong>
    </div>
    <div class="panel-body" style="overflow: auto;">

        <?php //echo CHtml::link('Dercargar Excel <span class="glyphicon glyphicon-save"></span>',array('#','excel'=>true), array('class' => 'btn btn-default') ); ?>

        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            //'dataProvider'=>$dataProvider,
            'dataProvider'=>$almacenes,
            'itemsCssClass' => 'table table-hover table-condensed',
            'htmlOptions' => array('class' => 'table-responsive'),
            'columns'=>array(
                array(
                    'header'=>'Nro',
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),

                array(
                    'header'=>'Nombre',
                    'value'=>'$data->nombre',
                ),
                array(
                    'header'=>'Sucursal',
                    'value'=>'$data["idSucursal0"]["nombre"]',
                ),
                array(
                    'header'=>'',
                    'type'=>'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-edit\"></span>",array("configuration/almacen","id"=>$data->idAlmacen),array("class" => "openDlg divDialog", "title"=>"Modificar datos"))'
                ),
            )
        ));
        ?>
        <?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-disk"></span> Añadir',array("configuration/almacen"),array("class" => "openDlg divDialog", "title"=>"Añadir Datos")); ?>

    </div>
</div>
<?php
$this->renderPartial("scripts/modal");

$this->beginWidget('zii.widgets.jui.CJuiDialog', array('id'=>'divDialog',
    'options'=>array( 'title'=>'Almacen', 'autoOpen'=>false, 'modal'=>true, 'width'=>400)));
?>
<div class="divForForm"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>