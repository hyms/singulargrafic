<div class="col-sm-2">
<?php $this->renderPartial('menu');?>
</div>
<div class="col-sm-10">
<?php $this->renderPartial('cajaChica/menu');?>
<h2>Cajas Chicas</h2>
<?php echo CHtml::link('Añadir',array('caja/chicasAdd'), array('class' => 'btn btn-default') ); ?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$cajaChica,
		'ajaxUpdate'=>true,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
				array(
						'header'=>'Nro',
						'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
				),
				array(
						'header'=>'Detalle',
						'value'=>'$data->detalle',
				),
				array(
						'header'=>'Asignado',
						'value'=>'$data->idUser0->username',
				),
				array(
						'header'=>'Saldo',
						'value'=>'$data->saldo',
				),
				array(
						'header'=>'',
						'type'=>'raw',
						'value'=>'CHtml::link("Editar",array("caja/chicasAdd","id"=>$data->idcajaChica))',
				),
				array(
						'header'=>'',
						'type'=>'raw',
						'value'=>'CHtml::link("Asignar Tipo de Movimientos",array("caja/tipoChica","id"=>$data->idcajaChica))',
				),
 		)
));
?>
</div>