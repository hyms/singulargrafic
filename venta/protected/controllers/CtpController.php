<?php
class CtpController extends Controller
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
		$this->render('index');
	}
	
	public function actionOrdenes()
	{
		$t="";
		if(isset($_GET['t']))
		{
			$t="and tipoCTP=".$_GET['t'];
		}
		$ordenes=new CActiveDataProvider('CTP',array(
				'criteria'=>array(
					'condition'=>'`t`.estado=1 '.$t.' and `t`.tipoCTP!=3',
					'with'=>array('idCliente0'),
					'order'=>'fechaOrden Desc',
				),
				'pagination'=>array(
						'pageSize'=>'20',
				),));
		$this->render('ordenes',array('ordenes'=>$ordenes,'estado'=>1));
	}
	
	public function actionOrden()
	{
		if(isset($_POST['CTP']))
		{
			$ctp = CTP::model()
			->with('detalleCTPs')
			->with('idCliente0')
			->findByPk($_POST['CTP']['idCTP']);
			
			$ctp->attributes = $_POST['CTP'];
			$ctp->idUserVenta = Yii::app()->user->id;
			$ctp->fechaPlazo= date("Y-m-d H:i:s",strtotime($ctp->fechaPlazo));
			$ctp->estado = 2;
			if($ctp->save())
			{
				$almacen = array(); $i=0;
				foreach ($ctp->detalleCTPs as $item)
				{
					array_push($almacen, AlmacenProducto::model()->findByPk($item->idAlmacenProducto));
					$almacen[$i]->stockU = $almacen[$i]->stockU - $item->nroPlacas;
					if($almacen[$i]->stockU < 0)
						$ctp->estado = 1;
					 
					$i++;
				}
				if($ctp->estado == 2)
				{
					foreach ($almacen as $item)
						$item->save();
					
					$this->redirect(array("ctp/buscar"));
				}
				else
					$ctp->save();				
				
			}
		}
		if(isset($_GET['id']) || isset($_POST['CTP']['idCTP']))
		{
			$id=0;
			if(isset($_GET['id']))
				$id=$_GET['id'];
			if(isset($_POST['CTP']['idCTP']))
				$id=$_POST['CTP']['idCTP'];
			$ctp = $this->verifyModel(CTP::model()
				->with('detalleCTPs')
				->with('idCliente0')
				->find('`t`.idCTP='.$id));
			$detalle = array();
			$total=0;
			$horas = Horario::model()->findAll();
			foreach ($ctp->detalleCTPs as $key => $item)
			{
				$detalle[$key] = $ctp->detalleCTPs[$key];
				$condAlmacen = 'idAlmacenProducto='.$item->idAlmacenProducto;
				$condCliente ='idTiposClientes='.$ctp->idCliente0->idTiposClientes;
				$condCantidad ='idCantidad0.Inicio<='.$item->nroPlacas.' and '.$item->nroPlacas.'<=idCantidad0.final';
				$condHora ="";
				foreach ($horas as $h)
				{	if($h->inicio<date("H:0:s"))
					//if($h->inicio<"19:30:00")
						$condHora ="idHorario=".$h->idHorario;
				}
				$matriz = MatrizPreciosCTP::model()->with('idCantidad0')->find($condAlmacen.' and '.$condCliente.' and '.$condCantidad.' and '.$condHora);
				//$matriz = MatrizPreciosCTP::model()->with('idHorario0')->with('idCantidad0')->find($condAlmacen.' and '.$condCliente.' and '.$condCantidad.' and '.$condHora);
				if($ctp->tipoOrden ==0)
					$detalle[$key]->costo = $matriz->precioCF;
				else
					$detalle[$key]->costo = $matriz->precioSF;
				
				$detalle[$key]->costoTotal = ($detalle[$key]->costo*$detalle[$key]->nroPlacas)+$detalle[$key]->costoAdicional;
				$total = $total +$detalle[$key]->costoTotal;
			}
			$ctp->detalleCTPs = $detalle;
			$ctp->montoVenta = $total;
			$this->render('orden',array('ctp'=>$ctp,'detalle'=>$ctp->detalleCTPs,'cliente'=>$ctp->idCliente0));
		}
		else
			throw new CHttpException(400,'Petición no válida.');	
	}
	
	public function actionFactura()
	{
		if(isset($_GET['id']))
		{
			$ctp = $this->verifyModel(CTP::model()
			->with('detalleCTPs')
			->with('idCliente0')
			->findByPk($_GET['id']));
			
			$ctp->attributes = $_POST['CTP'];
			
			$row = CTP::model()->find(array("condition"=>"tipoOrden=".$ctp->tipoOrden,'order'=>'fechaOrden Desc'));
			if(empty($row))
				$row=new CTP;
			if(empty($row->serie))
				$row->serie = 65;
			$ctp->numero = $row->numero +1;
			if($row->numero==1001)
			{
				$row->numero=1;
				$row->serie++;
				if($row->serie==91)
					$row->serie = 65;
			}
			$ctp->serie = $row->serie;
			
			if($ctp->tipoOrden==1)
				$ctp->codigo = chr($ctp->serie)."C-".$ctp->numero."-".date("y");
			else
				$ctp->codigo = $ctp->numero."-P";
			
			$detalle = array();
			$total=0;
			$horas = Horario::model()->findAll();
			foreach ($ctp->detalleCTPs as $key => $item)
			{
				$detalle[$key] = $ctp->detalleCTPs[$key];
				//$hora = date('H:m:i');
				$hora = "19:30:00";
				$condAlmacen = 'idAlmacenProducto='.$item->idAlmacenProducto;
				$condCliente ='idTiposClientes='.$ctp->idCliente0->idTiposClientes;
				$condCantidad =$item->nroPlacas.' between idCantidad0.Inicio and idCantidad0.final';
				$condHora ="";
				foreach ($horas as $h)
				{	if($h->inicio<date("H:0:s"))
					//if($h->inicio<"19:30:00")
						$condHora ="idHorario=".$h->idHorario;
				}
				$matriz = MatrizPreciosCTP::model()->with('idCantidad0')->find($condAlmacen.' and '.$condCliente.' and '.$condCantidad.' and '.$condHora);
				//print_r($matriz);return;
				if($ctp->tipoOrden ==0)
					$detalle[$key]->costo = $matriz->precioCF;
				else
					$detalle[$key]->costo = $matriz->precioSF;
			
				$detalle[$key]->costoTotal = ($detalle[$key]->costo*$detalle[$key]->nroPlacas)+$detalle[$key]->costoAdicional;
				$total = $total +$detalle[$key]->costoTotal;
			}
			$ctp->detalleCTPs = $detalle;
			$ctp->montoVenta = $total;
			$this->render('orden',array('ctp'=>$ctp,'detalle'=>$ctp->detalleCTPs,'cliente'=>$ctp->idCliente0));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	public function actionBuscar()
	{
		$ordenes=new CActiveDataProvider('CTP',array(
				'criteria'=>array(
						'condition'=>'`t`.estado=2 and `t`.tipoCTP=1',
						'with'=>array('idCliente0'),
				),
				'pagination'=>array(
						'pageSize'=>'20',
				),));
		$this->render('ordenes',array('ordenes'=>$ordenes));
	}
	
	public function actionPreview()
	{
		if(isset($_GET['id']))
		{
			$ctp = CTP::model()
					->with('idCliente0')
					->with('idUserOT0')
					->with('idUserOT0.idEmpleado0')
					->with('idUserVenta0')
					//->with('idUserVenta0.idEmpleado0')
					->with('detalleCTPs')
					->findByPk($_GET['id']);
			if($ctp->tipoCTP==1)
			{
				$this->render('preview',array('ctp'=>$ctp,'tipo'=>''));
			}
			if($ctp->tipoCTP==2)
			{
				throw new CHttpException(203 ,'Non-Authoritative Information');
			}
			if($ctp->tipoCTP==3)
			{
				throw new CHttpException(203 ,'Non-Authoritative Information');
			}
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	public function actionDeudores()
	{
		$deudores = new CActiveDataProvider('CTP',
				array('criteria'=>array(
						'condition'=>'montoVenta>montoPagado',
						'with'=>array('idCliente0'),
						'order'=>'fechaPlazo ASC',
				),
						'pagination'=>array(
								'pageSize'=>20,
						),));
		$this->render('deudores',array('deudores'=>$deudores));
	}
	
	public function actionMovimientos()
	{
		$ventas="";
		$cond1="";
		$cond2="";
		$cond3="";
		$factura="";
		$f="";
		if(isset($_GET['f']))
		{
			$f=$_GET['f'];
			if($_GET['f']==0)
			{
				$factura=" tipoOrden=0";
			}
			else
			{
				$factura=" tipoOrden=1";
			}
		}
		if(isset($_GET['d']) || isset($_GET['m']))
		{
			if($factura!="")
				$factura=" and ".$factura;
			$d=date("d");
			$m=date("m");
			$y=date("Y");
			$start=date("Y-m-d H:i:s"); $end=date("Y-m-d H:i:s");
				
			if(isset($_GET['d']))
			{
				$cond1=array("ctp/movimientos","f"=>0,"d"=>$_GET['d']);
				$cond2=array("ctp/movimientos","f"=>1,"d"=>$_GET['d']);
				$cond3=array("ctp/previewDay","f"=>$f,"d"=>$_GET['d']);
				$d=$_GET['d'];
				if($d==0)
				{
					$m--;
					$d=$this->getUltimoDiaMes($y, $m);
				}
				$start=$y."-".$m."-".$d." 00:00:00";
				$end=$y."-".$m."-".$d." 23:59:59";
			}
			if(isset($_GET['m']))
			{
				$cond1=array("ctp/movimientos","f"=>0,"m"=>$_GET['m']);
				$cond2=array("ctp/movimientos","f"=>1,"m"=>$_GET['m']);
				$cond3=array("ctp/previewDay","f"=>$f,"m"=>$_GET['m']);
				$m=$_GET['m'];
				$d=$this->getUltimoDiaMes($y, $m);
				$start=$y."-".$m."-1 00:00:00";
				$end=$y."-".$m."-".$d." 23:59:59";
			}
			$condition="'".$start."'<=idCajaMovimientoVenta0.fechaMovimiento AND idCajaMovimientoVenta0.fechaMovimiento<='".$end."'";
			$ventas = new CActiveDataProvider('CTP',
					array('criteria'=>array(
							'condition'=>$condition.$factura,
							'with'=>array('idCliente0','idCajaMovimientoVenta0'),
							'order'=>'fechaMovimiento ASC',
					),
							'pagination'=>array(
									'pageSize'=>20,
							),));
				
		}
	
		$this->render('movimientos',array('ventas'=>$ventas,'cond1'=>$cond1,'cond2'=>$cond2,'cond3'=>$cond3));
	}
	
	public function actionPreviewDay()
	{
		$fact="";$cond="";
		if(isset($_GET['f']))
		{
			if($_GET['f']!="")
			{
				if($_GET['f']==0)
				{
					$fact=" and tipoOrden=0";
				}
				else
				{
					$fact=" and tipoOrden=1";
				}
			}
		}
		if(isset($_GET['d']) || isset($_GET['m']))
		{
			$d=date("d");
			$m=date("m");
			$y=date("Y");
			$start=date("Y-m-d H:i:s"); $end=date("Y-m-d H:i:s");
	
			if(isset($_GET['d']))
			{
				$d=$_GET['d'];
				if($d==0)
				{
					$m--;
					$d=$this->getUltimoDiaMes($y, $m);
				}
				$start=$y."-".$m."-".$d." 00:00:00";
				$end=$y."-".$m."-".$d." 23:59:59";
			}
			if(isset($_GET['m']))
			{
				$m=$_GET['m'];
				$d=$this->getUltimoDiaMes($y, $m);
				$start=$y."-".$m."-1 00:00:00";
				$end=$y."-".$m."-".$d." 23:59:59";
			}
			$cond=" and '".$start."'<=fechaOrden AND fechaOrden<='".$end."'";
		}
		$caja = $this->verifyModel(CTP::model()
				->with('idCliente0')
				->with('detalleCTPs')
				->with('detalleCTPs.idAlmacenProducto0')
				->with('detalleCTPs.idAlmacenProducto0.idProducto0')
				->with('idCajaMovimientoVenta0')
				->findAll(array('condition'=>'idCajaMovimientoVenta0.idCaja=3 and idCajaMovimientoVenta0.arqueo=0'.$fact.$cond)));
		//$tabla = $caja->ventas;
		$this->render("movimientos/previewVentas",array('tabla'=>$caja,));
	}
	
	public function actionArqueo()
	{
		$arqueo = new CajaArqueo;
		$caja = Caja::model()->findByPk('3');
		if(isset($_POST['CajaArqueo']))
		{
			$arqueo->attributes = $_POST['CajaArqueo'];
			$arqueo->fechaArqueo = date("Y-m-d H:i:s");
			$arqueo->idUser = Yii::app()->user->id;
			$arqueo->idCaja = $caja->idCaja;
				
			$movimiento = new CajaMovimientoVenta;
			$movimiento->motivo = "Traspaso de efectivo a Administracion";
			$comprovante = CajaArqueo::model()->find(array('select'=>'max(comprobante) as max'));
			$arqueo->comprobante = $comprovante->max +1;
			$movimiento->fechaMovimiento = $arqueo->fechaVentas." 23:59:59";
				
			$movimiento->tipo = 0;
			$movimiento->idCaja = $arqueo->idCaja;
			$movimiento->idUser = $arqueo->idUser;
			$movimiento->monto = $arqueo->monto;
			$movimiento->arqueo = 0;
			if($movimiento->validate() && $arqueo->validate())
			{
				$caja->saldo = $caja->saldo-$movimiento->monto;
				$ventas=0;$recibos=0;
				$cajaMovimiento = CajaMovimientoVenta::model()->findAll(array('condition'=>"`t`.idCaja=2 and arqueo=0 and fechaMovimiento<='".$end."'"));
				foreach ($cajaMovimiento as $item)
				{
					foreach ($item->ventas as $venta)
					{
						$tmp = Venta::model()->with('idCajaMovimientoVenta0')->findByPk($venta->idVenta);
						$ventas = $ventas + $tmp->idCajaMovimientoVenta0->monto;
					}
					foreach ($item->reciboses as $venta)
					{
						$tmp = Recibos::model()->with('idCajaMovimientoVenta0')->findByPk($venta->idRecibos);
						$recibos = $recibos + $tmp->idCajaMovimientoVenta0->monto;
					}
				}
				$saldo = CajaArqueo::model()->find(array('condition'=>'idCaja=2','order'=>'idCajaArqueo Desc'));
				$arqueo->saldo = $saldo->saldo+$ventas+$recibos-$movimiento->monto;
				if($caja->saldo >=0){
					if($movimiento->monto==0)
					{
						$arqueo->comprobante="";
							
						if($arqueo->save())
						{
							$start=$arqueo->fechaVentas." 00:00:00";
							$end=$arqueo->fechaVentas." 23:59:59";
							$cajaMovimiento = CajaMovimientoVenta::model()->findAll(array('condition'=>"`t`.idCaja=2 and arqueo=0 and '".$start."'<=fechaMovimiento AND fechaMovimiento<='".$end."'"));
							foreach ($cajaMovimiento as $item)
							{
								$item->arqueo = $arqueo->idCajaArqueo;
								$item->save();
							}
							$arqueos=new CActiveDataProvider('CajaArqueo',
									array(
											'criteria'=>array(
													'condition'=>'idCaja=3',
													'order'=>'fechaArqueo Desc',
													'with'=>array('idUser0','idUser0.idEmpleado0'),
											),
											'pagination'=>array(
													'pageSize'=>'20',
											),
									));
							$this->render('arqueos',array('arqueos'=>$arqueos,));
						}
					}
					else
					{
						if($movimiento->monto > 0)
						{
							if($arqueo->save() && $caja->save())
							{
								$start=$arqueo->fechaVentas." 00:00:00";
								$end=$arqueo->fechaVentas." 23:59:59";
								$movimiento->save();
								$cajaMovimiento = CajaMovimientoVenta::model()->findAll(array('condition'=>"`t`.idCaja=3 and arqueo=0 and '".$start."'<=fechaMovimiento AND fechaMovimiento<='".$end."'"));
								foreach ($cajaMovimiento as $item)
								{
									$item->arqueo = $arqueo->idCajaArqueo;
									$item->save();
								}
								$cajaAdmin= Caja::model()->findByPk(1);
								$cajaAdmin->saldo = $cajaAdmin->saldo + $movimiento->monto;
								$cajaAdmin->save();
								$this->redirect(array('ctp/comprobante', 'id'=>$arqueo->idCajaArqueo));
							}
	
						}
						else
						{
							$movimiento->addError('monto',"El numero debe ser positivo");
							$this->redirect(array('distribuidora/arqueo'));
						}
					}
				}
			}
		}
	
		if(isset($_GET['d']))
		{
			$d=$_GET['d']; $m=date("m");
			if($d==0)
			{
				$m--;
				$d=$this->getUltimoDiaMes(date("Y"), $m);
			}
			$start=date("Y")."-".$m."-".$d." 00:00:00";
			$end=date("Y")."-".$m."-".$d." 23:59:59";
			$cajaMovimiento = CajaMovimientoVenta::model()->with('reciboses')->with('ventas')->findAll(array('condition'=>"`t`.idCaja=3 and arqueo=0 and '".$start."'<=fechaMovimiento AND fechaMovimiento<='".$end."'"));
			$ventas=0;$recibos=0;
			foreach ($cajaMovimiento as $item)
			{
				foreach ($item->ventas as $venta)
				{
					$tmp = Venta::model()->with('idCajaMovimientoVenta0')->findByPk($venta->idVenta);
					$ventas = $ventas + $tmp->idCajaMovimientoVenta0->monto;
				}
				foreach ($item->reciboses as $venta)
				{
					$tmp = Recibos::model()->with('idCajaMovimientoVenta0')->findByPk($venta->idRecibos);
					$recibos = $recibos + $tmp->idCajaMovimientoVenta0->monto;
				}
			}
	
			$saldo = CajaArqueo::model()->find(array('condition'=>'idCaja=3	','order'=>'idCajaArqueo Desc'));
				
			$this->render("arqueo",
					array(
							'saldo'=>$saldo,
							'arqueo'=>$arqueo,
							'caja'=>$caja,
							'fecha'=>date('Y-m-d',strtotime($start)),
							'ventas'=>$ventas,
							'recibos'=>$recibos,
					));
		}
		else
		{
			$arqueos=new CActiveDataProvider('CajaArqueo',
					array(
							'criteria'=>array(
									'condition'=>'idCaja=3',
									'order'=>'fechaArqueo Desc',
									'with'=>array('idUser0','idUser0.idEmpleado0'),
							),
							'pagination'=>array(
									'pageSize'=>'20',
							),
					));
			$this->render('arqueos',array('arqueos'=>$arqueos,));
		}
	}
	
	public function actionRegistroDiario()
	{
		if(isset($_GET['id']))
		{
			$arqueo = CajaArqueo::model()
			->with('cajaMovimientoVenta')
			->find(array('condition'=>'idCajaArqueo='.$_GET['id'],'order'=>'cajaMovimientoVenta.fechaMovimiento Desc'));
			$venta = Venta::model()
			->with('idCajaMovimientoVenta0')
			->findAll(array('condition'=>"fechaVenta>='".$arqueo->fechaVentas."' and fechaVenta<='".date("Y-m-d",strtotime($arqueo->fechaVentas))." 23:59:59'"));
			$ventas = 0;
				
			foreach ($venta as $item)
			{
				$ventas=$ventas+$item->idCajaMovimientoVenta0->monto;
			}
				
			$recibo = Recibos::model()
			->with('idCajaMovimientoVenta0')
			->findAll(array('condition'=>"fechaRegistro	>='".$arqueo->fechaVentas."' and fechaRegistro<='".date("Y-m-d",strtotime($arqueo->fechaVentas))." 23:59:59'"));
			$recibos = 0;
	
			foreach ($recibo as $item)
			{
				$recibos=$recibos+$item->idCajaMovimientoVenta0->monto;
			}
				
			$this->render('arqueo/registroRealizado',
					array(
							'fecha'=>date("Y-m-d",strtotime($arqueo->fechaVentas)),
							'arqueo'=>$arqueo,
							'ventas'=>$ventas,
							'recibos'=>$recibos,
					)
			);
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	public function actionComprobante()
	{
		if(isset($_GET['id']))
		{
			$arqueo = CajaArqueo::model()	->with('idUser0')
			->with('cajaMovimientoVenta')
			->with('idUser0.idEmpleado0')
			->find(array('condition'=>'idCajaArqueo='.$_GET['id'],'order'=>'fechaMovimiento Desc'));
			$this->render('arqueo/comprobante',array('arqueo'=>$arqueo));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
	
		return $model;
	}
	
	protected function getUltimoDiaMes($elAnio,$elMes) {
		return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
	}
}