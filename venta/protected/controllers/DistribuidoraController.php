<?php

class DistribuidoraController extends Controller
{
	var $cajaDistribuidora=2;
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
		$ventas = new CActiveDataProvider('Venta',
					array('criteria'=>array(
								'group'=>'`t`.idCliente',
								'select'=>'count(*) as cantidad, `t`.`idCliente`',
								'order'=>'cantidad Desc',
								'with'=>array('idCliente0'=>array('select'=>'nitCi, apellido')),
								'limit'=>'5',
						),
							'pagination'=>false,));
		$productos = new CActiveDataProvider(DetalleVenta::model(),
					array('criteria'=>array(
							'limit' => 5,
							'with'=>array('idAlmacenProducto0'=>array('select'=>'*'),'idAlmacenProducto0.idProducto0'=>array('select'=>'*')),
							'group'=>'`t`.idAlmacenProducto',
							'select'=>'sum(`t`.cantidadU + (`t`.cantidadP*idProducto0.cantXPaquete)) as cantidad, `t`.idAlmacenProducto',
							'order'=>'cantidad Desc',
					),
							'pagination'=>false,
					));
		
		$this->render('index',array("ventas"=>$ventas,"productos"=>$productos));
	}
	
	public function actionNotas()
	{
		$productos = new AlmacenProducto('searchDistribuidora');
		$cliente = new Cliente;
		$detalle = new DetalleVenta;
		$venta = new Venta;
		$caja = $this->verifyModel(Caja::model()->findByPk($this->cajaDistribuidora));
		
		$cajaMovimiento = new CajaMovimientoVenta;
		//Yii::app()->user->id;
		$cajaMovimiento->idUser = Yii::app()->user->id;
		$cajaMovimiento->motivo = "Nota de Venta";
		$cajaMovimiento->idCaja = $caja->idCaja;
		$cajaMovimiento->arqueo = 0;
		$cajaMovimiento->tipo = 0;
		
		//init default values
		$row = Venta::model()->find(array("condition"=>"tipoVenta=1",'order'=>'fechaVenta Desc'));
		if(empty($row))
			$row=new Venta;
		if(empty($row->serie))
			$row->serie = 65;
		$venta->numero = $row->numero +1;
		if($row->numero==1001){
			$row->numero=1;
			$row->serie++;
			if($row->serie==91)
				$row->serie = 65;
		}
		
		$venta->serie = $row->serie;
		$venta->codigo = chr($venta->serie)."P-".$venta->numero."-".date("y");
		$venta->fechaVenta = date("Y-m-d H:i:s");
		$venta->formaPago = 0;
		$venta->tipoVenta = 1;
		//end default values
		
		//init filter
		$productos->unsetAttributes();
		if (isset($_GET['AlmacenProducto'])){
			$productos->attributes = $_GET['AlmacenProducto'];
			$productos->color = $_GET['AlmacenProducto']['color'];
			$productos->material = $_GET['AlmacenProducto']['material'];
			$productos->marca = $_GET['AlmacenProducto']['marca'];
			$productos->paquete = $_GET['AlmacenProducto']['paquete'];
			$productos->detalle = $_GET['AlmacenProducto']['detalle'];
			$productos->codigo = $_GET['AlmacenProducto']['codigo'];
		}
		//end filter
		
		$swc=0; $swv=0;
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
		
		if(isset($_POST['Venta']))
		{
			$venta->attributes = $_POST['Venta'];
			$row = Venta::model()->find(array("condition"=>"tipoVenta=".$venta->tipoVenta,'order'=>'fechaVenta Desc'));
			if(empty($row))
				$row=new Venta;
			
			if(empty($row->serie) && $venta->tipoVenta==1)
				$row->serie = 65;
			$venta->numero = $row->numero +1;
			if($row->numero==1001 && $venta->tipoVenta==1){
				$row->numero=1;
				$row->serie++;
				if($row->serie==91)
					$row->serie = 65;
			}
			$venta->serie = $row->serie;
			if($venta->tipoVenta==1)
				$venta->codigo = chr($venta->serie)."P-".$venta->numero."-".date("y");
			else
				$venta->codigo = $venta->numero."-P";
			
			$venta->estado = 1;
			if($venta->formaPago==1){
				$venta->estado = 2;
				if(!empty($_POST['Venta']['fechaPlazo']))
					$venta->fechaPlazo = date("Y-m-d",strtotime($_POST['Venta']['fechaPlazo']));
				if(empty($venta->fechaPlazo)||$venta->fechaPlazo=="")
					$venta->addError('fechaPlazo', 'La <b>fechaPlazo</b> no puede estar vacia');
			}
			if($venta->validate())
				$swv=1;
		}
		
		if(isset($_POST['DetalleVenta']))
		{
			$detalle = array();
			$i=0;
			$det=count($_POST['DetalleVenta']);
			foreach ($_POST['DetalleVenta'] as $item){
				array_push($detalle,new DetalleVenta);
				$detalle[$i]->attributes = $item;
				if($detalle[$i]->validate())
					$det--;
				$i++;
			}
		}
		
		if($swc==1 && $swv==1 && $det==0){
			$venta->idCliente = $cliente->idCliente;
				
			if($venta->save()){
				$det=count($detalle);
				$almacenes=array();	$i=0;
				foreach($detalle as $item){
					$item->idVenta = $venta->idVenta;
					if($item->validate()){
						array_push($almacenes,AlmacenProducto::model()->with('idProducto0')->findByPk($item->idAlmacenProducto));
						$almacenes[$i]->stockU = $almacenes[$i]->stockU - $item->cantidadU;
						while($almacenes[$i]->stockU<0){
							$almacenes[$i]->stockP = $almacenes[$i]->stockP - 1;
							$almacenes[$i]->stockU = $almacenes[$i]->stockU + $almacenes[$i]->idProducto0->cantXPaquete;
						}
						$almacenes[$i]->stockP = $almacenes[$i]->stockP - $item->cantidadP;
						if($almacenes[$i]->stockP<0){
							$venta->addError('obs', 'No existen suficientes Insumos');
							$venta->delete();
							break;
						}
						else{
							$det--; $i++;
						}
					}
					else{
						$venta->delete();
						break;
					}
				}
		
				if($det==0){
					$i=0;
					foreach ($detalle as $item){
						if($cliente->nitCi=="000")
						{
							$item->costoTotal=0;
						}
						if($item->save()){
							$almacenes[$i]->save();
						}
						$i++;
					}
					
					$cajaMovimiento->fechaMovimiento = date("Y-m-d H:i:s");
					$cajaMovimiento->tipo = 0;
					if($venta->formaPago==0){
						$cajaMovimiento->monto = $venta->montoPagado-$venta->montoCambio;
					}
					if($venta->formaPago==1){
						$cajaMovimiento->monto = $venta->montoPagado;
					}
					if($cliente->nitCi=="000")
					{
						$cajaMovimiento->tipo = -1;
						//añadir descuento
						if(empty($cajaMovimiento->monto)||$cajaMovimiento->monto==0)
							$cajaMovimiento->monto = $venta->montoVenta;
						$venta->montoVenta=0;
						$venta->montoPagado=0;
						$venta->montoCambio=0;
					}
					
					if($cajaMovimiento->save()){
						if($cliente->nitCi!="000")
							$caja->saldo = $caja->saldo + $cajaMovimiento->monto;
						
						$venta->idCajaMovimientoVenta = $cajaMovimiento->idCajaMovimientoVenta; 
					}
						
					if($caja->save()&& $venta->save())
						$this->redirect(array('preview','id'=>$venta->idVenta));
				}
				else{
					$venta->delete();
				}
				//finish section for save datas
			}
		}
		
		
		$this->render('notas',array(
				'productos'=>$productos,
				'cliente'=>$cliente,
				'detalle'=>$detalle,
				'venta'=>$venta,
		));
	}
	
	public function actionBuscar()
	{
		$ventas = new Venta('searchVenta');
		$ventas->unsetAttributes();
		if (isset($_GET['Venta'])){
			$ventas->attributes = $_GET['Venta'];
			$ventas->nit = $_GET['Venta']['nit'];
			$ventas->apellido = $_GET['Venta']['apellido'];
		}
		$this->render('buscar',array('ventas'=>$ventas));
	}
	
	public function actionModificar()
	{
		if(isset($_POST['Venta']['idVenta']))
			$_GET['id']=$_POST['Venta']['idVenta'];
		
		if(isset($_GET['id'])){
			$venta = $this->verifyModel(Venta::model()->with('idCliente0')->findByPk($_GET['id']));
			$cajaMovimiento= CajaMovimientoVenta::model()->findByPk($venta->idCajaMovimientoVenta);
			$detalle = DetalleVenta::model()->findAll('idVenta='.$venta->idVenta);
			$cliente = $venta->idCliente0;
			$caja = Caja::model()->findByPk($cajaMovimiento->idCaja);
			$productos = new AlmacenProducto('searchDistribuidora');
			//init seccion on filter
			$productos->unsetAttributes();
			if (isset($_GET['AlmacenProducto'])){
				$productos->attributes = $_GET['AlmacenProducto'];
				$productos->color = $_GET['AlmacenProducto']['color'];
				$productos->material = $_GET['AlmacenProducto']['material'];
				$productos->marca = $_GET['AlmacenProducto']['marca'];
				$productos->paquete = $_GET['AlmacenProducto']['paquete'];
				$productos->detalle = $_GET['AlmacenProducto']['detalle'];
				$productos->codigo = $_GET['AlmacenProducto']['codigo'];
			}
			$swc=0;
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
			$swv=0;
			if(isset($_POST['Venta'])){
				$venta->attributes = $_POST['Venta'];
				$venta->estado = 1;
				$venta->idCliente = $cliente->idCliente;
				if($venta->tipoVenta==1)
					$venta->codigo = chr($venta->serie)."P-".$venta->numero."-".date("y");
				else
					$venta->codigo = $venta->numero."-P";
				if($venta->formaPago==1){
					$venta->estado = 2;
					if(!empty($_POST['Venta']['fechaPlazo']))
						$venta->fechaPlazo = date("Y-m-d",strtotime($_POST['Venta']['fechaPlazo']));
					if(empty($venta->fechaPlazo)||$venta->fechaPlazo=="")
						$venta->addError('fechaPlazo', 'La <b>fechaPlazo</b> no puede estar vacia');
				}
				$ventabkp = Venta::model()->findByPk($_GET['id']);
				if($venta->validate())
				{
					$saldo1=0;$saldo2=0;
					if($venta->formaPago==0){
						$saldo1=$venta->montoPagado-$venta->montoCambio;
						$saldo2=$ventabkp->montoPagado-$ventabkp->montoCambio;
					}
					else{
						$saldo1=$venta->montoPagado;
						$saldo2=$ventabkp->montoPagado;
					}
					$cajaMovimiento->fechaMovimiento = date("Y-m-d H:i:s");
					if($saldo1!=$saldo2){
						if($cliente->nitCi!="000")
							$caja->saldo = $caja->saldo - $saldo2 + $saldo1;
						$cajaMovimiento->monto = $saldo1;
					}
					if($cliente->nitCi=="000")
					{
						$cajaMovimiento->tipo = -1;
						//añadir descuento
						if(empty($cajaMovimiento->monto)||$cajaMovimiento->monto==0)
							$cajaMovimiento->monto = $venta->montoVenta;
						$venta->montoVenta=0;
						$venta->montoPagado=0;
						$venta->montoCambio=0;
					}
					else
					{
						$cajaMovimiento->tipo = 0;
					}
					if($venta->save() && $cajaMovimiento->save())
						$caja->save();
					$swv=1;
				}	
			}
			$det=1;
			if(isset($_POST['DetalleVenta'])){
				$detalle2 = array();
				$i=0;
				$det=count($_POST['DetalleVenta']);
				foreach ($_POST['DetalleVenta'] as $item){	
					array_push($detalle2,new DetalleVenta);
					$detalle2[$i]->attributes = $item;
					if($detalle2[$i]->validate())
						$det--;
					$i++;
				}
			}
			
			if($swv==1 && $det==0)
			{
				foreach ($detalle as $item)
				{
					$almacenes = AlmacenProducto::model()->with('idProducto0')->findByPk($item->idAlmacenProducto);
					$almacenes->stockU = $almacenes->stockU + $item->cantidadU;
					while($almacenes->stockU>$almacenes->idProducto0->cantXPaquete)
					{
						$almacenes->stockP = $almacenes->stockP + 1;
						$almacenes->stockU = $almacenes->stockU - $almacenes->idProducto0->cantXPaquete;
					}
					$almacenes->stockP = $almacenes->stockP + $item->cantidadP;
					if($item->delete())
					{
						$almacenes->save();
					}
				}
				foreach ($detalle2 as $item)
				{
					$item->idVenta = $venta->idVenta;
					$almacenes = AlmacenProducto::model()->with('idProducto0')->findByPk($item->idAlmacenProducto);
					$almacenes->stockU = $almacenes->stockU - $item->cantidadU;
					while($almacenes->stockU<0)
					{
						$almacenes->stockP = $almacenes->stockP - 1;
						$almacenes->stockU = $almacenes->stockU + $almacenes->idProducto0->cantXPaquete;
					}
					$almacenes->stockP = $almacenes->stockP - $item->cantidadP;
					if($cliente->nitCi=="000")
					{
						$item->costoTotal=0;
					}
					if($item->save())
					{
						$almacenes->save();
					}
				}
				
				$this->redirect(array('preview',"id"=>$venta->idVenta));		
			}
			
			$this->render('notas',array(
				'productos'=>$productos,
				'cliente'=>$cliente,
				'detalle'=>$detalle,
				'venta'=>$venta,
			));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	public function actionPreview()
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
				$this->render('preview',array('venta'=>$ventas));
			else
				$this->redirect('index');
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	/*public function actionPreviewTest()
	{
		if(isset($_GET['id']))
		{
			$this->layout = 'print';
			//$mPDF1 = Yii::app()->ePdf->mpdf();
 			# You can easily override default constructor's params
	        //$mPDF1 = Yii::app()->ePdf->mpdf('', array('215.9','279.4')); //letter
			$mPDF1 = Yii::app()->ePdf->mpdf('', array('215.9','139.7'));
	       
	       $ventas = $this->verifyModel(Venta::model()
			->with("idCliente0")
			->with("detalleVentas")
			->with("detalleVentas.idAlmacenProducto0")
			->with("detalleVentas.idAlmacenProducto0.idProducto0")
			->with("idCajaMovimientoVenta0")
			->with("idCajaMovimientoVenta0.idUser0")
			->with("idCajaMovimientoVenta0.idUser0.idEmpleado0")
			->findByPk($_GET['id']));
	       	# render (full page)
			$mPDF1->WriteHTML($this->render('previewTest',array('venta'=>$ventas),true));
			# Outputs ready PDF
			$mPDF1->Output(date('d-m-Y H:i:s'), EYiiPdf::OUTPUT_TO_BROWSER);
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}*/
	
	public function actionDeudores()
	{
		$deudores = new CActiveDataProvider('Venta',
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
		$cond3="";
		$f="";
		$saldo="";
		$cf=array("distribuidora/movimientos",'f'=>0);
		$sf=array("distribuidora/movimientos",'f'=>1);
		$ventas = new Venta('searchDistribuidora');
		
		$ventas->unsetAttributes();
		if(isset($_GET['f']))
			$ventas->tipoVenta = $_GET['f'];
		
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
				$ventas->fechaVenta = $y."-".$m."-".$d;
				$cf=array("distribuidora/movimientos",'f'=>0,'d'=>$_GET['d']);
				$sf=array("distribuidora/movimientos",'f'=>1,'d'=>$_GET['d']);
				$cond3=array("distribuidora/previewDay","f"=>$ventas->tipoVenta,"d"=>$_GET['d']);
			}
			if(isset($_GET['m']))
			{
				$m=$_GET['m'];
				$ventas->fechaVenta = $y."-".$m;
				$cf=array("distribuidora/movimientos",'f'=>0,'m'=>$_GET['m']);
				$sf=array("distribuidora/movimientos",'f'=>1,'m'=>$_GET['m']);
				$cond3=array("distribuidora/previewDay","f"=>$ventas->tipoVenta,"m"=>$_GET['m']);
			}
		
		}
		
		
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
			$saldo = CajaArqueo::model()->find(array('condition'=>"idCaja=".$this->cajaDistribuidora." and fechaVentas<'".$ventas->fechaVenta."'",'order'=>'idCajaArqueo Desc'));
			//print_r($saldo);
			if(!empty($saldo))
				$saldo = $saldo->saldo;
		}
		
		//$this->render('movimientos',array('ventas'=>$ventas,'cond1'=>$cond1,'cond2'=>$cond2,'cond3'=>$cond3));
		$this->render('movimientos',array('ventas'=>$ventas,'saldo'=>$saldo,'cond3'=>$cond3,'cf'=>$cf,'sf'=>$sf));
	}
	
	public function actionMovimientosProducto()
	{
		$movimentoProducto=new DetalleVenta('searchVenta');
		//init filter
		$movimentoProducto->unsetAttributes();
		if (isset($_GET['DetalleVenta'])){
			//$movimentoProducto->attributes = $_GET['DetalleVenta'];
			$movimentoProducto->codigo=$_GET['DetalleVenta']['codigo'];
			$movimentoProducto->fecha=$_GET['DetalleVenta']['fecha'];
			//$movimentoProducto->apellido=$_GET['DetalleVenta'];
			$movimentoProducto->material=$_GET['DetalleVenta']['material'];
			$movimentoProducto->detalle=$_GET['DetalleVenta']['detalle'];
		}
		//end filter
		$this->render('movimientosProducto',array('ventas'=>$movimentoProducto));
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
					$fact=" and tipoVenta=0";
				}
				else
				{
					$fact=" and tipoVenta=1";
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
				$d= sprintf("%02s", $_GET['d']);
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
				$start=$y."-".$m."-01 00:00:00";
				$end=$y."-".$m."-".$d." 23:59:59";
			}
			$cond=" and '".$start."'<=fechaVenta AND fechaVenta<='".$end."'";
		}
		
		$caja = $this->verifyModel(Venta::model()
		->with('idCliente0')
		->with('detalleVentas')
		->with('detalleVentas.idAlmacenProducto0')
		->with('detalleVentas.idAlmacenProducto0.idProducto0')
		->with('idCajaMovimientoVenta0')
		->findAll(array('condition'=>'idCajaMovimientoVenta0.idCaja='.$this->cajaDistribuidora.' '.$fact.$cond)));
		//$tabla = $caja->ventas;
		$this->render("previewVentas",array('tabla'=>$caja,));
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
				$this->renderPartial('detalle',array('venta'=>$ventas));
			else
				$this->redirect(array('venta/venta'));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
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
							$this->redirect(array('distribuidora/notas'));
						}
					}
				}
			}
			$index=2;
			$this->renderPartial('distribuidora2',array('model'=>$model,'almacen'=>$almacen,'deposito'=>$deposito,'index'=>$index));
	
		}
		else
		{
			$productos = new AlmacenProducto('searchDistribuidoraP');
			//init filter
			$productos->unsetAttributes();
			if (isset($_GET['AlmacenProducto']))
			{
				$productos->attributes = $_GET['AlmacenProducto'];
				//$productos->color = $_GET['AlmacenProducto']['color'];
				$productos->material = $_GET['AlmacenProducto']['material'];
				$productos->marca = $_GET['AlmacenProducto']['marca'];
				$productos->detalle = $_GET['AlmacenProducto']['detalle'];
				$productos->codigo = $_GET['AlmacenProducto']['codigo'];
			}
			//end filter
			$index=1;
			$this->renderPartial('distribuidora2',array('productos'=>$productos,'index'=>$index));
		}
	}
	
	public function actionArqueo()
	{
		$arqueo = new CajaArqueo;
		$caja = Caja::model()->findByPk($this->cajaDistribuidora);
		if(isset($_POST['CajaArqueo']))
		{
			$arqueo->attributes = $_POST['CajaArqueo'];
			$arqueo->fechaArqueo = date("Y-m-d H:i:s");
			$arqueo->idUser = Yii::app()->user->id;
			$arqueo->idCaja = $this->cajaDistribuidora;
			$end=$arqueo->fechaVentas." 23:59:59";
			
			$movimiento = new CajaMovimientoVenta;
			$movimiento->motivo = "Traspaso de efectivo a Administracion";
			$comprovante = CajaArqueo::model()->find(array('select'=>'max(comprobante) as max','condition'=>'idCaja='.$this->cajaDistribuidora));
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
				$ventas=0;$recibos=0;
				$cajaMovimiento = CajaMovimientoVenta::model()->with('ventas')->with('reciboses')->findAll(array('condition'=>"`t`.idCaja=".$this->cajaDistribuidora." and tipo=0 and arqueo=0 and fechaMovimiento<='".$end."'"));
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
				
				$saldo = CajaArqueo::model()->find(array('condition'=>"idCaja=".$this->cajaDistribuidora,'order'=>'idCajaArqueo Desc'));
				if(empty($saldo))
					$saldo = 0;
				else
					$saldo = $saldo->saldo;
				
				$arqueo->saldo = round($saldo+$ventas+$recibos-$movimiento->monto,1, PHP_ROUND_HALF_UP);
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
							//$cajaMovimiento = CajaMovimientoVenta::model()->findAll(array('condition'=>"`t`.idCaja=2 and arqueo=0 and '".$start."'<=fechaMovimiento AND fechaMovimiento<='".$end."'"));
							$cajaMovimiento = CajaMovimientoVenta::model()->findAll(array('condition'=>"`t`.idCaja=".$this->cajaDistribuidora." and tipo=0 and arqueo=0 and fechaMovimiento<='".$end."'"));
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
			//if(!$movimiento->validate())
				//print_r($movimiento);
			//if(!$arqueo->validate())
				//print_r($arqueo->attributes);
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
			$cajaMovimiento = CajaMovimientoVenta::model()->with('reciboses')->with('ventas')->findAll(array('condition'=>"`t`.idCaja=".$this->cajaDistribuidora." and tipo=0 and arqueo=0 and fechaMovimiento<='".$end."'",'order'=>'fechaMovimiento Desc'));
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
			$saldo = CajaArqueo::model()->find(array('condition'=>"idCaja=".$this->cajaDistribuidora,'order'=>'idCajaArqueo Desc'));
			if(empty($saldo))
				$saldo = 0;
			else
				$saldo = $saldo->saldo;
			$this->render("arqueo",
					array(
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
									'condition'=>'idCaja='.$this->cajaDistribuidora,
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
						->find(array('condition'=>'idCajaArqueo='.$_GET['id'].' and cajaMovimientoVenta.tipo=0 and `t`.idCaja='.$this->cajaDistribuidora,'order'=>'cajaMovimientoVenta.fechaMovimiento Desc'));
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
			$venta = Venta::model()
						->with('idCajaMovimientoVenta0')
						->findAll(array('condition'=>"fechaVenta>='".$start."' and fechaVenta<='".date("Y-m-d",strtotime($arqueo->fechaVentas))." 23:59:59' and idCajaMovimientoVenta0.tipo=0"));
			$ventas = 0;
			
			foreach ($venta as $item)
			{
				$ventas=$ventas+$item->idCajaMovimientoVenta0->monto;
			}
			
			$recibo = Recibos::model()
			->with('idCajaMovimientoVenta0')
			->findAll(array('condition'=>"fechaRegistro	>='".$arqueo->fechaVentas."' and fechaRegistro<='".date("Y-m-d",strtotime($arqueo->fechaVentas))." 23:59:59' and idCajaMovimientoVenta0.tipo=0 and idCajaMovimientoVenta0.idcaja=".$this->cajaDistribuidora));
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
	
	
	//acciones con ajax
	//init
	public function actionAjaxCliente()
	{
		if(Yii::app()->request->isAjaxRequest && isset($_GET['nitCi']))
		//if(isset($_GET['nitCi']))
		{
			$cliente = Cliente::model()->with('ventas')->find('nitCi='.$_GET['nitCi']);
			$deuda=false;
			if($cliente===null)
			{
				$cliente = CJSON::encode(array("nitCi"=>"","apellido"=>""));
				$cliente = array('cliente'=>$cliente,'deuda'=>$deuda);
			}
			else
			{
				foreach ($cliente->ventas as $item)
				{
					if($item->montoVenta > $item->montoPagado)
					{
						$deuda=true;
						break;
					}
				}
				$cliente = CJSON::encode($cliente);
				$cliente = array('cliente'=>$cliente,'deuda'=>$deuda);
			}
			echo CJSON::encode($cliente);
		}
	}
	
	public function actionAddDetalle()
	{
		//if(Yii::app()->request->isAjaxRequest && isset($_GET['index']))
		if(isset($_GET['index']))
		{
			$detalle = new DetalleVenta;
			$almacen = new AlmacenProducto;
			if(isset($_GET['al']))
			{
				$almacen = AlmacenProducto::model()
							->with("idProducto0")
							->findByPk($_GET['al']);	
	
			}
			
			$detalle->idAlmacenProducto = $almacen->idAlmacenProducto;
			if(isset($_GET['factura']))
			{
				if($_GET['factura']==0)
				{
					$detalle->costoP = $almacen->idProducto0->precioCFP;
					$detalle->costoU = $almacen->idProducto0->precioCFU;
				}
				else
				{
					$detalle->costoP = $almacen->idProducto0->precioSFP;
					$detalle->costoU = $almacen->idProducto0->precioSFU;
				}
			}
				
			$this->renderPartial('_newRowDetalleVenta', array(
					'model'=>$detalle,
					'index'=>$_GET['index'],
					'almacen'=>$almacen,
			));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
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
		
		if(isset($_POST['detalle']))
		{
			//$detalles = $_POST['detalle'];
			foreach ($_POST['detalle'] as $key => $item)
			{
				$detalles[$key] = $item; 
			}
			
			$resultado = array();
			
			foreach ($detalles as $key => $item)
			{
				$almacen = AlmacenProducto::model()->with('idProducto0')->findByPk($item['idAlmacenProducto']);
				$producto = $almacen->idProducto0;
				//$resutado[$item['index']]=CJSON::encode($producto);
				$resultado[$key]['index']=$item['index'];
				if($tipo == 0){
					$resultado[$key]['precioU']=$almacen->idProducto0->precioCFU;
					$resultado[$key]['precioP']=$almacen->idProducto0->precioCFP;
				}
				else{
					$resultado[$key]['precioU']=$almacen->idProducto0->precioSFU;
					$resultado[$key]['precioP']=$almacen->idProducto0->precioSFP;
				}
			}
			
			$row = Venta::model()->find(array("condition"=>"tipoVenta=".$tipo,'order'=>'fechaVenta Desc'));
			if(empty($row))
				$row=new Venta;
			if(empty($row->serie) && $tipo==1)
				$row->serie = 65;
			$numero = $row->numero +1;
			if($row->numero==1001 && $tipo==1){
				$row->numero;
				$row->serie++;
				if($row->serie==91)
					$row->serie = 65;
			}
			$serie = $row->serie;
			$codigo="";
			if($tipo==1)
				$codigo = chr($serie)."P-".$numero."-".date("y");
			else
				$codigo = $numero."-P";
			
			$resultado['codigo']=$codigo;
			echo CJSON::encode($resultado);
		}
		
	}

	//end
	
	public function actionEnvio()
	{
		$productos = new AlmacenProducto('searchDistribuidora');
		$envio = new EnvioMaterial;
		$envio = new DetalleEnvio;
		
		//init filter
		$productos->unsetAttributes();
		if (isset($_GET['AlmacenProducto'])){
			$productos->attributes = $_GET['AlmacenProducto'];
			$productos->color = $_GET['AlmacenProducto']['color'];
			$productos->material = $_GET['AlmacenProducto']['material'];
			$productos->marca = $_GET['AlmacenProducto']['marca'];
			$productos->paquete = $_GET['AlmacenProducto']['paquete'];
			$productos->detalle = $_GET['AlmacenProducto']['detalle'];
			$productos->codigo = $_GET['AlmacenProducto']['codigo'];
		}
		//end filter
		if(isset($_POST['EnvioMaterial']))
		{
			
			if(isset($_POST['EnvioMaterial']))
			{
				
			}	
			
			if(isset($_POST['EnvioMaterial']))
			{
					
			}
		}
		
		$this->render();
	}
	
	public function actionEnvios()
	{
		/*$envios=new CActiveDataProvider('EnvioMaterial',
				array(
						'criteria'=>array(
								'order'=>'fechaEnvio Desc',
						),
						'pagination'=>array(
								'pageSize'=>'20',
						),
				));*/
		$envios = new EnvioMaterial('search');
		$this->render("envios",array("envios"=>$envios));
	}
	
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
	
		return $model;
	}
	
	protected function getRemoveLinkAndIndexInput($index)
	{
		$removeLink=CHtml::link('Quitar', '#', array('class'=>'btn btn-danger tabular-input-remove')).'<input type="hidden" class="tabular-input-index" value="'.$index.'" />';
		$removeLink=strtr("<td>{link}</td>", array('{link}'=>$removeLink));
		return $removeLink;
	}
	
	protected function getUltimoDiaMes($elAnio,$elMes) {
		return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
	}
}
