<div class="col-sm-2">
<?php $this->renderPartial('menu');?>
</div>
<div class="col-sm-10">
<h2>Usuarios</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$users,
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
					'value'=>'$data->username',
			),
			array(
					'header'=>'Tipo de Usuario',
					'value'=>'(($data->tipo==1)?"admin":(($data->tipo==2)?"Administracion":(($data->tipo==3)?"Ventas":"Diseño")))',
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("Añadir",array("#","id"=>$data->idUser))',
			),
		)
	));
?>
</div>