<?php
Yii::app()->clientscript
// use it when you need it!
->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap.min.slate.css')
->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap-responsive.css')

->registerCoreScript( 'jquery' )
->registerScriptFile( Yii::app()->request->baseUrl . '/js/bootstrap.js', CClientScript::POS_END )

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
	<div class="row">
		<div class="col-xs-6 col-xs-offset-3">
		<?php echo $content ?>
		</div>
	</div>
</body>
</html>

