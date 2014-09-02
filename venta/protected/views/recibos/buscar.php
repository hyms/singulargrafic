<div class="col-sm-2 hidden-print">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
	<div>
	<ul class="nav nav-tabs">
	  <li><?php echo CHtml::link("Recibos Ingreso",array("recibos/buscar","t"=>1),array("class"=>"hidden-print")) ?></li>
	  <li><?php echo CHtml::link("Recibos Egreso",array("recibos/buscar","t"=>0),array("class"=>"hidden-print")) ?></li>
	</ul>
	</div>
	<div>
	<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$recibos->search(),
		'filter'=>$recibos,
		'ajaxUpdate'=>true,
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
					'value'=>'CHtml::link("Modificar",array(($data->tipoRecivo==1)?"caja/reciboIngreso":"caja/reciboEgreso","id"=>$data->idRecibos),array("class"=>"hidden-print"))',
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("Imprimir",array("caja/preview","id"=>$data->idRecibos),array("class"=>"hidden-print"))',
			),
		)
	));
?>
	</div>
	
</div>