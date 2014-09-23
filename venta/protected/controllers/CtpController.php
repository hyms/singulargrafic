<?php
class CtpController extends Controller
{
	var $cajaCTP=3;
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
		$this->render('base',array('render'=>''));
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
					'condition'=>'`t`.estado=1 '.$t.' and `t`.tipoCTP=1',
					'with'=>array('idCliente0'),
					'order'=>'fechaOrden Desc',
				),
				'pagination'=>array(
						'pageSize'=>'20',
				),));
		$this->render('base',array('render'=>'ordenes','ordenes'=>$ordenes,'estado'=>''));
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
			if(!empty($ctp->fechaPlazo))
				$ctp->fechaPlazo= date("Y-m-d H:i:s",strtotime($ctp->fechaPlazo));
			$ctp->estado = 2;
			$tmp = array();
			$caja = $this->verifyModel(Caja::model()->findByPk($this->cajaCTP));
			$cajaMovimiento = new CajaMovimientoVenta;
			//Yii::app()->user->id;
			$cajaMovimiento->idUser = Yii::app()->user->id;
			$cajaMovimiento->motivo = "Nota de Venta";
			$cajaMovimiento->idCaja = $caja->idCaja;
			$cajaMovimiento->arqueo = 0;
			$cajaMovimiento->tipo = 0;
			
			
			if(isset($_POST['Cliente'])){
				$cliente = Cliente::model()->find('nitCi="'.$_POST['Cliente']['nitCi'].'"');
				if($cliente==null)
					$cliente = new Cliente;
			
				$cliente->attributes = $_POST['Cliente'];
				if(empty($cliente->fechaRegistro))
					$cliente->fechaRegistro = date("Y-m-d");
				if($cliente->save())
					$swc=1;
			}
			
			foreach ($_POST['DetalleCTP'] as $key => $item)
			{
				$tmp[$key] = $ctp->detalleCTPs[$key];
				$tmp[$key]->attributes = $item;
			}
			$ctp->detalleCTPs=$tmp;
			
			if($ctp->save())
			{
				$almacen = array(); $i=0;
				foreach ($ctp->detalleCTPs as $item)
				{
					$item->save();
					array_push($almacen, AlmacenProducto::model()->findByPk($item->idAlmacenProducto));
					$almacen[$i]->stockU = $almacen[$i]->stockU - $item->nroPlacas;
					if($almacen[$i]->stockU < 0)
						$ctp->estado = 1;
					 
					$i++;
				}
				if($ctp->estado == 2)
				{
					$cajaMovimiento->fechaMovimiento = date("Y-m-d H:i:s");
					$cajaMovimiento->tipo = 0;
					if($ctp->formaPago==0){
						$cajaMovimiento->monto = $ctp->montoPagado-$ctp->montoCambio;
					}
					if($ctp->formaPago==1){
						$cajaMovimiento->monto = $ctp->montoPagado;
					}
					foreach ($almacen as $item)
						$item->save();
					$cajaMovimiento->save();
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
			$cantidades = CantidadCTP::model()->findAll();
			foreach ($ctp->detalleCTPs as $key => $item)
			{
				$detalle[$key] = $ctp->detalleCTPs[$key];
				$condAlmacen = 'idAlmacenProducto='.$item->idAlmacenProducto;
				$condCliente ='idTiposClientes='.$ctp->idCliente0->idTiposClientes;
				$condCantidad="";
				foreach ($cantidades as $c)
				{	if($c->Inicio<=$item->nroPlacas)
						$condCantidad ="idCantidad=".$c->idCantidadCTP;
					else
						break;
				}
				$condHora ="";
				foreach ($horas as $h)
				{	if($h->inicio<=date("H:0:s"))
						$condHora ="idHorario=".$h->idHorario;
					else 
						break;
				}
				$matriz = MatrizPreciosCTP::model()->find($condAlmacen.' and '.$condCliente.' and '.$condCantidad.' and '.$condHora);
				if($ctp->tipoOrden ==0)
					$detalle[$key]->costo = $matriz->precioCF;
				else
					$detalle[$key]->costo = $matriz->precioSF;
				
				$detalle[$key]->costoTotal = ($detalle[$key]->costo*$detalle[$key]->nroPlacas)+$detalle[$key]->costoAdicional;
				$total = $total +$detalle[$key]->costoTotal;
			}
			$ctp->detalleCTPs = $detalle;
			$ctp->montoVenta = $total;
			$this->render('base',array('render'=>'orden','ctp'=>$ctp,'detalle'=>$ctp->detalleCTPs,'cliente'=>$ctp->idCliente0));
		}
		else
			throw new CHttpException(400,'Petición no válida.');	
	}
	
	public function actionBuscar()
	{
		$t="";
		if(isset($_GET['t']))
		{
			$t='(`t`.estado=1 and `t`.tipoCTP='.$_GET['t'].')';
			if($_GET['t']==1)
			$t="(`t`.estado=2 and `t`.tipoCTP=1)";
		}
		else 
			$t='(`t`.estado=2 and `t`.tipoCTP=1) or (`t`.estado=1 and `t`.tipoCTP!=1)';
			$ordenes=new CActiveDataProvider('CTP',array(
				'criteria'=>array(
						'condition'=>$t,
						'with'=>array('idCliente0'),
						'order'=>'fechaOrden Desc',
				),
				'pagination'=>array(
						'pageSize'=>'20',
				),));
        $this->render('base',array('render'=>'ordenes','ordenes'=>$ordenes,'estado'=>1));
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
				$this->render('base',array('render'=>'preview','ctp'=>$ctp,'tipo'=>''));
			}
			if($ctp->tipoCTP==2)
			{
				$ctpP= CTP::model()
				->with('idCliente0')
				->with('idUserOT0')
				->with('idUserOT0.idEmpleado0')
				->findByPk($ctp->idCTPParent);
				$this->render('base',array('render'=>'previewTI','ctp'=>$ctp,'tipo'=>'','titulo'=>'Interna'));
			}
			if($ctp->tipoCTP==3)
			{
				$ctpP= CTP::model()
							->with('idCliente0')
							->with('idUserVenta0')
							->with('idUserVenta0.idEmpleado0')
							->findByPk($ctp->idCTPParent);
				$ctp->idCliente0 = $ctpP->idCliente0;
				$ctp->idUserVenta0 = $ctpP->idUserVenta0;

                if($ctp->montoVenta>0)
                    $this->render('base',array('render'=>'preview','ctp'=>$ctp,'tipo'=>'Reposición'));
				else
                    $this->render('base',array('render'=>'previewSC','ctp'=>$ctp,'tipo'=>'1','titulo'=>'Reposición'));
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
		$this->render('base',array('render'=>'deudores','deudores'=>$deudores));
		
	}
	
	public function actionMovimientos()
	{
		$cond3="";
		$f="";
		$saldo="";
		$cf=array("ctp/movimientos",'f'=>0);
		$sf=array("ctp/movimientos",'f'=>1);
		$ventas = new CTP('searchCTP');
		
		$ventas->unsetAttributes();
		if(isset($_GET['f']))
			$ventas->tipoOrden = $_GET['f'];
		
		if(isset($_GET['d']) || isset($_GET['m']))
		{
			$d=date("d");
			$m=date("m");
			$y=date("Y");
			if(isset($_GET['d']))
			{
				$d=$_GET['d'];
				if($d==0)
				{
					$m=$m-1;
					if($m<10 && $m>0)
						$m = "0".$m;
					
					$d=$this->getUltimoDiaMes($y, $m);
				}
				$ventas->fechaOrden = $y."-".$m."-".$d;
				$cf=array("ctp/movimientos",'f'=>0,'d'=>$_GET['d']);
				$sf=array("ctp/movimientos",'f'=>1,'d'=>$_GET['d']);
				$cond3=array("ctp/previewDay","f"=>$ventas->tipoOrden,"d"=>$_GET['d']);
			}
			if(isset($_GET['m']))
			{
				$m=$_GET['m'];
				$ventas->fechaOrden = $y."-".$m;
				$cf=array("ctp/movimientos",'f'=>0,'m'=>$_GET['m']);
				$sf=array("ctp/movimientos",'f'=>1,'m'=>$_GET['m']);
				$cond3=array("ctp/previewDay","f"=>$ventas->tipoOrden,"m"=>$_GET['m']);
			}
		
		}

		if(isset($_GET['CTP']))
		{
			$ventas->attributes = $_GET['CTP'];
				
			if(isset($_GET['CTP']['apellido']))
				$ventas->apellido = $_GET['CTP']['apellido'];
			if(isset($_GET['CTP']['nit']))
				$ventas->nit = $_GET['CTP']['nit'];
				
		}
		
		if(isset($_GET['d']))
		{
			$saldo = CajaArqueo::model()->find(array('condition'=>"idCaja=".$this->cajaCTP." and fechaVentas<'".$ventas->fechaOrden."'",'order'=>'idCajaArqueo Desc'));
			//print_r($saldo);
			if(!empty($saldo))
				$saldo = $saldo->saldo;
		}
		
		$this->render('base',array('render'=>'movimientos','ventas'=>$ventas,'saldo'=>$saldo,'cond3'=>$cond3,'cf'=>$cf,'sf'=>$sf));
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
			$m=date("m");
			$y=date("Y");
			$start=date("Y-m-d")." 00:00:00"; $end=date("Y-m-d")." 23:59:59";
	
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
				->findAll(array('condition'=>'idCajaMovimientoVenta0.idCaja='.$this->cajaCTP.' and idCajaMovimientoVenta0.arqueo=0'.$fact.$cond)));
		//$tabla = $caja->ventas;
		$this->render("base",array('render'=>'previewDay','tabla'=>$caja,));
	}
	
	public function actionArqueo()
	{
	$arqueo = new CajaArqueo;
		$caja = Caja::model()->findByPk($this->cajaCTP);
		if(isset($_POST['CajaArqueo']))
		{
			$arqueo->attributes = $_POST['CajaArqueo'];
			$arqueo->fechaArqueo = date("Y-m-d H:i:s");
			$arqueo->idUser = Yii::app()->user->id;
			$arqueo->idCaja = $this->cajaCTP;
			$end=$arqueo->fechaVentas." 23:59:59";
			
			$movimiento = new CajaMovimientoVenta;
			$movimiento->motivo = "Traspaso de efectivo a Administracion";
			$comprovante = CajaArqueo::model()->find(array('select'=>'max(comprobante) as max','condition'=>'idCaja='.$this->cajaCTP));
			$arqueo->comprobante = $comprovante->max +1;
			$movimiento->fechaMovimiento = $arqueo->fechaVentas." 23:59:59";
			
			$movimiento->tipo = 0;
			$movimiento->idCaja = $arqueo->idCaja;
			$movimiento->idUser = $arqueo->idUser;
			$movimiento->monto = $arqueo->monto;
			$movimiento->arqueo =0;
			if($movimiento->validate() && $arqueo->validate())
			{
				$caja->saldo = $caja->saldo-$movimiento->monto;
				$ctps=0;$recibos=0;
				$cajaMovimiento = CajaMovimientoVenta::model()->with('ventas')->with('reciboses')->findAll(array('condition'=>"`t`.idCaja=".$this->cajaCTP." and tipo=0 and arqueo=0 and fechaMovimiento<='".$end."'"));
				foreach ($cajaMovimiento as $item)
				{
					foreach ($item->ventas as $venta)
					{
						$tmp = CTP::model()->with('idCajaMovimientoVenta0')->findByPk($venta->idVenta);
						$ctps = $ctps + $tmp->idCajaMovimientoVenta0->monto;
					}
					foreach ($item->reciboses as $venta)
					{
						$tmp = Recibos::model()->with('idCajaMovimientoVenta0')->findByPk($venta->idRecibos);
						$recibos = $recibos + $tmp->idCajaMovimientoVenta0->monto;
					}
				}
				
				$saldo = CajaArqueo::model()->find(array('condition'=>"idCaja=".$this->cajaCTP,'order'=>'idCajaArqueo Desc'));
				if(empty($saldo))
					$saldo = 0;
				else
					$saldo = $saldo->saldo;
				
				$arqueo->saldo = round($saldo+$ctps+$recibos-$movimiento->monto,1, PHP_ROUND_HALF_UP);
				if($caja->saldo >=0 && $arqueo->saldo>=0 ){
					if($movimiento->monto >= 0)
					{
						if($movimiento->monto==0){
							$movimiento->motivo = "Arqueo de Caja";
							$arqueo->comprobante="";
						}
						if($arqueo->save() && $caja->save())
						{
							//$start=$arqueo->fechaVentas." 00:00:00";
							$end=$arqueo->fechaVentas." 23:59:59";
							$movimiento->save();
							$arqueo->idCajaMovimientoVenta =$movimiento->idCajaMovimientoVenta;
							$arqueo->save(); 
							$cajaMovimiento = CajaMovimientoVenta::model()->findAll(array('condition'=>"`t`.idCaja=".$this->cajaCTP." and tipo=0 and arqueo=0 and fechaMovimiento<='".$end."'"));
							foreach ($cajaMovimiento as $item)
							{
								$item->arqueo = $arqueo->idCajaArqueo;
								$item->save();
							}
							if($movimiento->monto>0)
							{
								$cajaAdmin= Caja::model()->findByPk(1);
								$cajaAdmin->saldo = $cajaAdmin->saldo + $movimiento->monto;
								$cajaAdmin->save();
							}
							$this->redirect(array('distribuidora/comprobante', 'id'=>$arqueo->idCajaArqueo));
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
		
		if(isset($_GET['d']))
		{
			$d=$_GET['d']; $m=date("m");
			if($d==0)
			{
				$m--;
				$d=$this->getUltimoDiaMes(date("Y"), $m);
			}
			//$start=date("Y")."-".$m."-".$d." 00:00:00";
			$end=date("Y")."-".$m."-".$d." 23:59:59";
			//$cajaMovimiento = CajaMovimientoVenta::model()->with('reciboses')->with('ventas')->findAll(array('condition'=>"`t`.idCaja=2 and arqueo=0 and '".$start."'<=fechaMovimiento AND fechaMovimiento<='".$end."'"));
			$cajaMovimiento = CajaMovimientoVenta::model()->with('reciboses')->with('cTPs')->findAll(array('condition'=>"`t`.idCaja=".$this->cajaCTP." and tipo=0 and arqueo=0 and fechaMovimiento<='".$end."'",'order'=>'fechaMovimiento Desc'));
			if(!empty($cajaMovimiento))
				$end = date('Y-m-d',strtotime($cajaMovimiento[0]->fechaMovimiento))." 23:59:59";
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
			$saldo = CajaArqueo::model()->find(array('condition'=>"idCaja=".$this->cajaCTP,'order'=>'idCajaArqueo Desc'));
			if(empty($saldo))
				$saldo = 0;
			else
				$saldo = $saldo->saldo;
			$this->render("base",
					array(
                        'render'=>'arqueo',
						'saldo'=>$saldo,
						'arqueo'=>$arqueo,
						'caja'=>$caja,
						'fecha'=>date('Y-m-d',strtotime($end)),
						'ventas'=>$ventas,
						'recibos'=>$recibos,
					));
		}
		else
		{
			$arqueos=new CActiveDataProvider('CajaArqueo',
					array(
							'criteria'=>array(
									'condition'=>'idCaja='.$this->cajaCTP,
									'order'=>'fechaArqueo Desc',
									'with'=>array('idUser0','idUser0.idEmpleado0'),
							),
							'pagination'=>array(
									'pageSize'=>'20',
							),
					));
			$this->render('base',array('render'=>'arqueos','arqueos'=>$arqueos,));
		}
	}
	
	public function actionRegistroDiario()
	{
		if(isset($_GET['id']))
		{
			$arqueo = CajaArqueo::model()
						->with('cajaMovimientoVenta')
						->find(array('condition'=>'idCajaArqueo='.$_GET['id'].' and cajaMovimientoVenta.tipo=0 and `t`.idCaja='.$this->cajaCTP,'order'=>'cajaMovimientoVenta.fechaMovimiento Desc'));
			$start =$arqueo->fechaVentas;
			if(!empty($arqueo))
			{
				$arqueoA = CajaArqueo::model()->findByPk($arqueo->idCajaArqueo-1);
				if(!empty($arqueoA))
				{
					$d=date("d",strtotime($arqueoA->fechaVentas))+1;
					$start = date("Y-m",strtotime($arqueoA->fechaVentas))."-".$d." 00:00:00";
				}
			}
			$venta = CTP::model()
						->with('idCajaMovimientoVenta0')
						->findAll(array('condition'=>"fechaOrden>='".$start."' and fechaOrden<='".date("Y-m-d",strtotime($arqueo->fechaVentas))." 23:59:59' and idCajaMovimientoVenta0.tipo=0"));
			$ventas = 0;
			
			foreach ($venta as $item)
			{
				$ventas=$ventas+$item->idCajaMovimientoVenta0->monto;
			}
			
			$recibo = Recibos::model()
			->with('idCajaMovimientoVenta0')
			->findAll(array('condition'=>"fechaRegistro	>='".$arqueo->fechaVentas."' and fechaRegistro<='".date("Y-m-d",strtotime($arqueo->fechaVentas))." 23:59:59' and idCajaMovimientoVenta0.tipo=0 and idCajaMovimientoVenta0.idcaja=".$this->cajaCTP));
			$recibos = 0;
				
			foreach ($recibo as $item)
			{
				$recibos=$recibos+$item->idCajaMovimientoVenta0->monto;
			}
			
			$this->render('base',
							array(
                                'render'=>'registroRealizado',
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
			$this->render('base',array('render'=>'comprobante','arqueo'=>$arqueo));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	public function actionMaterial()
	{
		$material = AlmacenProducto::model()->with('idProducto0')->findAll(array('condition'=>'idAlmacen=3','order'=>'idProducto0.codigo asc, idProducto0.material asc'));
		
		$this->render('base',array('render'=>'material','material'=>$material));
	}
	
	public function actionProductos()
	{
		if(isset($_GET['id']))
		{
			$almacen=$this->verifyModel(AlmacenProducto::model()->with('idProducto0')->findByPk($_GET['id']));
			$deposito=AlmacenProducto::model()->find('idAlmacen=1 and idProducto='.$almacen->idProducto);
			$model=new MovimientoAlmacen;
	
			$model->idProducto = $almacen->idProducto;
			$model->idAlmacenDestino = $almacen->idAlmacen;
			$model->idAlmacenOrigen = $deposito->idAlmacen;
			//$idUser->idUser = Yii::app()->user->id;
			$model->fechaMovimiento = date("Y-m-d H:i:s");
	
			if(isset($_POST['MovimientoAlmacen']))
			{
				$model->attributes=$_POST['MovimientoAlmacen'];
	
				$deposito->stockU = $deposito->stockU - $model->cantidadU;
				while($deposito->stockU<0)
				{
					$deposito->stockU=$deposito->stockU+$almacen->idProducto0->cantXPaquete;
					$deposito->stockP = $deposito->stockP - 1;
				}
				$deposito->stockP = $deposito->stockP - $model->cantidadP;
	
				if($deposito->stockP < 0)
					$model->addError('cantidadP','No existen suficientes insumos');
				else{
					if($model->save())
					{
						// form inputs are valid, do something here
						$almacen->stockU = $almacen->stockU + $model->cantidadU;
						$almacen->stockP = $almacen->stockP + $model->cantidadP;
	
						if($almacen->save() && $deposito->save()){
							//$this->redirect(array('distribuidora/productos'));
							$this->redirect(array('ctp/material'));
						}
					}
				}
			}
			$index=2;
			$this->renderPartial('forms/add_reduce',array('model'=>$model,'almacen'=>$almacen,'deposito'=>$deposito,'index'=>$index));
	
		}
		else
		{
			$this->redirect(array('ctp/material'));
			/*$productos = new CActiveDataProvider('AlmacenProducto',array('criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>15,
				),));
			//init filter
			$this->renderPartial('add_reduce',array('productos'=>$productos,'index'=>$index));*/
		}
	}
	public function actionAjaxFactura()
	{
		//Yii::app()->user->id;
		$detalle=array();
		$tipo =0;
		if(isset($_POST['tipo']))
		{
			$tipo=$_POST['tipo'];
		}
	
		if(isset($_POST['detalle']) and isset($_POST['id']) and isset($_POST['cliente']))
		{
			$resultado = array();
			
			$ctp = $this->verifyModel(CTP::model()
					->with('detalleCTPs')
					->with('idCliente0')
					->findByPk($_POST['id']));
			
			$row = CTP::model()->find(array("condition"=>"tipoOrden=".$tipo,'order'=>'fechaOrden Desc'));
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
			
			if($ctp->tipoOrden!=$tipo){
				if($tipo==1)
					$ctp->codigo = chr($ctp->serie)."C-".$ctp->numero."-".date("y");
				else
					$ctp->codigo = $ctp->numero."-P";
			}
			
			$horas = Horario::model()->findAll();
			$cantidades = CantidadCTP::model()->findAll();
			//$resultado['detalle']=array();
			
			$cliente=Cliente::model()->find("nitCi=".$_POST['cliente']);
			if(empty($cliente))
			{
				$cliente= new Cliente;
				$cliente->nitCi=$_POST['cliente'];
				$cliente->save();
			}
			
			foreach ($ctp->detalleCTPs as $key => $item)
			{
				$condAlmacen = 'idAlmacenProducto='.$item->idAlmacenProducto;
				$condCliente ='idTiposClientes='.$ctp->idCliente0->idTiposClientes;
				if($cliente->idCliente!=$ctp->idCliente0->idCliente)
					$condCliente ='idTiposClientes='.$cliente->idTiposClientes;
				foreach ($cantidades as $c)
				{	if($c->Inicio<=$item->nroPlacas)
					$condCantidad ="idCantidad=".$c->idCantidadCTP;
				else
					break;
				}
				$condHora ="";
				foreach ($horas as $h)
				{	if($h->inicio<=date("H:0:s"))
						$condHora ="idHorario=".$h->idHorario;
					else
						break;
				}
				$matriz = MatrizPreciosCTP::model()->find($condAlmacen.' and '.$condCliente.' and '.$condCantidad.' and '.$condHora);
				if($tipo ==0)
					$resultado[$key]['costo'] = $matriz->precioCF;
				else
					$resultado[$key]['costo'] = $matriz->precioSF;
				
			}
			//*/
			$resultado['codigo']=$ctp->codigo;
			
			echo CJSON::encode($resultado);
		}
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