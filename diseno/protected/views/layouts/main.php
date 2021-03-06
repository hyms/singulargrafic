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
                    array('label'=>'Orden de Trabajo', 'url'=>array('orden/index')),
                    array('label'=>'Reposiciones', 'url'=>array('repos/index')),
                    array('label'=>'Reportes', 'url'=>array('report/index')),
                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Logout ('.Yii::app()->user->name.') <b class="caret"></b>', 'url'=>array('#'), 'visible'=>!Yii::app()->user->isGuest,
                        'linkOptions'=> array(
                            'class' => 'dropdown-toggle',
                            'data-toggle' => 'dropdown',
                        ),
                        'itemOptions' => array('class'=>'dropdown'),
                        'items'=>array(
                            array('label'=>'Cambiar Password', 'url'=>array('/site/dates','id'=>Yii::app()->user->id)),
                            array('label'=>'Salir', 'url'=>array('/site/logout')),
                        )),
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
