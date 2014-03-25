<?php
	$cs =Yii::app()->clientscript;
	
	$cs->scriptMap = array(
			'jquery.js' => Yii::app()->request->baseUrl.'/js/jquery-1.11.0.js',
			'jquery.yii.js' => Yii::app()->request->baseUrl.'/js/jquery-1.11.0.min.js',
	);
		// use it when you need it!
		$cs->registerCssFile( Yii::app()->request->baseUrl . '/css/spectrum.css')
		->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap.css' )
		->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap-responsive.css' )
		
		->registerCoreScript('jquery')
		->registerCoreScript('jquery.ui')
		
		->registerScriptFile( Yii::app()->request->baseUrl . '/js/spectrum.js')
		//->registerScriptFile( Yii::app()->request->baseUrl . '/js/bootstrap.js')
		->registerScriptFile( Yii::app()->request->baseUrl . '/js/bootstrap.min.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->baseUrl.'/js/ckeditor/ckeditor.js');
		
		
		//->registerScriptFile( Yii::app()->baseUrl.'/js/uploadify/jquery.uploadify.js')
		//*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="es" />
	
	
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
								array('label'=>'Clientes', 'url'=>array('empresa/cliente')),
								array('label'=>'Proveedores', 'url'=>array('empresa/proveedor')),
						)),
						
						array('label'=>'Productos <b class="caret"></b>', 'url'=>array('#'),
							'linkOptions'=> array(
								'class' => 'dropdown-toggle',
								'data-toggle' => 'dropdown',
							),
							'itemOptions' => array('class'=>'dropdown'),
							'items'=>array(
								array('label'=>'Productos', 'url'=>array('producto/index')),
								array('label'=>'Materiales', 'url'=>array('producto/material')),
								array('label'=>'Colores', 'url'=>array('producto/color')),
								array('label'=>'Industrias', 'url'=>array('producto/industria')),								
						)),
						array('label'=>'Almacen <b class="caret"></b>', 'url'=>array('#'),
							'linkOptions'=> array(
									'class' => 'dropdown-toggle',
									'data-toggle' => 'dropdown',
							),
							'itemOptions' => array('class'=>'dropdown'),
							'items'=>array(
									array('label'=>'Almacenes', 'url'=>array('almacen/index')),
									array('label'=>'Tipo de Almacen', 'url'=>array('almacen/tipoAlmacen')),
									array('label'=>'Añadir/Reducir Stock', 'url'=>array('almacen/add_reduce')),
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
