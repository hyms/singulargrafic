<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo</strong>
    </div>
    <div class="panel-body" style="overflow: auto;">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$ordenes->search(),
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
				'header'=>'Cliente',
				'value'=>'$data->idCTPParent0->idCliente0->apellido',
                'filter'=>CHtml::activeTextField($ordenes,'apellido',array('class'=>'form-control input-sm')),
			),
            array(
                'header'=>'Cod. de Orden',
                'value'=>'$data->idCTPParent0->codigo',
                'filter'=>CHtml::activeTextField($ordenes,'codigoP',array('class'=>'form-control input-sm')),
            ),
            array(
					'header'=>'Fecha',
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
					'value'=>'CHtml::link("Modificar",array("repos/modificar","id"=>$data->idCTP),array("class"=>"btn btn-success btn-sm"))',
			),
		)
	));
?>
    </div>
</div>
