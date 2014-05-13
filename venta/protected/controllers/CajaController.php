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
		$ce = false;
		$sf = 0;
		$tabla="";
		$caja="";
		
		if(isset($_GET['vd']))
		{
			$date = date("Y-m")."-".$_GET['vd'];
			if(isset($_GET['vm']))
				$date = date("Y-")."-".$_GET['vm']."-".$_GET['vd'];
			if(isset($_GET['sf']))
				$sf=$_GET['sf'];
			$tabla = Venta::model()->find("(fechaVenta between '".$date." 00:00:00' and '".$date." 23:59:59')");
			if(!empty($tabla))
			{
				$caja = Caja::model()
								->with('Movimiento')
								->with('Recibo')
								->with('Venta')
								->with('Venta.Cliente')
								->with('Venta.Detalle')
								->with('Venta.Detalle.Almacen')
								->with('Venta.Detalle.Almacen.Producto')
								->with('Venta.Detalle.Almacen.Producto.Color')
								->with('Venta.Detalle.Almacen.Producto.Material')
								->find(array('condition'=>'arqueo=0 and entregado=0 and `t`.nombre like "papeles" and `t`.id='.$tabla->idCaja.' and (`Venta`.estado=0 or `Venta`.estado=2) and `Venta`.tipoPago='.$sf,'order'=>'`t`.id Desc'));
				$tabla = $caja->Venta;
			}
			$vd=true;
			//print_r($tabla);
		}
		
		if(isset($_GET['ld']))
		{
			$date = date("Y-m")."-".$_GET['ld'];
			$caja = Caja::model()->with('Movimiento')->with('Recibo')->with('Venta')->find(array('condition'=>'arqueo=0 and entregado=0 and nombre like "papeles" and (`Venta`.estado=0 or `Venta`.estado=2)','order'=>'`t`.id Desc'));
			if(!empty($caja))
				$tabla = $caja->Venta;
						
			$ld=true;
		}
		if(isset($_GET['ar']) && !empty($_GET['ar']))
		{
			$caja = Caja::model()->with('Movimiento')->with('Recibo')->with('Venta')->find(array('condition'=>'`t`.id='.$_GET['ar'].' and (`Venta`.estado=0 or `Venta`.estado=2)'));
			if(!empty($caja))
				$tabla = $caja->Venta;
		
			$ld=true;
		}
		if(isset($_GET['ce']) && !empty($_GET['ce']))
		{
			$caja = MovimientoCaja::model()->with('Empleado')->find('idCaja='.$_GET['ce'].' and idComprovante>=1');
			$ce=true;
		}
				
		$this->render("index",array('vd'=>$vd,'ld'=>$ld,'ce'=>$ce,'tabla'=>$tabla,'caja'=>$caja,'sf'=>$sf));
	}
	
	public function actionEgreso()
	{
		$egreso = new MovimientoCaja;
		$egreso->fecha=date("Y-m-d H:i:s");
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
		$ingreso->fecha = date("Y-m-d H:i:s");
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
		$movimiento = new MovimientoCaja;
		
		if(isset($_POST['MovimientoCaja']))
		{
			$movimiento->attributes = $_POST['MovimientoCaja'];
			$movimiento->obs = "Traspaso de efectivo a Administracion";
			$comprovante = MovimientoCaja::model()->find(array('select'=>'max(idComprovante) as max'));
			$movimiento->idComprovante = $comprovante->max +1;
			$movimiento->fecha = date("Y-m-d H:i:s");
			$comprovante = MovimientoCaja::model()->find(array('order'=>'fecha Desc'));
			if(date("d",strtotime($movimiento->fecha)) > date("d",strtotime($comprovante->fecha)))
				$movimiento->fecha = date("Y-m-d",strtotime($comprovante->fecha))." 23:00:00";
			$movimiento->tipo = 0;
			$empleado = Empleado::model()->with('Users')->find('idUsers='.Yii::app()->user->id);
			$movimiento->idEmpleado = $empleado->id;
			$caja = Caja::model()->find(array('condition'=>'arqueo=0 and entregado=0 and nombre like "papeles"','order'=>'id Desc'));
			$movimiento->idCaja = $caja->id;
			if($movimiento->validate())
			{
				$caja->saldo = $caja->saldo-$movimiento->monto;
				$caja->arqueo=1;
				$caja->fechaArqueo=date("Y-m-d H:i:s");
				$caja->entregado=1;
				if($movimiento->monto==0)
				{
					if($caja->save())
						$this->redirect('index',array('ar'=>$caja->id));
				}
				else
				{
					if($movimiento->monto > 0)
					{
						if($movimiento->save())
						{
							$caja->comprovante = $movimiento->idComprovante;
							if($caja->save())
								$this->redirect('index',array('ar'=>$caja->id));
						}
					}
					else
					{
						$movimiento->addError('monto',"El numero debe ser positivo");
					}
				}	
			}
		}
		
		$this->render("arqueo",array('movimiento'=>$movimiento));
	}
	
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');

		return $model;
	}
}