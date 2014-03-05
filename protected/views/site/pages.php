<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name .' - '. $model->nombre;

?>
<section class="content dark container clearfix body">
	<p>
		<?php echo $model->contenido ?>
	</p>
</section>
