<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banners'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Update Banner <?php echo $model->id; ?></h1>

<?php $this->renderPartial('banner/_form', array('model'=>$model)); ?>