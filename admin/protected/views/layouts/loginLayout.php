<?php
Yii::app()->clientscript

    ->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap.min.slate.css' )
    //->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap-responsive.css' )

    ->registerCoreScript( 'jquery' )
    //->registerScriptFile( Yii::app()->request->baseUrl . '/js/bootstrap.js', CClientScript::POS_END )
    ->registerScriptFile( Yii::app()->request->baseUrl . '/js/bootstrap.min.js', CClientScript::POS_END )
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<meta name="language" content="es" />
	<style type="text/css">
		.center {	text-align:center;	}
		.center form {	display:inline-block;	}
	</style>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
            <?php echo $content ?>
            </div>
        </div>
    </div>
</body>
</html>

