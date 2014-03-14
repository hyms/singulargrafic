<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>
<div class="body ">

	<h1>Contactenos</h1>
	
	<div class="col-sm-8">
		<div class="gmap">
	    	<img class="doksoft_maps_img" contenteditable="true" data_script="%7B%22lat%22%3A-16.498023278712793%2C%22lng%22%3A-68.13016878979488%2C%22zoom%22%3A15%2C%22type%22%3A%22roadmap%22%2C%22width%22%3A400%2C%22height%22%3A300%2C%22settings%22%3A%7B%22mapTypeControl%22%3A1%2C%22zoomControl%22%3A1%2C%22rotateControl%22%3A0%2C%22scaleControl%22%3A1%2C%22streetViewControl%22%3A0%2C%22panControl%22%3A0%2C%22overviewMapControl%22%3A0%2C%22draggable%22%3A1%2C%22disableDoubleClickZoom%22%3A0%7D%2C%22objects%22%3A%7B%22Marker%22%3A%5B%5B-16.502590997631437%2C-68.14029693603516%2C%22Hello%20World!%22%5D%2C%5B-16.49966950109571%2C-68.13111305236816%2C%22Hello%20World!%22%5D%5D%2C%22Circle%22%3A%5B%5D%2C%22Polyline%22%3A%5B%5D%2C%22Text%22%3A%5B%5D%2C%22Polygon%22%3A%5B%5D%2C%22Rectangle%22%3A%5B%5D%2C%22TrafficLayer%22%3A%5B%5D%2C%22WeatherLayer%22%3A%5B%5D%7D%7D" src="http://maps.google.com/maps/api/staticmap?center=-16.498023278712793,-68.13016878979488&amp;zoom=15&amp;size=400x300&amp;maptype=roadmap&amp;markers=-16.502590997631437,-68.14029693603516|-16.49966950109571,-68.13111305236816&amp;sensor=false">
		</div>
	</div>

<!-- map ends --> 

<!-- form -->
	<div class="col-sm-4">
    	<?php echo $model->contenido ?>
	</div>
</div>