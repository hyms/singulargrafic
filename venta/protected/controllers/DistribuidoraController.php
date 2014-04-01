<?php

class DistribuidoraController extends Controller
{
	public function actions()
	{
		return array('newRow'=>array(
				'class'=>'ext.actions.XTabularInputAction',
				'modelName'=>'DetalleVenta',
				'viewName'=>'/distribuidora/_newRowDetalleVenta',
		),);
	}
	
	public function actionIndex($id=null)
	{
		$cliente = new Cliente;
		$empleado = Empleado::model()->findByPk('1');
		$almacen = new Almacen;
		$detalle = DetalleVenta::model()->with('Producto')
										->with('Producto.Color')
										->with('Producto.Material')
										->with('Producto.Industria')
										->with('Venta')
										->with('Venta.Cliente')
										->with('Venta.Empleado')
										->findAll();
		
		if($id!=null)
		{
			$detalle = DetalleVenta::model()->with('Producto')
											->with('Producto.Color')
											->with('Producto.Material')
											->with('Producto.Industria')
											->with('Venta')
											->with('Venta.Cliente')
											->with('Venta.Empleado')
											->findAll();
		}
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
		
		if(isset($_POST))
		{
			//print_r($_POST);
		}
		$venta = new VentaTmp;
		$detalle = new DetalleVenta;

		$this->render('index',array(
				//'dataProvider'=>$dataProvider,
				'cliente'=>$cliente,
				'empleado'=>$empleado,
				'ventaTmp'=>$venta,
				'almacen'=>$almacen,
				'productos'=>$productos,
				'detalle'=>$detalle,
				
				'pagination'=>array(
						'pageSize'=>20,
				),
		));
		
		
	}

}