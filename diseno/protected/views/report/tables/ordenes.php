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
                    'header'=>'Codigo',
                    'value'=>'$data->codigo',
                    'filter'=>CHtml::activeTextField($ordenes,'codigo',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Diseñador',
                    'value'=>'$data->idUserOT0->idEmpleado0->nombre',
                    'filter'=>CHtml::activeTextField($ordenes,'diseno',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Cliente',
                    'value'=>'$data["idCliente0"]["apellido"]',
                    'filter'=>CHtml::activeTextField($ordenes,'apellido',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Responsable',
                    'value'=>'$data["responsable"]',
                    'filter'=>CHtml::activeTextField($ordenes,'responsable',array('class'=>'form-control input-sm')),
                ),//*/
                array(
                    'header'=>'Estado',
                    'value'=>'($data->estado==1)?"Sin Cobrar":(($data->estado==0)?"Cancelado":"Deuda")',
                    'filter'=>CHtml::activeDropDownList($ordenes,'estado',array('1'=>"Sin Cobrar",'2'=>"Deuda",'0'=>"Cancelado"),array('class'=>'form-control input-sm','empty'=>"")),
                    //'filter'=>CHtml::activeTextField($ordenes,'estado',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Fecha',
                    'type'=>'raw',
                    'value'=>'$data->fechaGenerada',
                    'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name'=>'fechaGenerada',
                                'attribute'=>'fechaGenerada',
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
                    //'value'=>'CHtml::link("Ver",array("#","id"=>$data->idCTP),array("class"=>"btn btn-success btn-sm"))',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-list-alt\"></span> ver", array("report/orden","id"=>$data->idCTP), array("class" => "openDlg divDialog","title"=>"Orden de Trabajo"))',
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
