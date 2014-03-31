<?php

class DistribuidoraController extends Controller
{
	public function actions()
	{
		return array('addTabularInputs'=>array(
				'class'=>'ext.actions.XTabularInputAction',
				'modelName'=>'Person',
				'viewName'=>'/distribuidora/_tabularInput',
		),);
	}
	
	public function actionIndex()
	{
		$cliente = new Cliente;
		$almacen = new Almacen;
		$detalle = DetalleVenta::model()->findAll();
		$productos=new Producto('searchAll');
		
		//seccion on filter
		$productos->unsetAttributes();
		$dist = TipoAlmacen::model()->find('nombre like "%distribuidora%"');
		$productos->almacen = $dist->id;
		if (isset($_GET['Producto']))
		{
			$productos->attributes = $_GET['Producto'];
			$productos->color = $_GET['Producto']['color'];
			$productos->material = $_GET['Producto']['material'];
			$productos->industria = $_GET['Producto']['industria'];
			//$productos->almacen = $_GET['Producto']['almacen'];
		}
		
		$venta = new VentaTmp;
		$detalle = new DetalleVenta;
		$dataProvider=new CActiveDataProvider('Producto',array(
				'criteria'=>array(
						'with'=>'Color',
						'with'=>'Material',
						'with'=>'Industria',
				),
				'pagination'=>array(
						'pageSize'=>'5',
				),));
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
				'cliente'=>$cliente,
				'ventaTmp'=>$venta,
				'almacen'=>$almacen,
				'productos'=>$productos,
				'detalle'=>$detalle,
		));
		
		
	}

	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}