<?php
	$cs =Yii::app()->clientscript;
	
	$cs->scriptMap = array(
			'jquery.js' => Yii::app()->request->baseUrl.'/js/jquery-1.11.0.js',
			'jquery.yii.js' => Yii::app()->request->baseUrl.'/js/jquery-1.11.0.min.js',
	);
		// use it when you need it!
	$cs
		->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap.css' )
		->registerCssFile( Yii::app()->request->baseUrl . '/css/bootstrap-responsive.css' )
		
		->registerCoreScript('jquery')
		->registerCoreScript('jquery.ui')
		
		->registerScriptFile( Yii::app()->request->baseUrl . '/js/bootstrap.min.js', CClientScript::POS_END )
		;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="es" />
	
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<div class="navbar navbar-inverse ">
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
						/*
						array('label'=>'Empleados', 'url'=>array('empleado/index')),
						array('label'=>'Clientes', 'url'=>array('cliente/index')),
						array('label'=>'Administracion <b class="caret"></b>', 'url'=>array('#'),
							'linkOptions'=> array(
								'class' => 'dropdown-toggle',
								'data-toggle' => 'dropdown',
							),
							'itemOptions' => array('class'=>'dropdown'),
							'items'=>array(
								array('label'=>'Inventario Gral', 'url'=>array('inventario/index')),
								array('label'=>'Movimientos Almacenes', 'url'=>array('inventario/movimientos')),
								array('label'=>'Cajas y Libro Mayor', 'url'=>array('caja/')),
								array('label'=>'Recibos', 'url'=>array('#')),
						)),
						array('label'=>'Stocks <b class="caret"></b>', 'url'=>array('#'),
							'linkOptions'=> array(
								'class' => 'dropdown-toggle',
								'data-toggle' => 'dropdown',
							),
							'itemOptions' => array('class'=>'dropdown'),
							'items'=>array(
								array('label'=>'Pre-Prensa CTP', 'url'=>array('stock/ctp')),
								array('label'=>'Distribuidora', 'url'=>array('stock/distribuidora')),
								array('label'=>'Imprenta', 'url'=>array('#')),
								array('label'=>'Editorial', 'url'=>array('#')),
						)),
						array('label'=>'Reportes', 'url'=>array('report/')),
						*/
						array('label'=>'Administracion <b class="caret"></b>', 'url'=>array('#'),
								'linkOptions'=> array(
								'class' => 'dropdown-toggle',
								'data-toggle' => 'dropdown',
							),
							'itemOptions' => array('class'=>'dropdown'),
							'items'=>array(
									array('label'=>'Inventario Gral', 'url'=>array('inventario/index')),
									array('label'=>'Movimientos Almacenes', 'url'=>array('inventario/movimientos')),
									array('label'=>'Cajas y Libro Mayor', 'url'=>array('caja/')),
									array('label'=>'Recibos', 'url'=>array('#')),
									array('label'=>'Empleados', 'url'=>array('empleado/index')),
									array('label'=>'Clientes', 'url'=>array('cliente/index')),
						)),
							
						array('label'=>'Distribuidora<b class="caret"></b>', 'url'=>array('#'),
								'linkOptions'=> array(
								'class' => 'dropdown-toggle',
								'data-toggle' => 'dropdown',
							),
							'itemOptions' => array('class'=>'dropdown'),
							'items'=>array(
									array('label'=>'Inventario', 'url'=>array('stock/distribuidora')),
						)),

						array('label'=>'Pre-Prensa CTP<b class="caret"></b>', 'url'=>array('#'),
								'linkOptions'=> array(
								'class' => 'dropdown-toggle',
								'data-toggle' => 'dropdown',
							),
							'itemOptions' => array('class'=>'dropdown'),
							'items'=>array(
									array('label'=>'Inventario', 'url'=>array('stock/ctp')),
									array('label'=>'Precios', 'url'=>array('ctp/matrizPrecios')),
									array('label'=>'Clientes', 'url'=>array('cliente/preferencia')),
						)),
						//array('label'=>'Imprenta', 'url'=>array('#')),
						array('label'=>'Reportes', 'url'=>array('report/')),
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
