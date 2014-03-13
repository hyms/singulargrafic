<?php
	Yii::app()->clientscript
		// use it when you need it!
		
		->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap.css' )
		->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap-responsive.css' )
		//->registerCssFile( Yii::app()->request->baseUrl . '/css/uploadify.css' )
		->registerCoreScript( 'jquery' )
		->registerScriptFile( Yii::app()->request->baseUrl . '/js/bootstrap.js', CClientScript::POS_END )
		//->registerScriptFile( Yii::app()->request->baseUrl . '/js/bootstrap.min.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->baseUrl.'/js/ckeditor/ckeditor.js')
		//->registerScriptFile( Yii::app()->baseUrl.'/js/uploadify/jquery.uploadify.js')
		//*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<meta name="language" content="es" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<div class="navbar navbar-inverse navbar-static-top">
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
						//menu webpage
						array('label'=>'Pagina Web <b class="caret"></b>', 'url'=>array('#'),
						'linkOptions'=> array(
                       		'class' => 'dropdown-toggle',
                            'data-toggle' => 'dropdown',
                      	),
						'itemOptions' => array('class'=>'dropdown'),
						'items'=>array(
							array('label'=>'Banner', 'url'=>array('webpage/banner')),
							array('label'=>'Paginas', 'url'=>array('webpage/pages')),
						)),
						array('label'=>'Empresa <b class="caret"></b>', 'url'=>array('#'),
							'linkOptions'=> array(
									'class' => 'dropdown-toggle',
									'data-toggle' => 'dropdown',
							),
							'itemOptions' => array('class'=>'dropdown'),
							'items'=>array(
								array('label'=>'Sucursales', 'url'=>array('empresa/sucursal')),
								array('label'=>'Empleados', 'url'=>array('empresa/empleado')),
								array('label'=>'Servicios', 'url'=>array('empresa/servicios')),
						)),

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
