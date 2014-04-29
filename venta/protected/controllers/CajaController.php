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
		$rd = false;
		$tabla="";
		$caja="";
		
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
			$caja = Caja::model()->with('Movimiento')->with('Recibo')->find(array('condition'=>'arqueo=0 and entregado=0 and nombre like "papeles"','order'=>'`t`.id Desc'));
			$tabla = Venta::model()->findAll("(fechaVenta between '".$date." 00:00:00' and '".$date." 23:59:59') and (estado=0 or estado=2)");
			
						
			$ld=true;
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
		
		$this->render("index",array('vd'=>$vd,'ld'=>$ld,'rd'=>$rd,'tabla'=>$tabla,'caja'=>$caja));
	}
	
	public function actionEgreso()
	{
		$egreso = new MovimientoCaja;
		$egreso->fecha=date("Y-m-d H:m:s");
		$egreso->tipo=0;
		$empleado = Empleado::model()->with('Users')->find('idUsers='.Yii::app()->user->id);
		$egreso->idEmpleado=$empleado->id;
		$caja = Caja::model()->find(array('condition'=>'arqueo=0 and entregado=0 and nombre like "papeles"','order'=>'id Desc'));
		$egreso->idCaja = $caja->id;
		if(isset($_POST['MovimientoCaja']))
		{
			$egreso->attributes=$_POST['MovimientoCaja'];
			if($egreso->validate())
			{
				$caja->saldo = $caja->saldo-$egreso->monto;
				if($caja->saldo>=0)
				{
					if($egreso->save())
						if($caja->save())
							$this->redirect('index');
				}
				else
				{
					$egreso->addError('monto','No existen suficientes fondos');
				}
			}
		}
		$this->render("egreso",array('model'=>$egreso));
	}
	
	public function actionIngreso()
	{
		$ingreso = new MovimientoCaja;
		$ingreso->fecha = date("Y-m-d H:m:s");
		$ingreso->tipo = 1;
		$empleado = Empleado::model()->with('Users')->find('idUsers='.Yii::app()->user->id);
		$ingreso->idEmpleado = $empleado->id;
		$caja = Caja::model()->find(array('condition'=>'arqueo=0 and entregado=0 and nombre like "papeles"','order'=>'id Desc'));
		$ingreso->idCaja = $caja->id;
		if(isset($_POST['MovimientoCaja']))
		{
			$ingreso->attributes=$_POST['MovimientoCaja'];
			if($ingreso->validate())
			{
				$caja->saldo = $caja->saldo+$ingreso->monto;
				if($ingreso->save())
					if($caja->save())
						$this->redirect('index');
			}
		}
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