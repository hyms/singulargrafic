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
      
      
      <!--third slide starts-->
      <li>
        <div class="col-sm-8"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/slider/slide3.jpg" alt="We build apps"> </div>
        <div class="col-sm-4">
          <h1>We Build Rock Solid Applications!</h1>
          <p>Our work always adhere to the latest trends and standards. We create complex web apps and on time ALWAYS!</p>
        </div>
      </li>
      <!--third slide ends-->
      
    </ul>
  </div>
</div>
</section>
<!-- slider ends
================================================== --> 
