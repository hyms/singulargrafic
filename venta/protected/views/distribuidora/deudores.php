<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$deudores,
		'ajaxUpdate'=>true,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
				array(
						'header'=>'Nro',
						'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
				),
				array(
						'header'=>'Nombre y Apellido',
						'value'=>'$data->idCliente0->nombre." ".$data->idCliente0->apellido',
				),
				array(
						'header'=>'Saldo',
						'value'=>'$data->montoVenta - $data->montoPagado',
				),
				array(
						'header'=>'FechaPlazo',
						'value'=>'date("d-m-Y",strtotime($data->fechaPlazo))',
				),
				array(
						'header'=>'',
						'type'=>'raw',
						'value'=>'CHtml::link("cancelar",array("caja/deuda","id"=>$data->idVenta,"serv"=>"nv"))',
				),
		)
)); 
?>
</div>