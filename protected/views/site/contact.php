<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>
<section class="content dark container clearfix">
	<h1>Contact Us</h1>
	
  <div class="span12">
    <p class="white MB20">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
    <div class="gmap">
      <iframe width="774px"  height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Ocean&amp;sll=37.0625,-95.677068&amp;sspn=36.452734,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Ocean,+New+Jersey&amp;t=m&amp;z=9&amp;ll=39.965255,-74.311821&amp;output=embed"></iframe>
    </div>
  </div>
</section>
<!-- map ends --> 

<!-- form -->
<section class="content dark container clearfix">
  <div class="span12">
    <h2>Reach <span class="meta">Us</span></h2>
  </div>
  <div class="span12">
    <form id="contact-form" accept-charset="utf-8" action="" method="post" class="contactpage">
      <div id="output" class="successMessage">Email sent!</div>
      <fieldset>
        <div class="">
          <p>
            <input class="w239 MR10" name="name" id="name" type="text" value="" placeholder="Name">
          </p>
          <p>
            <input class="w239"  name="eamil" id="email" type="text" value="" placeholder="Your Email">
          </p>
        </div>
        <!-- /userDetails -->
        <div class="fieldcomp inquiry">
          <p>
            <textarea class="ctext"  id="message" name="message" placeholder="Message"></textarea>
          </p>
        </div>
        <!-- /inquiry -->
      </fieldset>
      <div class="submitCont">
        <input type="submit" value="Send" id="send" class="button medium color">
      </div>
      <!-- /submitCont -->
    </form>
  </div>
  

</section>