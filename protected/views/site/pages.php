<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name .' - '. $model->nombre;

?>
<section class=" content dark clearfix conteiner ">
	<div class="body">
		<?php echo $model->contenido ?>
	</div>
</section>
