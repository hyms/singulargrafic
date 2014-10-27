<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo</strong>
    </div>
    <div class="panel-body" style="overflow: auto;">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$placas->searchPlacas(),
            'filter'=>$placas,
            'ajaxUpdate'=>false,
            'itemsCssClass' => 'table table-hover table-condensed',
            'htmlOptions' => array('class' => 'table-responsive'),
            'columns'=>array(
                array(
                    'header'=>'Nro',
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
                array(
                    'header'=>'Formato',
                    'value'=>'$data->formato',
                    'filter'=>CHtml::activeTextField($placas,'formato',array('class'=>'form-control input-sm')),
                    //'filter'=>CHtml::activeDropDownList($placas,'formato',CHtml::listData(DetalleCTP::model()->findAll(),'formato','formato'),array('class'=>'form-control input-sm','empty'=>'')),
                ),
                array(
                    'header'=>'Codigo',
                    'value'=>'$data->idCTP0->codigo',
                    'filter'=>CHtml::activeTextField($placas,'codigo',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Cliente',
                    'value'=>'$data["idCTP0"]["idCliente0"]["apellido"]',
                    'filter'=>CHtml::activeTextField($placas,'cliente',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Cant.',
                    'value'=>'$data->nroPlacas',
                    'filter'=>CHtml::activeTextField($placas,'nroPlacas',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Fecha',
                    'type'=>'raw',
                    'value'=>'$data->idCTP0->fechaOrden',
                    'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name'=>'fecha',
                                'attribute'=>'fecha',
                                'language'=>'es',
                                'model'=>$placas,
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
                /*array(
                    'header'=>'',
                    'type'=>'raw',
                    'value'=>'CHtml::link("Ver",array("#","id"=>$data->idCTP),array("class"=>"btn btn-success btn-sm"))',
                ),*/
            )
        ));
        ?>
    </div>
</div>
