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

));
?>
