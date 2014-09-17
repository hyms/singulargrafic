<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
<?php $this->renderPartial('arqueo/menuArqueo');?>
<div class="panel panel-default">
		<div class="panel-body" style="overflow: auto;">
<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$arqueos,
		'ajaxUpdate'=>true,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
			array(
					'header'=>'Nro',
					'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
			),
			array(
					'header'=>'Usuario',
					'value'=>'$data->idUser0->idEmpleado0->nombre." ".$data->idUser0->idEmpleado0->apellido',
			),
			array(
					'header'=>'Monto',
					'value'=>'$data->monto',
			),
			array(
					'header'=>'Fecha de Arqueo',
					'value'=>'$data->fechaArqueo',
			),
			array(
					'header'=>'Comprobante',
					'value'=>'$data->comprobante',
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-print\"></span>", array("distribuidora/comprobante","id"=>$data->idCajaArqueo))',
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("registro Diario", array("distribuidora/registroDiario","id"=>$data->idCajaArqueo))',
			),
		)
	));
?></div></div>
</div>