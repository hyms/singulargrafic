<?php
/* @var $this BannerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Banners',
);

$this->menu=array(
	array('label'=>'Create Banner', 'url'=>array('create')),
	array('label'=>'Manage Banner', 'url'=>array('admin')),
);
?>

<h1>Banners</h1>

<?php echo CHtml::link('Añadir',array('webpage/bannerCreate'), array('class' => 'btn btn-default') ); ?>


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
		array(
    		'name'=>'imagen',
       		'type'=>'raw',
       		'value'=>'CHtml::image(Yii::app()->request->baseUrl."/images/banner/".$data->imagen,"imagen banner",array("width"=>"200px","class"=>"img-thumbnail"))'
      	),
		array(
    		'name'=>'texto',
        	'type'=>'raw',
        	'value'=>'"<div style=\"height: 130px; overflow:overlay;\">".$data->texto."</div>"',
			//'htmlOptions'=>array('style'=>'height: 100px; overflow:hidden;'),
      	),
		'fecha',
		'order',
		array(
			'name'=>'',
			'type'=>'raw',
			'value'=>'CHtml::link("Editar",array("webpage/bannerUpdate","id"=>$data->id))'
		),
		array(
			'name'=>'',
			'type'=>'raw',
			'value'=>'CHtml::link("Eliminar",array("webpage/bannerDelete","id"=>$data->id),array("confirm" => "Esta seguro de Eliminarlo?"))'
		),
		//'viewButtonImageUrl' => 'view',
		//'updateButtonImageUrl' => Yii::app()->baseUrl . '/css/gridViewStyle/images/' . 'gr-update.png',
		//'deleteButtonImageUrl' => Yii::app()->baseUrl . '/css/gridViewStyle/images/' . 'gr-delete.png',

	)
));
?>
