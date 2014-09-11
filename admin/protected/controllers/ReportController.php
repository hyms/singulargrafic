<?php 
class ReportController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array( 'accessControl' ); // perform access control for CRUD operations
	}
	
	public function accessRules() {
		return array(
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
		/*$dataProvider=new CActiveDataProvider('AlmacenProducto',
				array(	
						'criteria'=>array(
							'condition'=>'idAlmacen=1',
							'with'=>array('idProducto0'),
						),
						'pagination'=>array(
						'pageSize'=>'20',
				),));*/
		$this->render('index');
	}
	 
	public function actionVenta()
	{
		$ventas="";
		$cond1="";
		$cond2="";
		$factura="";
		$f="";
		$saldo="";
		$cf=array("report/venta",'f'=>0);
		$sf=array("report/venta",'f'=>1);
		$ventas = new Venta('searchDistribuidora');
		
		$ventas->unsetAttributes();
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
					$m--;
					if($m<10 && $m>0)
						$m = "0".$m;
					$d=$this->getUltimoDiaMes($y, $m);
				}
				$ventas->fechaVenta = $y."-".$m."-".$d;
				$cf=array("report/venta",'f'=>0,'d'=>$_GET['d']);
				$sf=array("report/venta",'f'=>1,'d'=>$_GET['d']);
			}
			if(isset($_GET['m']))
			{
				$m=$_GET['m'];
				$ventas->fechaVenta = $y."-".$m;
				$cf=array("report/venta",'f'=>0,'m'=>$_GET['m']);
				$sf=array("report/venta",'f'=>1,'m'=>$_GET['m']);
			}
		
		}
		if(isset($_GET['f']))
			$_GET['Venta']['tipoVenta']= $_GET['f'];
		
		//print_r($ventas);
		if(isset($_GET['Venta']))
		{
			$ventas->attributes = $_GET['Venta'];
			
			if(isset($_GET['Venta']['apellido']))
			$ventas->apellido = $_GET['Venta']['apellido'];
			if(isset($_GET['Venta']['nit']))
			$ventas->nit = $_GET['Venta']['nit'];
			
		}
		
		if(isset($_GET['d']))
		{
			$saldo = CajaArqueo::model()->find(array('condition'=>"idCaja=2 and fechaVentas<'".$ventas->fechaVenta."'",'order'=>'idCajaArqueo Desc'));
			//print_r($saldo);
			if(!empty($saldo))
				$saldo = $saldo->saldo;
		}
		$this->render('venta',array('ventas'=>$ventas,'cond1'=>$cond1,'cond2'=>$cond2,'saldo'=>$saldo,'cf'=>$cf,'sf'=>$sf));
	}
	
	public function actionVentaSingular()
	{
		$ventas="";
		$cond1="";
		$cond2="";
		$factura="";
		$f="";
		$saldo="";
		$cf=array("report/venta",'f'=>0);
		$sf=array("report/venta",'f'=>1);
		$ventas = new Venta('searchDistribuidora');
	
		$ventas->unsetAttributes();
		$ventas->nit="000";
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
					$m--;
					if($m<10 && $m>0)
						$m = "0".$m;
					$d=$this->getUltimoDiaMes($y, $m);
				}
				$ventas->fechaVenta = $y."-".$m."-".$d;
				$cf=array("report/venta",'f'=>0,'d'=>$_GET['d']);
				$sf=array("report/venta",'f'=>1,'d'=>$_GET['d']);
			}
			if(isset($_GET['m']))
			{
				$m=$_GET['m'];
				$ventas->fechaVenta = $y."-".$m;
				$cf=array("report/venta",'f'=>0,'m'=>$_GET['m']);
				$sf=array("report/venta",'f'=>1,'m'=>$_GET['m']);
			}
	
		}
		if(isset($_GET['f']))
			$_GET['Venta']['tipoVenta']= $_GET['f'];
	
		//print_r($ventas);
		if(isset($_GET['Venta']))
		{
			$ventas->attributes = $_GET['Venta'];
				
			if(isset($_GET['Venta']['apellido']))
				$ventas->apellido = $_GET['Venta']['apellido'];
			if(isset($_GET['Venta']['nit']))
				$ventas->nit = $_GET['Venta']['nit'];
				
		}
	
		$this->render('ventaSingular',array('ventas'=>$ventas,'cond1'=>$cond1,'cond2'=>$cond2,'cf'=>$cf,'sf'=>$sf));
	}
	
	public function actionVentaDetalle()
	{
		if(isset($_GET['id']))
		{
			$ventas = Venta::model()
			->with("idCliente0")
			->with("detalleVentas")
			->with("detalleVentas.idAlmacenProducto0")
			->with("detalleVentas.idAlmacenProducto0.idProducto0")
			->with("idCajaMovimientoVenta0")
			->with("idCajaMovimientoVenta0.idUser0")
			->with("idCajaMovimientoVenta0.idUser0.idEmpleado0")
			->findByPk($_GET['id']);
			if($ventas!=null)
				$this->renderPartial('venta/detalle',array('venta'=>$ventas));
			else
				$this->redirect(array('report/venta'));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	public function actionProducto()
	{
		$this->render('producto');
	}
	
	public function actionProductoSaldo()
	{
		if(isset($_GET['almacen']))
		{
			$startDate=date("Y")."-".date("m")."-1 00:00:00";
			$endDate=date("Y-m-d H:i:s");
				
			$startDateS=date("Y")."-".(date("m")-1)."-1 00:00:00";
			$endDateS=date("Y")."-".date("m")."-1 00:00:00";
			
			$this->getSaldoAnterior($_GET['almacen']);
			$almacenes = AlmacenProducto::model()->with('idProducto0')->findAll('idAlmacen='.$_GET['almacen']);
			
			$saldos = array();
			$entradaU=array();$entradaP=array();
			$salidasU=array();$salidasP=array();
			$entradasF=array();
			$salidasF=array();
			$costoF=array();
			foreach ($almacenes as $key => $almacen)
			{
				$saldoA[$key] = new SaldoProducto;
				$entradaU[$key]=0;$entradaP[$key]=0;
				$salidasU[$key]=0;$salidasP[$key]=0;
				$saldo = SaldoProducto::model()->with('idAlmacen0')->with('idAlmacen0.idProducto0')->find('`t`.idAlmacen='.$almacen->idAlmacenProducto);
				$entradas = MovimientoAlmacen::model()->findAll('idAlmacenDestino='.$almacen->idAlmacen.' and idProducto='.$almacen->idProducto.' and fechaMovimiento Between "'.$startDate.'" and "'.$endDate.'"');
				foreach ($entradas as $entrada)
				{
					$entradaU[$key]=$entradaU[$key]+$entrada->cantidadU;
					$entradaP[$key]=$entradaP[$key]+$entrada->cantidadP;
				}
				$salidas = MovimientoAlmacen::model()->findAll('idAlmacenOrigen='.$almacen->idAlmacen.' and idProducto='.$almacen->idProducto.' and fechaMovimiento Between "'.$startDate.'" and "'.$endDate.'"');
				foreach ($salidas as $salida)
				{
					$salidasU[$key]=$salidasU[$key]+$salida->cantidadU;
					$salidasP[$key]=$salidasP[$key]+$salida->cantidadP;
				}
				$saldos[$key]=$saldo;
				$saldoA[$key]->saldoU=$entradaU[$key]-$salidasU[$key];
				$saldoA[$key]->saldoP=$entradaP[$key]-$salidasP[$key];
				$saldoA[$key]->idAlmacen=$almacen->idAlmacenProducto;
				$entradasF[$key]=array('unidad'=>$entradaU[$key],'paquete'=>$entradaP[$key]);
				$salidasF[$key]=array('unidad'=>$salidasU[$key],'paquete'=>$salidasP[$key]);
				$costoF[$key]=($saldoA[$key]->saldoU*$almacen->idProducto0->precioSFU)+($saldoA[$key]->saldoP*$almacen->idProducto0->precioSFP);
			}
			$this->render('productoSaldo',array('saldoA'=>$saldos,'entradas'=>$entradasF,'salidas'=>$salidasF,'saldoB'=>$saldoA,'costos'=>$costoF));
		}
		else
			$this->render('productoSaldo',array('saldoA'=>'','entradas'=>'','salidas'=>'','saldoB'=>''));
	}
	
	
	public function actionCliente()
	{
		$this->render('cliente');
	}
	
	
	public function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
		return $model;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param Cliente $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='producto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	protected function getUltimoDiaMes($elAnio,$elMes) {
		return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
	}
	
	protected function getSaldoAnterior($almacen)
	{
		$startDateS=date("Y")."-".(date("m")-1)."-1 00:00:00";
		$endDateS=date("Y")."-".date("m")."-1 00:00:00";
		$saldos = SaldoProducto::model()->with('idAlmacen0')->with('idAlmacen0.idProducto0')->findAll(array('condition'=>'`idAlmacen0`.idAlmacen='.$almacen.' and `t`.fechaSaldo Between "'.$startDateS.'" and "'.$endDateS.'"','order'=>'idProducto0.Material,idProducto0.codigo, idProducto0.detalle'));
			
		if(empty($saldos) || count($saldos)==0)
		{
			$almacenes = AlmacenProducto::model()->findAll('idAlmacen='.$almacen);
			foreach ($almacenes as $key => $almacen)
			{
				$saldos = new SaldoProducto;
				$entradaTU=0;$entradaTP=0;
				$salidasTU=0;$salidasTP=0;
				$entradas = MovimientoAlmacen::model()->findAll('idAlmacenDestino='.$almacen->idAlmacen.'  and idProducto='.$almacen->idProducto.' and fechaMovimiento Between "'.$startDateS.'" and "'.$endDateS.'"');
				foreach ($entradas as $entrada)
				{
					$entradaTU=$entradaTU+$entrada->cantidadU;
					$entradaTP=$entradaTP+$entrada->cantidadP;
				}
				$salidas = MovimientoAlmacen::model()->findAll('idAlmacenOrigen='.$almacen->idAlmacen.'  and idProducto='.$almacen->idProducto.' and fechaMovimiento Between "'.$startDateS.'" and "'.$endDateS.'"');
				foreach ($salidas as $salida)
				{
					$salidasTU=$salidasTU+$salida->cantidadU;
					$salidasTP=$salidasTP+$salida->cantidadP;
				}
				$saldos->saldoU=$entradaTU-$salidasTU;
				$saldos->saldoP=$entradaTP-$salidasTP;
				$saldos->idAlmacen=$almacen->idAlmacenProducto;
				$saldos->fechaRealizado=date("Y-m-d H:i:s");
				$saldos->fechaSaldo=date("Y")."-".(date("m")-1)."-".$this->getUltimoDiaMes(date("Y"), (date("m")-1));
				$saldos->save();
				//print_r($saldos->attributes);
				//echo '<br>';
			}
			$saldos = SaldoProducto::model()->with('idAlmacen0')->with('idAlmacen0.idProducto0')->findAll(array('condition'=>'`idAlmacen0`.idAlmacen='.$almacen.' and `t`.fechaSaldo Between "'.$startDateS.'" and "'.$endDateS.'"','order'=>'idProducto0.Material,idProducto0.codigo, idProducto0.detalle'));
		}
		return $saldos;
	}
	
	/*public function actionBalance()
	{
		$startDate=date("Y")."-".date("m")."-1 00:00:00";
		$endDate=date("Y-m-d H:i:s");
			
		$startDateS=date("Y")."-".(date("m")-1)."-1 00:00:00";
		$endDateS=date("Y")."-".date("m")."-1 00:00:00";
		
		$saldos = $this->getSaldoAnterior($_GET['almacen']);
		$almacenes = AlmacenProducto::model()->findAll('idAlmacen='.$_GET['almacen']);
		
		$saldo = array();
		$entradaTU=array();$entradaTP=array();
		$salidasTU=array();$salidasTP=array();
		foreach ($almacenes as $key => $almacen)
		{
			$saldoA[$key] = new SaldoProducto;
			$entradaTU[$key]=0;$entradaTP[$key]=0;
			$salidasTU[$key]=0;$salidasTP[$key]=0;
			$entradas = MovimientoAlmacen::model()->findAll('idAlmacenDestino='.$almacen->idAlmacen.' and idProducto='.$almacen->idProducto.' and fechaMovimiento Between "'.$startDate.'" and "'.$endDate.'"');
			foreach ($entradas as $entrada)
			{
				$entradaTU[$key]=$entradaTU[$key]+$entrada->cantidadU;
				$entradaTP[$key]=$entradaTP[$key]+$entrada->cantidadP;
			}
			$salidas = MovimientoAlmacen::model()->findAll('idAlmacenOrigen='.$almacen->idAlmacen.' and idProducto='.$almacen->idProducto.' and fechaMovimiento Between "'.$startDate.'" and "'.$endDate.'"');
			foreach ($salidas as $salida)
			{
				$salidasTU[$key]=$salidasTU[$key]+$salida->cantidadU;
				$salidasTP[$key]=$salidasTP[$key]+$salida->cantidadP;
			}
			$saldoA[$key]->saldoU=$entradaTU[$key]-$salidasTU[$key];
			$saldoA[$key]->saldoP=$entradaTP[$key]-$salidasTP[$key];
			$saldoA[$key]->idAlmacen=$almacen->idAlmacenProducto;
			if($saldoA[$key]->saldoU !=$almacen->stockU || $saldoA[$key]->saldoP !=$almacen->stockP)
			{
				$movimiento=new MovimientoAlmacen;
				$movimiento->idProducto = $almacen->idProducto0->idProducto;
				$movimiento->idAlmacenDestino = $almacen->idAlmacen;
				//$movimiento->idAlmacenOrigen = $almacen->idAlmacen;
				//$idUser->idUser = Yii::app()->user->id;
				$movimiento->fechaMovimiento = date("Y-m-d H:i:s");
				if($saldoA[$key]->saldoU !=$almacen->stockU)
					$movimiento->cantidadU = $almacen->stockU+$salidasTU[$key];
				if($saldoA[$key]->saldoP !=$almacen->stockP)
					$movimiento->cantidadP = $almacen->stockP+$salidasTP[$key];
				
				$movimiento->obs = "Balance de Sistema";
				$movimiento->save();
			}
		}
		$entradas=array('unidad'=>$entradaTU,'paquete'=>$entradaTP);
		$salidas=array('unidad'=>$salidasTU,'paquete'=>$salidasTP);
		$this->render('productoSaldo',array('saldoA'=>$saldos,'entradas'=>$entradas,'salidas'=>$salidas,'saldoB'=>$saldoA));
	}*/
}
?>