<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo</strong>
    </div>
    <div class="panel-body" style="overflow: auto;">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$ordenes,
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
			),
			array(
					'header'=>'Cliente',
					'value'=>'$data->idCTPParent0->idCliente0->apelido',
			),
            array(
                'header'=>'Cod. de Orden',
                'value'=>'$data->idCTPParent0->codigo',
            ),
            array(
					'header'=>'Fecha',
					'value'=>'$data->fechaOrden',
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("Modificar",array("orden/modificarR","id"=>$data->idCTP),array("class"=>"btn btn-success btn-sm"))',
			),
		)
	));
?>
    </div>
</div>
