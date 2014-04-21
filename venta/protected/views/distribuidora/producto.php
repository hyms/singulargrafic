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
			'type'=>'raw',
			'value'=>'$data->Color->nombre." <div style=\"background-color:".$data->Color->codigo."\" with=\"5px\">&nbsp</div>"',
			'filter'=>CHtml::listData(Color::model()->findAll(array('order'=>'nombre')),'id','nombre'),
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
			'header'=>'Precio con Fac.',
			'value'=>'$data->costoCFUnidad."/".$data->costoCF',
		),
		array(
			'header'=>'Precio sin Fac.',
			'value'=>'$data->costoSFUnidad."/".$data->costoSF',
		),
		array(
			'header'=>'cantidad',
			'value'=>'$data->cantidad',
			//'filter'=>CHtml::activeTextField($productos, 'cantidad',array("class"=>"form-control input-sm")),
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
			//'value'=>'CHtml::link("Añadir",array("distribuidora/newRow","al"=>$data->Almacen->id),array("id"=>"add-sell"))'
			'value'=>'CHtml::link("Añadir","#",array("onclick"=>\'newRow("\'.$data->Almacen->id.\'");\'))',
		),
		
	)
)); 
?>

<?php Yii::app()->clientScript->registerScript('row',"

function newRow(almacen)
{
	
	var input = $(\"#yw3 tbody\");
	var index = 0;
	var factura = $('#Venta_tipoPago_0').attr('checked')?0:1;
	if(input.find(\".tabular-input-index\").length>0)
	{
		$(\".tabular-input-index\").each(function() {
		    index = Math.max(index, parseInt(this.value)) + 1;
		});
	}		
	$.ajax({
		type: 'GET',
		url: '".CHtml::normalizeUrl(array('/distribuidora/addDetalle'))."',
		data: 'index='+index+'&al='+almacen+'&factura='+factura,
		dataType: 'html',
		success: function(html){
			input.append(html);
			input.siblings('.tabular-header').show();
		},
		
	});
	event.preventDefault();
}

",CClientScript::POS_HEAD); ?>