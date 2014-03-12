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
	    	<iframe width="500px"  height="300px" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Ocean&amp;sll=37.0625,-95.677068&amp;sspn=36.452734,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Ocean,+New+Jersey&amp;t=m&amp;z=9&amp;ll=39.965255,-74.311821&amp;output=embed"></iframe>
		</div>
	</div>

<!-- map ends --> 

<!-- form -->
	<div class="col-sm-4">
    	<?php echo $model->contenido ?>
	</div>
</div>