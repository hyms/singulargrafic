<?php
	Yii::app()->clientscript
		// use it when you need it!
		
		->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap.min.slate.css' )
		//->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap.min.darckly.css' )
		//->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap.min.super.css' )
		->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap-responsive.css' )
		
		->registerCoreScript( 'jquery' )
		->registerScriptFile( Yii::app()->request->baseUrl . '/js/bootstrap.js', CClientScript::POS_END )
		//->registerScriptFile( Yii::app()->request->baseUrl . '/js/bootstrap.min.js', CClientScript::POS_END )
		
		//*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<meta name="language" content="es" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<div class="navbar navbar-default navbar-static-top">
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
						array('label'=>'Distribuidora', 'url'=>array('distribuidora/index')),
						array('label'=>'Imprenta', 'url'=>array('#')),
						array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
						array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
					),
				)); ?>
					
			</div><!--/.nav-collapse -->
			
		</div>
	</div>
	
	<div class="container">
		<div class="row">
			<?php echo $content ?>
		</div>
	</div>
	
</body>
</html>

