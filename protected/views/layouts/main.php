<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/img/icons/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/img/icons/apple-touch-icon.png">
	<!--style sheet-->
	<!-- <link rel="stylesheet" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/css/facebook-framework.css" /> -->
	<link rel="stylesheet" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css" />
	<!--<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/flexslider.css" type="text/css" media="screen" /> -->
	<!--<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fancybox.css" type="text/css" media="screen" /> -->
	<!--<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.css" type="text/css" media="screen" /> -->
	<!--<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/colors/light.css" type="text/css" media="screen" /> -->
	
	<!--[if IE 7]>
	  	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome-ie7.css">
	  <![endif]-->
	
	<!--jquery libraries / others are at the bottom-->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.js" type="text/javascript"></script>
</head>
<body>

<!-- header starts
================================================== -->
<section id="header" class="container clearfix">
	<div class="span12">
		<nav class="mainNav">
	    	<ul>
	        	<li class="logo"><a class="page" href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png" width="83" height="22" alt="<?php echo CHtml::encode(Yii::app()->name); ?>"></a></li>
	        		<?php $this->widget('zii.widgets.CMenu',array(
	        			'activeCssClass'	=> 'page selected',
		        		'items'=>array(
						array('label'=>'Home', 'url'=>array('/site/index'),'linkOptions'=> array('class' => 'page')),
						array('label'=>'Imprenta/Cotizaciones', 'url'=>array('/site/page', 'view'=>'imprenta','linkOptions'=> array('class' => 'page'))),
						array('label'=>'Servicio CTP', 'url'=>array('/site/page', 'view'=>'ctp','linkOptions'=> array('class' => 'page'))),
						array('label'=>'Editorial', 'url'=>array('/site/page', 'view'=>'editorial','linkOptions'=> array('class' => 'page'))),
						array('label'=>'Distribuidora de Papel', 'url'=>array('/site/page', 'view'=>'distribuidora','linkOptions'=> array('class' => 'page'))),
						array('label'=>'Contactos', 'url'=>array('/site/contact'),'linkOptions'=> array('class' => 'page')),
						),
					)); ?>
	      	</ul>
	  	</nav>
	</div>
</section>
<!-- header ends
================================================== --> 
	
	
	<?php echo $content; ?>

	
<!-- footer starts
================================================== -->
<section id="footer" class="container clearfix"> 
  
  <!--first column starts-->
  <div class="span4">
    <h5>What our clients say!</h5>
    <div class="flexslider slider-testimonial">
      <ul class="slides">
        
        <!--first testimonial starts-->
        <li>
          <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. </p>
          <h6>Saif<span>Owner, Greepit.com</span></h6>
        </li>
        <!--first testimonial ends--> 
        
        <!--second testimonial starts-->
        <li>
          <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. </p>
          <h6>Shahbaz <span>Owner eGrappler.com</span></h6>
        </li>
        <!--second testimonial ends--> 
        
        <!--third testimonial starts-->
        <li>
          <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
          <h6><span>Owner Themesforce.com</span></h6>
        </li>
        <!--third testimonial ends-->
        
      </ul>
    </div>
  </div>
  <!--first column ends--> 
  
  <!--second column starts-->
  <div class="span4">
    <h5>Flickr Feed</h5>
    <div class="flickr-feed"> 
      <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=8&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=89593078@N02"></script> 
    </div>
  </div>
  <!--second column ends--> 
  
  <!--third column starts-->
  <div class="span4">
    <h5>Newsletter Signup</h5>
    <p>Molestie consequat, vel illum dolore feugiat facilisis blandit praesent luptatum eroset.</p>
    <form  id="subform" method="post" action="#">
      <fieldset>
        <p>
          <input name="email"  class="required email noborder" type="text" placeholder="Email Address">
          <input type="submit" value="Go" class="button small color"/>
        </p>
        <div class="clearfix"></div>
        <div id="subresult"></div>
      </fieldset>
    </form>
  </div>
  <!--third column ends--> 
  
</section>
<!-- footer ends
================================================== --> 
<!-- copyright starts
================================================== -->
<section id="copyright" class="container clearfix">
  <div class="span12">
    <p>©HFCT. All Rights Reserved. </p>
    <ul class="social">
      <li class="facebook"><a href="#">facebook</a></li>
      <li class="twitter"><a href="#">twitter</a></li>
      <li class="skype"><a href="#">Skype</a></li>
      <li class="email"><a href="#">flickr</a></li>
    </ul>
  </div>
</section>
<!-- copyright ends
================================================== --> 
<!--other jqueries required--> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.flexslider-min.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.form.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.easing.1.3.js" type="text/javascript"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.adipoli.min.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.fancybox-1.3.4.pack.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.isotope.min.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/contact.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.als1.min.js" type="text/javascript"></script> 
<script type="text/javascript">
	$(document).ready(function() 
	{
		$("#lista1").als({
			visible_items: 4,
			scrolling_items: 2,
			orientation: "horizontal",
			circular: "yes",
			autoscroll: "no",
			interval: 5000,
			direction: "right"
		});
	});
</script>

</body>
</html>
