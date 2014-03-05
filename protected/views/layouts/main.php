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
	<link rel="stylesheet" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" />
	<link rel="stylesheet" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/css/flexslider.css" />
	<!--<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fancybox.css" type="text/css" media="screen" /> -->
	<!--<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.css" type="text/css" media="screen" /> -->
	<!--<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/colors/light.css" type="text/css" media="screen" /> -->
	
	<!--[if IE 7]>
	  	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome-ie7.css">
	  <![endif]-->
	
	<!--jquery libraries / others are at the bottom-->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.js" type="text/javascript"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js" type="text/javascript"></script>
</head>
<body >
<div class="background">
<!-- header starts
================================================== -->
<section id="header" class="container clearfix">
	<div class="logo">
		<a class="page" href="#">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Objetointeligentevec.png" alt="<?php echo CHtml::encode(Yii::app()->name); ?>">
		</a>
	</div>
	<div class="Impresionacontusidea">
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Impresionacontusidea.png" alt="<?php echo CHtml::encode(Yii::app()->name); ?>">	
	</div>
	<div class="menu navbar navbar-static-top">
	<div class="container">
	<div class="collapse navbar-collapse">
		<nav class="mainNav">
	    	<ul>
	        	<?php $this->widget('zii.widgets.CMenu',array(
	        		'htmlOptions' => array('class' => 'nav navbar-nav'),
		        	'items'=>array(
					array('label'=>'Home', 'url'=>array('/site/index'),'linkOptions'=> array('class' => 'bottonmenu')),
					array('label'=>'Imprenta/Cotizaciones', 'url'=>array('/site/imprenta'),'linkOptions'=> array('class' => 'bottonmenu')),
					array('label'=>'Servicio CTP', 'url'=>array('/site/ctp'),'linkOptions'=> array('class' => 'bottonmenu')),
					array('label'=>'Editorial', 'url'=>array('/site/editorial'),'linkOptions'=> array('class' => 'bottonmenu')),
					array('label'=>'Distribuidora de Papel', 'url'=>array('/site/distribuidora'),'linkOptions'=> array('class' => 'bottonmenu')),
					array('label'=>'Contactos', 'url'=>array('/site/contact'),'linkOptions'=> array('class' => 'bottonmenu')),
					),
				)); ?>
	      	</ul>
	  	</nav>
	</div>
	</div>
	</div>
</section>
<!-- header ends
================================================== --> 
	
	
	<?php echo $content; ?>
	

<!-- copyright starts
================================================== -->
<section id="copyright" class="footer">
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

</div>

<!--other jqueries required--> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.flexslider-min.js" type="text/javascript"></script> 
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
