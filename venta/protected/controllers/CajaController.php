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
						'expression'=>'isset($user->role) && ($user->role==="3")',
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'expression'=>'isset($user->role) && ($user->role==="1")',
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
		
		if(isset($_GET['ld']))
		{
			$date = date("Y-m")."-".$_GET['ld'];
			$caja = CajaVenta::model()	->with('reciboses')
										->with('movimientoCajas')
										->with('ventas')
										->find(array('condition'=>'`t`.idCaja=2 and fechaArqueo is NULL'));
			if(!empty($caja))
				$tabla = $caja->ventas;
			$ld=true;
		}
		if(isset($_GET['ce']) && !empty($_GET['ce']))
		{
			$caja = MovimientoCaja::model()->with('idCaja0')->with('idUser0')->with('idUser0.idEmpleado0')->find(array('condition'=>'`t`.idCaja='.$_GET['ce'],'order'=>'fechaMovimiento DESC'));
			$ce=true;
			//print_r($caja);
		}		
		if(isset($_GET['ar']) && !empty($_GET['ar']))
		{
			$caja = CajaVenta::model()->with('movimientoCajas')->with('reciboses')->with('ventas')->find(array('condition'=>'`t`.idCajaVenta='.$_GET['ar'].' and (`ventas`.estado=1 or `ventas`.estado=2)'));
			if(!empty($caja))
				$tabla = $caja->ventas;
			$ld=true;
		}
		$this->render("index",array('ld'=>$ld,'ce'=>$ce,'tabla'=>$tabla,'caja'=>$caja));
	}
	
	public function actionEgreso()
	{
		$egreso = new MovimientoCaja;
		$egreso->fechaMovimiento=date("Y-m-d H:i:s");
		$egreso->tipo=0;
		$caja = $caja = CajaVenta::model()->find(array('condition'=>'`t`.idCaja=2 and fechaArqueo is NULL'));
		$egreso->idCaja = $caja->idCajaVenta;
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
		$ingreso->fechaMovimiento = date("Y-m-d H:i:s");
		$ingreso->tipo = 1;
		$caja = $caja = CajaVenta::model()->find(array('condition'=>'`t`.idCaja=2 and fechaArqueo is NULL'));
		$ingreso->idCaja = $caja->idCajaVenta;
		if(isset($_POST['MovimientoCaja']))
		{
			$ingreso->attributes=$_POST['MovimientoCaja'];
			if($ingreso->validate())
			{
				$caja->saldo = $caja->saldo+$ingreso->monto;
				if($ingreso->save())
					if($caja->save())
						$this->redirect(array('index'));
			}
		}
		$this->render("ingreso",array('model'=>$ingreso));
	}
	
	public function actionArqueo()
	{
		$movimiento = new MovimientoCaja;
		$caja = CajaVenta::model()->find(array('condition'=>'`t`.idCaja=2 and fechaArqueo is NULL'));
		if(isset($_POST['MovimientoCaja']))
		{
			$movimiento->attributes = $_POST['MovimientoCaja'];
			$movimiento->motivo = "Traspaso de efectivo a Administracion";
			$comprovante = CajaVenta::model()->find(array('select'=>'max(comprobante) as max'));
			$caja->comprobante = $comprovante->max +1;
			$movimiento->fechaMovimiento = date("Y-m-d H:i:s");
			$comprovante = MovimientoCaja::model()->find(array('order'=>'fechaMovimiento Desc'));
			if(empty($comprovante))
				$comprovante=new MovimientoCaja;
			if(date("d",strtotime($movimiento->fechaMovimiento)) > date("d",strtotime($comprovante->fechaMovimiento)))
				$movimiento->fechaMovimiento = date("Y-m-d",strtotime($comprovante->fechaMovimiento))." 23:00:00";
			$movimiento->tipo = 0;
			$movimiento->idCaja = $caja->idCajaVenta;
			$movimiento->idUser = $caja->idUser;
			if($movimiento->validate())
			{
				$caja->saldo = $caja->saldo-$movimiento->monto;
				$caja->fechaArqueo=date("Y-m-d H:i:s");
				$caja->entregado=$movimiento->monto;
				if($movimiento->monto==0)
				{
					$caja->comprobante="";
					if($caja->save())
					{
						if($this->initCaja($caja->saldo))
						$this->redirect(array('index','ar'=>$caja->idCajaVenta));
					}
				}
				else
				{
					if($movimiento->monto > 0)
					{
						if($movimiento->save())
						{
							if($caja->save())
							{
								if($this->initCaja($caja->saldo))
								$this->redirect(array('index','ar'=>$caja->idCajaVenta));
							}
						}
					}
					else
					{
						$movimiento->addError('monto',"El numero debe ser positivo");
					}
				}	
			}
		}
		
		$this->render("arqueo",array('movimiento'=>$movimiento,'caja'=>$caja));
	}
	
	public function actionReciboIngreso()
	{
		$cliente = new Cliente;
		$recibo = new Recibos;
		
		if(isset($_GET['id']))
		{
			$recibo = $this->verifyModel(Recibos::model()->findByPk($_GET['id']));
			$caja = CajaVenta::model()->findByPk($recibo->idCajaVenta);
		}
		else
		{
			$caja = CajaVenta::model()->find('idUser='.Yii::app()->user->id.' and fechaArqueo is NULL');
			$row = Recibos::model()->find(array("select"=>"count(*) as `max`",'condition'=>'tipoRecivo=1'));
		
			$recibo->fechaRegistro = date("Y-m-d h:m:s");
			$recibo->codigo = "I-".($row['max']+1);
			$recibo->tipoRecivo = 1;
			$recibo->idCaja = $caja->idCajaVenta;
		}
		if(isset($_POST['Recibos']))
		{
			$saldobkp="";
			if(!empty($recibo->acuenta))
				$saldobkp= $recibo->acuenta;
			
			$recibo->attributes = $_POST['Recibos'];
			$cliente->attributes = $_POST['Cliente'];
			$cliente = Cliente::model()->find("nitCi='".$cliente->nitCi."'");
			$recibo->idCliente = $cliente->idCliente;
			
			if($recibo->validate())
			{
				if(!empty($recibo->idRecibos))
					$caja->saldo = $caja->saldo - $saldobkp;
				
				$caja->saldo = $caja->saldo+$recibo->monto;
				if($recibo->save())
				if($caja->save())
					$this->redirect(array('preview','id'=>$recibo->idRecibos));
			}
				
		}
		$this->render("reciboIngreso",array(
				'cliente'=>$cliente,
				'recibo'=>$recibo,
		));
	}
	
	public function actionReciboEgreso()
	{
		$cliente = new Cliente;
		$recibo="";$caja="";
		
		if(isset($_GET['id']))
		{
			$recibo = $this->verifyModel(Recibos::model()->findByPk($_GET['id']));
			$caja = CajaVenta::model()->findByPk($recibo->idCajaVenta);
		}
		else
		{
			$recibo = new Recibos;
			$caja = CajaVenta::model()->find('idUser='.Yii::app()->user->id.' and fechaArqueo is NULL');
			$row = Recibos::model()->find(array("select"=>"count(*) as `max`",'condition'=>'tipoRecivo=0'));
			
			$recibo->fechaRegistro=date("Y-m-d h:m:s");
			$recibo->codigo = "E-".($row['max']+1);
			$recibo->tipoRecivo=0;
			$recibo->responsable="Miriam Martinez";
			
			$recibo->idCaja = $caja->idCajaVenta;
		}
		
		if(isset($_POST['Recibos']))
		{
			$saldobkp="";
			if(!empty($recibo->acuenta))
				$saldobkp= $recibo->acuenta;
			$recibo->attributes=$_POST['Recibos'];
			if($recibo->validate())
			{
				if(!empty($recibo->idRecibos))
					$caja->saldo = $caja->saldo + $saldobkp;
				
				$caja->saldo = $caja->saldo-$recibo->acuenta;
				if($caja->saldo>=0)
				{
					if($recibo->save())
						if($caja->save())
							$this->redirect(array('preview','id'=>$recibo->idRecibos));
				}
				else
				{
					$recibo->addError('acuenta','No existen suficientes fondos');
				}
			}
		}
		$this->render("reciboEgreso",array(
				'cliente'=>$cliente,
				'recibo'=>$recibo,
					
		));
	}
	
	public function actionBuscar()
	{
		$recibos = new Recibos('search');
		
		
		$recibos->unsetAttributes();
		if(!isset($_GET["t"]))
		{	$recibos->tipoRecivo=1;}
		else 
		{	$recibos->tipoRecivo=$_GET["t"];	}
		
		if (isset($_GET['Recibos']))
		{
			$recibos->attributes = $_GET['Recibos'];
		}
		
		$this->render("buscar",array('recibos'=>$recibos));
	}
	
	public function actionDeuda()
	{
		if(isset($_GET['id']) && isset($_GET['serv']))
		{
			$cliente = new Cliente;
			$recibo = new Recibos;
			$venta="";
			if($_GET['serv']=="1")
				$venta = $this->verifyModel(Venta::model()->with('idCliente0')->findByPk($_GET['id']));
			else 
				$venta = Venta::model()->findByPk($_GET['id']);
			
			$cliente = $venta->idCliente0;
			$caja = CajaVenta::model()->find('idUser='.Yii::app()->user->id.' and fechaArqueo is NULL');
			$row = Recibos::model()->find(array("select"=>"count(*) as `max`",'condition'=>'tipoRecivo=1'));
			$recibo->fechaRegistro = date("Y-m-d h:m:s");
			$recibo->codigo = "I-".($row['max']+1);
			$recibo->tipoRecivo = 1;
			$recibo->idCaja = $caja->idCajaVenta;
			$recibo->saldo = $venta->montoVenta - $venta->montoPagado;
			$recibo->idCliente = $cliente->idCliente;
			
			if(isset($_POST['Recibos']))
			{
				$recibo->attributes = $_POST['Recibos'];
				$cliente->attributes = $_POST['Cliente'];
					
				if($recibo->validate())
				{
					$caja->saldo = $caja->saldo+$recibo->monto;
					$venta->montoPagado=$venta->montoPagado+$recibo->monto;
					if($recibo->save()) 
						if($caja->save() && $venta->save())
							$this->redirect(array('preview','id'=>$recibo->idRecibos));
				}
		
			}
			$this->render("reciboIngreso",array(
					'cliente'=>$cliente,
					'recibo'=>$recibo,
			));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	public function actionChica()
	{
		$t=0;
		if(isset($_GET['t']))
		{
			$t=$_GET['t'];
		}
		if($t==0)
		{
			$this->actionEgreso();
		}
		else
		{
			$this->actionIngreso();
		}
	}
	
	public function actionPreview()
	{
		if(isset($_GET['id']))
		{
			$recibo = Recibos::model()
			->with("idCliente0")
			->findByPk($_GET['id']);
			
			if($recibo!=null)
				$this->render('preview',array('recibo'=>$recibo));
			else
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	} 
	
	private function initCaja($saldo)
	{
		$caja = new CajaVenta;
		$caja->saldo = $saldo;
		$caja->idCaja=2;
		$caja->idUser=Yii::app()->user->id;
		return $caja->save();
	}
	
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');

		return $model;
	}
}