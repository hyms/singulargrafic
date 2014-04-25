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
			$tabla = new CActiveDataProvider('Venta',array('criteria'=>array(
					'with'=>array('Detalle'),
					'with'=>array('Detalle.Almacen'),
					'with'=>array('Detalle.Almacen.Producto'),
					'with'=>array('Detalle.Almacen.Producto.Color'),
					'with'=>array('Detalle.Almacen.Producto.Material'),
			),
			));
		}
		
		$this->render("index",array('vd'=>$vd,'ld'=>$ld,'tabla'=>$tabla));
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