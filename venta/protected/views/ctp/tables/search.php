<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo</strong>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$ordenes->searchOrder('`t`.estado!=1'),
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
                    'header'=>'codigo',
                    'value'=>'$data->codigo',
                    'filter'=>CHtml::activeTextField($ordenes,'codigo',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Cliente',
                    'value'=>'(isset($data->idCliente0->apellido))?$data->idCliente0->apellido:""',
                    'filter'=>CHtml::activeTextField($ordenes,'apellido',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Fecha Orden',
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
                    'header'=>'Tipo Orden',
                    'value'=>'($data->tipoCTP==1)?"Cliente":(($data->tipoCTP==2)?"Interna":"Reposicion")',
                    'filter'=>CHtml::activeDropDownList($ordenes,'tipoCTP',array('1'=>'Cliente','2'=>'Interna','3'=>'Reposicion'),array('class'=>'form-control input-sm','empty'=>'')),
                ),
                array(
                    'header'=>'',
                     'type'=>'raw',
                     'value'=>'($data->tipoCTP==1)?CHtml::link("<span class=\"glyphicon glyphicon-edit\"></span> Modificar",array("ctp/modificar","id"=>$data->idCTP),array("class"=>"hidden-print ","title"=>"Modificar Orden de Trabajo")):""',
                ),
                array(
                    'header'=>'',
                    'type'=>'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-print\"></span>",array("ctp/preview","id"=>$data->idCTP),array("class"=>"hidden-print","title"=>"Imprimir"))',
                ),
            )
        ));
        ?>
    </div>
</div>