<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<!-- slider starts
================================================== -->
<section id="slider" class="body">
	
  <div class="flexslider slider-text-image">
    <ul class="slides">
      
      <!--first slide starts-->
      <li>
        <div class="col-sm-8"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/slider/slide1.jpg" alt="We build apps"> </div>
        <div class="col-sm-4">
          <h1>We Build Mobile Apps For Masses!</h1>
          <p>Our design team specializes in Information Architecture and User Interface design for Web and Mobile applications.</p>
          <a href="#" class="button medium color">View Our Work</a> </div>
      </li>
      <!--first slide ends--> 
      
      <!--second slide starts-->
      <li>
        <div class="col-sm-8"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/slider/slide2.jpg" alt="We build apps"> </div>
        <div class="col-sm-4">
          <h1>We Design Stunning Interfaces!</h1>
          <p>Our design team specializes in Information Architecture and User Interface design for Web and Mobile applications.</p>
          <a href="#" class="button medium color">Contact Us</a> </div>
      </li>
      <!--second slide ends--> 
      
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
</section>
<!-- slider ends
================================================== --> 
