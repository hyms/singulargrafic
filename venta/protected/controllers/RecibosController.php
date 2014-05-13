<?php

class RecibosController extends Controller
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

	public function actionIngreso()
	{
		$cliente = new Cliente;
		$recibo = new Recibo;
		$venta = new Venta;
		$empleado = Empleado::model()->with('Users')->find('idUsers='.Yii::app()->user->id);
		
		$row = Recibo::model()->find(array("select"=>"count(*) as `max`",'condition'=>'tipo=1'));
		
		$recibo->fecha = date("Y-m-d h:m:s");
		$recibo->codigo = "I-".date("m")."-".($row['max']+1);
		$recibo->tipo = 1;
		$recibo->idEmpleado = $empleado->id;
		
		$caja = Caja::model()->find(array('condition'=>'arqueo=0 and entregado=0 and nombre like "papeles"','order'=>'id Desc'));
		$recibo->idCaja = $caja->id;
		
		if(isset($_POST['Recibo']))
		{
			$recibo->attributes = $_POST['Recibo'];
			$cliente->attributes = $_POST['Cliente'];
			$cliente = Cliente::model()->find("nitCi='".$cliente->nitCi."'");
			$recibo->idCliente = $cliente->id;
			$venta = Venta::model()->find("codigo='".$recibo->nro."'");
			if($venta!=null)
				$recibo->idVenta = $venta->id;
			
			if($recibo->validate())
			{
				$caja->saldo = $caja->saldo+$recibo->monto;
				if($recibo->save())
					if($caja->save())
						$this->redirect('index');
			}	
			
		}	 
		$this->render("ingreso",array(
									'cliente'=>$cliente,
									'recibo'=>$recibo,
									'venta'=>$venta,
									));
	}
	
	public function actionEgreso()
	{
		$cliente = new Cliente;
		$recibo = new Recibo;
		$empleado = Empleado::model()->with('Users')->find('idUsers='.Yii::app()->user->id);
		
		$row = Recibo::model()->find(array("select"=>"count(*) as `max`",'condition'=>'tipo=0'));
		
		$recibo->fecha=date("Y-m-d h:m:s");
		$recibo->codigo = "E-".date("m")."-".($row['max']+1);
		$recibo->tipo=0;
		$recibo->idEmpleado = $empleado->id;
		$recibo->responsable="Miriam Martinez";
		
		$caja = Caja::model()->find(array('condition'=>'arqueo=0 and entregado=0 and nombre like "papeles"','order'=>'id Desc'));
		$recibo->idCaja = $caja->id;
		
		if(isset($_POST['Recibo']))
		{
			$recibo->attributes=$_POST['Recibo'];
			if($recibo->validate())
			{
				$caja->saldo = $caja->saldo-$recibo->acuenta;
				if($caja->saldo>=0)
				{
					if($recibo->save())
						if($caja->save())
							$this->redirect('index');
				}
				else
				{
					$recibo->addError('acuenta','No existen suficientes fondos');
				}
			}
		}
		$this->render("egreso",array(
				'cliente'=>$cliente,
				'recibo'=>$recibo,
					
		));
	}
	
	public function actionIndex()
	{
		$condition = "tipo=0 or tipo=1";
		if(isset($_GET['t']))
		{
			if($_GET['t']=="e")
				$condition = "tipo=0";
				
			if($_GET['t']=="i")
				$condition = "tipo=1";
		}
		$recibo = new CActiveDataProvider('Recibo',
				array('criteria'=>array(
					'with'=>array('Cliente'),
					'order'=>'fecha DESC',
					'condition'=>$condition,
					),
					'pagination'=>array(
						'pageSize'=>20,
				),));
		$this->render('index',array('recibo'=>$recibo,'titulo'=>"Recibos Realizados"));
		
	}
	
	public function actionPreview()
	{
		if(isset($_GET['id']))
		{
			$recibo = Recibo::model()
							->with("Cliente")
							->with("Venta")
							->with("Venta.Detalle")
							->with("Venta.Detalle.Almacen")
							->with("Venta.Detalle.Almacen.Producto")
							->with("Venta.Detalle.Almacen.Producto.Color")
							->with("Venta.Detalle.Almacen.Producto.Material")
							->with("Empleado")
							->findByPk($_GET['id']);
				
			if($recibo!=null)
				$this->render('preview',array('recibo'=>$recibo));
			else
				$this->redirect('index');
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	public function actionLlenado()
	{
		if(Yii::app()->request->isAjaxRequest && isset($_GET['nitCi']))
		//if(isset($_GET['nitCi']))
		{
			//$cliente = $this->verifyModel(Cliente::model()->find('nitCi='.$_GET['nitCi']));
		
			$credito = Credito::model()
						->with('Cliente')
						->with('Venta')
						->with('Venta.Detalle')
						->with('Venta.Detalle.Almacen')
						->with('Venta.Detalle.Almacen.Producto')
						->with('Venta.Detalle.Almacen.Producto.Color')
						->with('Venta.Detalle.Almacen.Producto.Material')
						->find("nitCi='".$_GET['nitCi']."' and saldo>0",array('order'=>'fechaPlazo Desc'));
			
			$concepto="Pago por ";
			$i=0;
			foreach ($credito->Venta->Detalle as $item)
			{
				$i++;
				$concepto=$concepto.$item->Almacen->Producto->Material->nombre." ".$item->Almacen->Producto->Color->nombre." ".$item->Almacen->Producto->peso." ".$item->Almacen->Producto->dimension." U:".$item->cantUnidad." P:".$item->cantPaquete;
				if($i>1)
					$concepto=$concepto."; ";
			}
			
			$data = array(
					"Credito"=>$credito->attributes,
					"Cliente"=>$credito->Cliente->attributes,
					"Venta"=>$credito->Venta->attributes,
					"categoria"=>($credito->Venta->codigo!="")?"Nota de Venta":"",
					"concepto"=>($credito->Venta->codigo!="")?$concepto:"",
					);
			echo CJSON::encode($data);
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
}