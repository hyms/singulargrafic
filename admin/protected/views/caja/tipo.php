<div class="col-sm-2">
<?php $this->renderPartial('menu');?>
</div>
<div class="col-sm-10">
<?php $this->renderPartial('cajaChica/menu');?>

<h2>Tipos de Movimientos</h2>
<?php echo CHtml::link('Añadir',array('caja/tipoAdd'), array('class' => 'btn btn-default') ); ?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$model,
		'ajaxUpdate'=>true,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
				array(
						'header'=>'Nro',
						'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
				),
				array(
						'header'=>'Nombre',
						'value'=>'$data->nombre',
				),
				array(
						'header'=>'estado',
						'value'=>'($data->estado)?"Activado":"Desactivado"',
				),
				array(
						'header'=>'',
						'type'=>'raw',
						'value'=>'CHtml::link("Editar",array("caja/tipoAdd","id"=>$data->idTipoMovimiento))',
				),
 		)
));
?>
</div>