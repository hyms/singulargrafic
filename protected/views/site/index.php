<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<!-- slider starts
================================================== -->
<div class="body row">
  <div class="flexslider slider-text-image">
    <ul class="slides">
      
      <?php
      	foreach ($model as $banner)
      	{
      ?>
	      <li>
	        <div class="col-xs-8"><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/'.$banner->imagen)?> </div>
	        <div class="col-xs-4">
	        <?php echo $banner->texto ?>
	  		</div>
	      </li>
      <?php 
      	} 
      ?>
      
    </ul>
  </div>
</div>
<!-- slider ends
================================================== --> 
