<div>

</div>



<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'itemsCssClass' => 'table table-hover table-condensed',
	'htmlOptions' => array('class' => 'table-responsive'),
	'columns'=>array(
		
		array(
			'header'=>'#',
			'value'=>'$row+1',       //  row is zero based
		),
		'codigo',
		array(
			'name'=>'Material',
			'type'=>'raw',
			'value'=>'$data->Material->nombre'
		),
		array(
			'name'=>'Detalle del Producto',
			'type'=>'raw',
			'value'=>'$data->Color->nombre." ".$data->peso." ".$data->dimension.", ".$data->procedencia'
		),
		array(
			'name'=>'Precio S/F',
			'type'=>'raw',
			'value'=>'$data->costoSF."/".$data->costoSFUnidad'
		),
		array(
			'name'=>'Precio C/F',
			'type'=>'raw',
			'value'=>'$data->costoCF."/".$data->costoCFUnidad'
		),
		array(
			'name'=>'Industria',
			'type'=>'raw',
			'value'=>'$data->Industria->nombre'
		),
		array(
			'name'=>'Cant X Paqt',
			'type'=>'raw',
			'value'=>'$data->cantidad'
		),
		
		//'viewButtonImageUrl' => 'view',
		//'updateButtonImageUrl' => Yii::app()->baseUrl . '/css/gridViewStyle/images/' . 'gr-update.png',
		//'deleteButtonImageUrl' => Yii::app()->baseUrl . '/css/gridViewStyle/images/' . 'gr-delete.png',

	)
));
?>
