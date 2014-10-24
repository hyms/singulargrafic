<?php
Yii::app()->clientscript

    ->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap.min.slate.css' )
    ->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap-responsive.css' )

    ->registerCoreScript( 'jquery' )
    //->registerScriptFile( Yii::app()->request->baseUrl . '/js/bootstrap.js', CClientScript::POS_END )
    ->registerScriptFile( Yii::app()->request->baseUrl . '/js/bootstrap.min.js', CClientScript::POS_END )
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="es" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<div class="navbar navbar-default">
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
                        array('label'=>'Reportes <b class="caret"></b>', 'url'=>array('#'),
                            'linkOptions'=> array(
                            'class' => 'dropdown-toggle',
                            'data-toggle' => 'dropdown',
                            ),
                            'itemOptions' => array('class'=>'dropdown'),
                            'items'=>array(
                                array('label'=>'Ventas de Dsitribuidora', 'url'=>array('distribuidora/report')),
                                //array('label'=>'Ordenes CTP', 'url'=>array('#')),
                                //array('label'=>'Imprenta', 'url'=>array('#')),
                                array('label'=>'Reporte de Productos', 'url'=>array('report/producto')),
                            )),
                        array('label'=>'Personas <b class="caret"></b>', 'url'=>array('#'),
                            'linkOptions'=> array(
                                'class' => 'dropdown-toggle',
                                'data-toggle' => 'dropdown',
                            ),
                            'itemOptions' => array('class'=>'dropdown'),
                            'items'=>array(
                                array('label'=>'Clientes', 'url'=>array('cliente/index')),
                                array('label'=>'Empleados', 'url'=>array('empleado/index')),
                            )),
                        array('label'=>'Productos <b class="caret"></b>', 'url'=>array('#'),
                            'linkOptions'=> array(
                                'class' => 'dropdown-toggle',
                                'data-toggle' => 'dropdown',
                            ),
                            'itemOptions' => array('class'=>'dropdown'),
                            'items'=>array(
                                array('label'=>'Productos', 'url'=>array('productos/index')),
                                array('label'=>'Stocks', 'url'=>array('stock/index')),
                            )),
                        array('label'=>'Contabilidad <b class="caret"></b>', 'url'=>array('#'),
                            'linkOptions'=> array(
                                'class' => 'dropdown-toggle',
                                'data-toggle' => 'dropdown',
                            ),
                            'itemOptions' => array('class'=>'dropdown'),
                            'items'=>array(
                                array('label'=>'Costos', 'url'=>array('contabilidad/index')),
                            )),
                        array('label'=>'Configuracion', 'url'=>array('configuration/index')),
						/*array('label'=>'Pagina Web <b class="caret"></b>', 'url'=>array('#'),
							'linkOptions'=> array(
								'class' => 'dropdown-toggle',
								'data-toggle' => 'dropdown',
							),
							'itemOptions' => array('class'=>'dropdown'),
							'items'=>array(
								array('label'=>'Banner', 'url'=>array('webpage/banner')),
								array('label'=>'Paginas', 'url'=>array('webpage/pages')),
						)),
						*/
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
