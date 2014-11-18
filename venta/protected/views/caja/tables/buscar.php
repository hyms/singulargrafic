<?php
$this->renderPartial('menus/tipoRecibo');
?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$recibos->search(),
            'filter'=>$recibos,
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
                    'filter'=>CHtml::activeTextField($recibos, 'codigo',array("class"=>"form-control input-sm hidden-print")),
                    'htmlOptions'=>array('class'=>'col-xs-1'),
                ),
                array(
                    'header'=>'Categoria',
                    'value'=>'$data->categoria',
                    'filter'=>CHtml::activeDropDownList($recibos,'categoria',CHtml::listData(Recibos::model()->findAll(array('group'=>'categoria','select'=>'categoria')),'categoria','categoria'),array("class"=>"form-control input-sm hidden-print",'empty'=>'')),
                ),
                array(
                    'header'=>'Nro Codigo',
                    'value'=>'$data->codigoNumero',
                    'filter'=>CHtml::activeTextField($recibos, 'codigoNumero',array("class"=>"form-control input-sm hidden-print")),
                ),
                array(
                    'header'=>'Monto',
                    'value'=>'$data->monto',
                ),
                array(
                    'header'=>'A/C',
                    'value'=>'$data->acuenta',
                ),
                array(
                    'header'=>'Saldo',
                    'value'=>'$data->saldo',
                ),
                array(
                    'header'=>'Fecha',
                    'value'=>'$data->fechaRegistro',
                    'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name'=>'fechaRegistro',
                            'attribute'=>'fechaRegistro',
                            'language'=>'es',
                            'model'=>$recibos,
                            'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'yy-mm-dd',
                            ),
                            'htmlOptions'=>array(
                                'class'=>'form-control input-sm hidden-print',
                            ),
                        ),
                        true),
                ),
                array(
                    'header'=>'',
                    'type'=>'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-edit\"></span>Modificar",array("caja/modificarRecibo","id"=>$data->idRecibos),array("class"=>"hidden-print","title"=>"Modificar Recibo"))',
                ),
                array(
                    'header'=>'',
                    'type'=>'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-print\"></span>",array("caja/preview","id"=>$data->idRecibos),array("class"=>"hidden-print","title"=>"Imprimir"))',
                ),
            )
        ));
        ?>
    </div>
</div>
