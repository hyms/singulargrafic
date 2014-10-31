<?php
	Yii::app()->clientscript
		// use it when you need it!
		->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap.min.css' )
		//->registerCssFile( Yii::app()->request->baseUrl . '/css/normalize.css')
		//->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap-responsive.css')
		//->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap.min.slate.css')
		//->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap-theme.min.css')
		->registerCoreScript( 'jquery' )
		->registerScriptFile( Yii::app()->request->baseUrl . '/js/bootstrap.min.js', CClientScript::POS_END )
		
		//*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<meta name="language" content="es" />
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<div class="container">
		<div class="row">
			<?php echo $content ?>
		</div>
	</div>
	
</body>
</html>

