<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<!-- slider starts
================================================== -->
<section id="slider" >
<div class="body">
  <div class="flexslider slider-text-image">
    <ul class="slides">
      
      <?php
      	foreach ($model as $banner)
      	{
      ?>
	      <li>
	        <div class="col-sm-8"><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/'.$banner->imagen)?> </div>
	        <div class="col-sm-4">
	        <?php echo $banner->texto ?>
	  		</div>
	      </li>
      <?php 
      	} 
      ?>
      
    </ul>
  </div>
</div>
</section>
<!-- slider ends
================================================== --> 
