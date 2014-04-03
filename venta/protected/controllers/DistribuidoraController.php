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
		$dist = $this->verifyModel(TipoAlmacen::model()->find('nombre like "%distribuidora%"'));
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
			print_r($_POST);
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
						'pageSize'=>5,
				),
		));
		
		
	}
	
	public function actionAjaxCliente($nitCi)
	{
		$cliente = $this->verifyModel(Cliente::model()->find('nitCi='.$nitCi));
		echo CJSON::encode($cliente);
	}
	
	public function actionAddDetalle()
	{
		if(Yii::app()->request->isAjaxRequest && isset($_GET['index']))
		{
			$detalle = new DetalleVenta;
			$almacen = new Almacen;
			if(isset($_GET['al']))
			{	
				$almacen = Almacen::model()	->with("Producto")
											->with("Producto.Color")
											->with("Producto.Material")
											//->with("Producto.Industria")
											->findByPk($_GET['al']);
				
			}
			$this->renderPartial('_newRowDetalleVenta', array(
					'detalle'=>$detalle,
					'index'=>$_GET['index'],
					'almacen'=>$almacen,
					'costos'=>array(),
			));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	public function actionEditDetalle($id)
	{
		
	}
	
	
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
	
		return $model;
	}
	
	protected function getRemoveLinkAndIndexInput($index)
	{
		$removeLink=CHtml::link('Quitar', '#', array('class'=>'btn btn-danger tabular-input-remove')).'<input type="hidden" class="tabular-input-index" value="'.$index.'" />';
		$removeLink=strtr("<td>{link}</td>", array('{link}'=>$removeLink));
		return $removeLink;
	}
}