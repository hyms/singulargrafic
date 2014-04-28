<?php

class CajaController extends Controller
{

	public function filters()
	{
		return array( 'accessControl' ); // perform access control for CRUD operations
	}

	public function accessRules() {
		return array(
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						//'actions'=>array('index'),
						'expression'=>'isset($user->role) && ($user->role==="ventas")',
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'expression'=>'isset($user->role) && ($user->role==="admin")',
				),
				array('deny',
						'users'=>array('*'),
				),
		);
	}

	public function actionIndex()
	{
		$vd = false;
		$ld = false;
		$tabla="";
		
		if(isset($_GET['vd']))
		{
			$date = date("Y-m")."-".$_GET['vd'];
			$tabla = Venta::model()
							->with('Cliente')
							->with('Detalle')
							->with('Detalle.Almacen')
							->with('Detalle.Almacen.Producto')
							->with('Detalle.Almacen.Producto.Color')
							->with('Detalle.Almacen.Producto.Material')
							->findAll("(fechaVenta between '".$date." 00:00:00' and '".$date." 23:59:59') and (estado=0 or estado=2)");
			
			$vd=true;
			//print_r($tabla);
		}
		
		if(isset($_GET['ld']))
		{
			$date = date("Y-m")."-".$_GET['ld'];
			$tabla = Venta::model()
							->with('Cliente')
							->with('Detalle')
							->with('Detalle.Almacen')
							->with('Detalle.Almacen.Producto')
							->with('Detalle.Almacen.Producto.Color')
							->with('Detalle.Almacen.Producto.Material')
							->findAll("(fechaVenta between '".$date." 00:00:00' and '".$date." 23:59:59') and (estado=0 or estado=2)");
			
			$vd=true;
		}
		
		if(isset($_GET['rd']))
		{
			$date = date("Y-m")."-".$_GET['rd'];
			$tabla = Recibo::model()
						->with('Cliente')
						->with('Venta')
						->with('Venta.Detalle')
						->with('Venta.Detalle.Almacen')
						->with('Venta.Detalle.Almacen.Producto')
						->with('Venta.Detalle.Almacen.Producto.Color')
						->with('Venta.Detalle.Almacen.Producto.Material')
						->findAll("(fecha between '".$date." 00:00:00' and '".$date." 23:59:59')");
				
			$rd=true;
		}
		
		$this->render("index",array('vd'=>$vd,'ld'=>$ld,'rd'=>$rd,'tabla'=>$tabla));
	}
	
	public function actionEgreso()
	{
		$egreso = new MovimientoCaja;
		$egreso->fecha=date("Y-m-d H:m:s");
		$this->render("egreso",array('model'=>$egreso));
	}
	
	public function actionIngreso()
	{
		$ingreso = new MovimientoCaja;
		$ingreso->fecha=date("Y-m-d H:m:s");
		$this->render("ingreso",array('model'=>$ingreso));
	}
	
	public function actionArqueo()
	{
		$this->render("arqueo");
	}
	
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		return $model;
	}
}