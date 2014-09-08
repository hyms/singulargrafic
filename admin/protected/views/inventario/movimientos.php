<h1>Movimientos de Alamacenes</h1>
<div class="col-sm-2">
<?php echo CHtml::link('Dercargar Excel',array('inventario/movimientos','excel'=>true), array('class' => 'btn btn-link') ); ?>
</div>
<div class="col-sm-10">
<?php $form=$this->beginWidget('CActiveForm', array(
		'method' => 'get',
	    'id'=>'extended-filters',
		'htmlOptions'=>array(
				'class'=>'form-horizontal',
				'role'=>'form'
		),
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// See class documentation of CActiveForm for details on this,
		// you need to use the performAjaxValidation()-method described there.
		'enableAjaxValidation'=>false,
)); ?>
<div class="form-group">
<b class="col-sm-1">From :</b>
<div class="col-sm-5">
<div class="col-sm-5">
	<b clas>De :</b>
<?php 
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'start_date',
						'attribute'=>'start_date',
						'language'=>'es',
						'model'=>$movimientos,
						'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>'yy-mm-dd',
						),
						'htmlOptions'=>array(
								'class'=>'form-control input-sm col-sm-10',
						),
				))
?>
</div>
<div class="col-sm-5">
<b>A :</b>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'end_date',
						'attribute'=>'end_date',
						'language'=>'es',
						'model'=>$movimientos,
						'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>'yy-mm-dd',
						),
						'htmlOptions'=>array(
								'class'=>'form-control input-sm col-sm-10',
						),
				));
/*$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'end_date',
						'attribute'=>'end_date',
						'language'=>'es',
						'model'=>$movimientos,
						'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>'yy-mm',
						),
						'htmlOptions'=>array(
								'class'=>'form-control input-sm col-sm-10',
						),
				));*/
?>
</div>
<?php echo CHtml::submitButton('Go',array('class'=>'btn btn-default')); ?> 
</div></div>
</div>
<?php	
	
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$movimientos->searchReporte(),
	'filter'=>$movimientos,
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
				'value'=>'$data->idProducto0->codigo',
				'filter'=>CHtml::activeTextField($movimientos, 'codigo',array("class"=>"form-control")),
		),
		array(
				'header'=>'Material',
				'value'=>'$data->idProducto0->material',
				'filter'=>CHtml::activeDropDownList($movimientos,'material',CHtml::listData(Producto::model()->with('almacenProductos')->findAll(array('group'=>'material','select'=>'material','condition'=>'idAlmacen=1')),'material','material'),array("class"=>"form-control ",'empty'=>'')),
		),
		array(
				'header'=>'color',
				'value'=>'$data->idProducto0->color',
				'filter'=>CHtml::activeTextField($movimientos, 'color',array("class"=>"form-control")),
		),
		array(
				'header'=>'Detalle Producto',
				'value'=>'$data->idProducto0->detalle',
				'filter'=>CHtml::activeTextField($movimientos, 'detalle',array("class"=>"form-control")),
		),
		array(
				'header'=>'Industria',
				'value'=>'$data->idProducto0->industria'
		),
		array(
				'header'=>'De',
				'value'=>'(!empty($data->idAlmacenOrigen0))?$data->idAlmacenOrigen0->nombre:""',
				'filter'=>CHtml::activeDropDownList($movimientos,'origen',CHtml::listData(Almacen::model()->findAll(),'nombre','nombre'),array("class"=>"form-control ",'empty'=>'')),
		),
		array(
				'header'=>'A',
				'value'=>'(!empty($data->idAlmacenDestino0->nombre))?$data->idAlmacenDestino0->nombre:""',
				'filter'=>CHtml::activeDropDownList($movimientos,'destino',CHtml::listData(Almacen::model()->findAll(),'nombre','nombre'),array("class"=>"form-control ",'empty'=>'')),
		),
		array(
				'header'=>'Cant. Unidad',
				'value'=>'$data->cantidadU'
		),
		array(
				'header'=>'Cant. Paquete',
				'value'=>'$data->cantidadP'
		),
		array(
				'header'=>'Fecha',
				'value'=>'$data->fechaMovimiento',
		),
	)
	));
?>
<?php $this->endWidget(); ?>