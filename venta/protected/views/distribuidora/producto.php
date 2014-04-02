<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productos->searchAll(),
	'filter'=>$productos,
	'ajaxUpdate'=>true,
	'itemsCssClass' => 'table table-hover table-condensed',
	'htmlOptions' => array('class' => 'table-responsive'),
	'columns'=>array(
		
		array(
			'header'=>'#',
			'value'=>'$row+1',       //  row is zero based
		),
		array(
			'name'=>'codigo',
			'value'=>'$data->codigo',
			'filter'=>CHtml::activeTextField($productos, 'codigo',array("class"=>"form-control input-sm")),
		),
		array(
			'name'=>'material',
			'value'=>'$data->Material->nombre',
			'filter'=>CHtml::listData(Material::model()->findAll(array('order'=>'nombre')),'id','nombre'),
		),
		
		array(
			'name'=>'color',
			'value'=>'$data->Color->nombre',
			'filter'=>CHtml::listData(Color::model()->findAll(array('order'=>'nombre')),'id','nombre'),
			//'filter'=>CHtml::activeTextField($productos, 'color'),
		),
		array(
			'name'=>'peso',
			'value'=>'$data->peso',
			'filter'=>CHtml::listData(Producto::model()->findAll(array('select'=>'peso','order'=>'peso','group'=>'peso')),'peso','peso'),
		),
		array(
			'name'=>'dimension',
			'value'=>'$data->dimension',
			'filter'=>CHtml::listData(Producto::model()->findAll(array('select'=>'dimension','order'=>'dimension','group'=>'dimension')),'dimension','dimension'),
		),
		array(
			'name'=>'procedencia',
			'value'=>'$data->procedencia',
			'filter'=>CHtml::listData(Producto::model()->findAll(array('select'=>'procedencia','order'=>'procedencia','group'=>'procedencia')),'procedencia','procedencia'),
		),
		array(
			'name'=>'industria',
			'value'=>'$data->Industria->nombre',
			'filter'=>CHtml::listData(Industria::model()->findAll(array('order'=>'nombre')),'id','nombre'),
		),
		array(
			'header'=>'stock Unidad',
			'value'=>'$data->Almacen->stockUnidad',
		),
		array(
			'header'=>'stock Paquete',
			'value'=>'$data->Almacen->stockPaquete',
		),
		
		array(
			'header'=>'',
			'type'=>'raw',
			'value'=>'CHtml::link("Añadir",array("distribuidora/newRow","al"=>$data->Almacen->id),array("id"=>"add-sell"))'
		),
		/*array(
			'name'=>'',
			'type'=>'raw',
			'value'=>'CHtml::link("Eliminar",array("almacen/delete","id"=>$data->id),array("confirm" => "Esta seguro de Eliminarlo?"))'
		),*/
		
	)
)); 
?>
<?php $url_action = CHtml::normalizeUrl(array('/distribuidora/addDetalle')); ?>
<?php Yii::app()->clientScript->registerScript(__CLASS__.'#'.$this->id,
"
	$(\"#add-sell\").click(function(event){
		event.preventDefault();
		var input = $(\"#yw3 tbody:first\");
		var index = input.find(\".tabular-input-index\").length>=0 ? input.find(\".tabular-input-index\").max()+1 : 0;
		$.ajax({
			success: function(html){
				input.append('<tr class=\"tabular-input\">'+html+'{$this->getRemoveLinkAndIndexInput("'+index+'")}</tr>');
				input.siblings('.tabular-header').show();
			},
			type: 'get',
			url: '{$url_action}',
			data: {
				index: index
			},
			cache: false,
			dataType: 'html'
		});
	});
	
",CClientScript::POS_READY);//*/ ?>
