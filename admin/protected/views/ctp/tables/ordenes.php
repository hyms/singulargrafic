<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo</strong>
    </div>
    <div class="panel-body" style="overflow: auto;">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$ordenes->searchReport(),
            'filter'=>$ordenes,
            'ajaxUpdate'=>false,
            'itemsCssClass' => 'table table-hover table-condensed',
            'htmlOptions' => array('class' => 'table-responsive'),
            'columns'=>array(
                array(
                    'header'=>'Nro',
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
                array(
                    'header'=>'Sucursal',
                    'value'=>'Sucursal::model()->findByPk($data["idSucursal"])["nombre"]',
                    'filter'=>CHtml::activeDropDownList($ordenes,'idSucursal',CHtml::listData(Sucursal::model()->findAll(),'idSucursal','nombre'),array('class'=>'form-control input-sm','empty'=>'')),
                ),
                array(
                    'header'=>'Codigo',
                    'value'=>'$data["codigo"]',
                    'filter'=>CHtml::activeTextField($ordenes,'codigo',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Diseñador',
                    'value'=>'$data["idUserOT0"]["idEmpleado0"]["apellido"]',
                    'filter'=>CHtml::activeDropDownList($ordenes,'user',CHtml::listData(Empleado::model()->findAll(),'idEmpleado','apellido'),array('class'=>'form-control input-sm','empty'=>'')),
                ),
                array(
                    'header'=>'Cliente',
                    'value'=>'$data["idCliente0"]["apellido"]',
                    'filter'=>CHtml::activeTextField($ordenes,'apellido',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Estado',
                    'value'=>'($data->estado==1)?"Sin Cobrar":(($data->estado==0)?"Cancelado":"Deuda")',
                    'filter'=>CHtml::activeDropDownList($ordenes,'estado',array('1'=>"Sin Cobrar",'2'=>"Deuda",'0'=>"Cancelado"),array('class'=>'form-control input-sm','empty'=>"")),
                ),
                array(
                    'header'=>'Fecha',
                    'type'=>'raw',
                    'value'=>'$data->fechaOrden',
                    'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name'=>'fechaOrden',
                                'attribute'=>'fechaOrden',
                                'language'=>'es',
                                'model'=>$ordenes,
                                'options'=>array(
                                    'showAnim'=>'fold',
                                    'dateFormat'=>'yy-mm-dd',
                                ),
                                'htmlOptions'=>array(
                                    'class'=>'form-control input-sm',
                                ),
                            ),
                            true),
                ),
                array(
                    'header'=>'',
                    'type'=>'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-list-alt\"></span> ver", array("ctp/reportOrden","id"=>$data->idCTP), array("class" => "openDlg divDialog","title"=>"Orden de Trabajo"))',
                ),
            )
        ));
        ?>
    </div>
</div>

<?php
$this->renderPartial("scripts/modal");

$this->beginWidget('zii.widgets.jui.CJuiDialog', array('id'=>'divDialog',
    'options'=>array( 'title'=>'Detalle de Orden', 'autoOpen'=>false, 'modal'=>true, 'width'=>840)));
?>
<div class="divForForm"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>