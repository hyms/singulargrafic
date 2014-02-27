<?php
	Yii::app()->clientscript
		// use it when you need it!
		
		->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap.css' )
		->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap-responsive.css' )
		->registerCoreScript( 'jquery' )
		->registerScriptFile( Yii::app()->request->baseUrl . '/js/bootstrap.js', CClientScript::POS_END )
		//->registerScriptFile( Yii::app()->request->baseUrl . '/js/bootstrap.min.js', CClientScript::POS_END )
		//*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<meta name="language" content="en" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="navbar-brand" href="#"><?php echo Yii::app()->name ?></a>
			</div>
			<div class="collapse navbar-collapse">
				<?php $this->widget('zii.widgets.CMenu',array(
					'htmlOptions' => array('class' => 'nav navbar-nav'),
					'activeCssClass'	=> 'active',
					'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
					'encodeLabel' => false,
					'items'=>array(
						array('label'=>'Home', 'url'=>array('/site/index')),
						array('label'=>'WebPage <b class="caret"></b>', 'url'=>array('#'),
						'linkOptions'=> array(
                       		'class' => 'dropdown-toggle',
                            'data-toggle' => 'dropdown',
                      	),
						'itemOptions' => array('class'=>'dropdown'),
						'items'=>array(
							array('label'=>'Banner', 'url'=>array('#')),
							array('label'=>'Paginas', 'url'=>array('/webpage/pages')),
							array('label'=>'Footer', 'url'=>array('#')),
						)),
						array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
						array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
					),
				)); ?>
					
			</div><!--/.nav-collapse -->
			
		</div>
	</div>
	
	<div class="container">
	<?php echo $content ?>
	</div>
	
		
	<div class="footer">
	  <div class="container">
		<div class="row" id="label">
			By Helier Cortez
		</div> <!-- /row -->
	  </div> <!-- /container -->
	</div>
	
	
</body>
</html>
