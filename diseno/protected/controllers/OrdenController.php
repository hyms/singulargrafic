<?php

class OrdenController extends Controller
{
	
	public function filters()
	{
		return array( 'accessControl' ); // perform access control for CRUD operations
	}
	
	public function accessRules() {
		return array(
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						//'actions'=>array('index'),
						'expression'=>'isset($user->role) && ($user->role==="4")',
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
		$this->render('index',array('render'=>''));
	}
	
	public function actionCliente()
	{
		$cliente = new Cliente;
		$detalle = new DetalleCTP;
		$ctp = new CTP;
		$productos = new AlmacenProducto('searchCTP');
		
		$ctp->codigo = $this->getCodigo(1);
		$ctp->fechaOrden = date("Y-m-d H:i:s");
		$ctp->idUserOT= Yii::app()->user->id;
		$ctp->tipoCTP = 1;
		$swc=0; $swv=0;
		if(isset($_POST['Cliente']))
		{
			$cliente = Cliente::model()->find('nitCi="'.$_POST['Cliente']['nitCi'].'"');
			if($cliente==null)
				$cliente = new Cliente;
		
			$cliente->attributes = $_POST['Cliente'];
			
			if($cliente->isNewRecord)
			{
				$cliente->fechaRegistro = date("Y-m-d");
			}
            if(empty($cliente->idTiposClientes))
            {
                    $tmp = TiposClientes::model()->find('`nombre`="nuevo"');
                    $cliente->idTiposClientes = $tmp->idTiposClientes;
            }
			if($cliente->validate())
				$swc=1;
		}
		
		if(isset($_POST['CTP']))
		{
			$ctp->attributes = $_POST['CTP'];
			$ctp->estado = 1;
			
			if($ctp->validate())
				$swv=1;
		}
		
		if(isset($_POST['DetalleCTP']))
		{
			$detalle = array();
			$det=count($_POST['DetalleCTP']);
			foreach ($_POST['DetalleCTP'] as $key=>$item)
			{
				array_push($detalle,new DetalleCTP);
				$detalle[$key]->attributes = $item;
				$almacen = AlmacenProducto::model()->with('idProducto0')->findByPk($detalle[$key]->idAlmacenProducto);
				$detalle[$key]->formato = $almacen->idProducto0->color;
					
				if($detalle[$key]->validate())
				{
					$det--;
				}
			}
		}
		
		if($swc==1 && $swv==1 && $det==0)
		{
            $cliente->save();
			$ctp->idCliente = $cliente->idCliente;
		
			if($ctp->save())
			{
				foreach($detalle as $item)
				{
					$item->idCTP = $ctp->idCTP;
					$item->save();
				}
				$this->redirect(array('orden/buscar'));
			}
		}
		
		$this->render('index',array('render'=>'new','cliente'=>$cliente,'detalle'=>$detalle,'ctp'=>$ctp,'productos'=>$productos));
	}
	
	public function actionInterna()
	{
		$cliente = new Cliente;
		$detalle = new DetalleCTP;
		$ctp = new CTP;
		$productos = new AlmacenProducto('searchCTP');
		
		$row = CTP::model()->find(array("condition"=>"tipoCTP=2",'order'=>'fechaOrden Desc'));
		if(empty($row))
			$row=new CTP;
		$ctp->numero = $row->numero +1;
		$ctp->codigo = "CI-".$ctp->numero;
		$ctp->formaPago = 1;
		$ctp->tipoOrden = 1;
		$ctp->fechaOrden = date("Y-m-d H:i:s");
		$ctp->idUserOT= Yii::app()->user->id;
		$ctp->tipoCTP = 2;
		$ctp->estado =1;
		
		$det=0;$c=0;$swc=1;
		
		if(isset($_POST['Cliente']))
		{
			$cliente = Cliente::model()->find('nitCi="'.$_POST['Cliente']['nitCi'].'"');
			if($cliente==null)
				$cliente = new Cliente;
		
			$cliente->attributes = $_POST['Cliente'];
            if($cliente->isNewRecord)
				$cliente->fechaRegistro = date("Y-m-d");
			if($cliente->save())
				$swc=1;
		}
		
		if(isset($_POST['CTP']))
		{
			$ctp->attributes=$_POST['CTP'];
			$ctp->estado = 1;
				
			if($ctp->validate())
				$c=1;
		}
		
		if(isset($_POST['DetalleCTP']))
		{
			$detalle = array();
			$i=0;
			$det=count($_POST['DetalleCTP']);
			foreach ($_POST['DetalleCTP'] as $item)
			{
				array_push($detalle,new DetalleCTP);
				$detalle[$i]->attributes = $item;
				$almacen = AlmacenProducto::model()->with('idProducto0')->findByPk($detalle[$i]->idAlmacenProducto);
				$detalle[$i]->formato = $almacen->idProducto0->color;
				if($detalle[$i]->validate())
				{
					$det--;
				}
				$i++;
			}
		}
		//print_r($detalle);
		if($swc==1 && $c==1 && $det==0)
		{
			$ctp->idCliente = $cliente->idCliente;
		
			if($ctp->save())
			{
				foreach($detalle as $item)
				{
					$item->idCTP = $ctp->idCTP;
					$item->save();
				}
				$this->redirect(array('orden/buscar'));
			}
		}
		
		$this->render('index',array('render'=>'interna','cliente'=>$cliente,'detalle'=>$detalle,'ctp'=>$ctp,'productos'=>$productos));
	}
	
	public function actionRep()
	{
		$ordenes=new CActiveDataProvider('CTP',array(
				'criteria'=>array(
				'condition'=>'tipoCTP!=3 and estado=1',
						),
				'pagination'=>array(
						'pageSize'=>'20',
				),));
		$this->render('index',array('render'=>'rep','ordenes'=>$ordenes));
	}
	
	public function actionRepOrden()
	{
		if(isset($_GET['id']))
		{
			$ctp = $this->verifyModel(CTP::model()->with('detalleCTPs')->findByPk($_GET['id']));
			$repos = new CTP;
			$detalle = array();
			$otro =""; $falla="";
			if(isset($_POST['CTP']) && isset($_POST['DetalleCTP']))
			{
				$row = CTP::model()->find(array("condition"=>"tipoCTP=3",'order'=>'fechaOrden Desc'));
				if(empty($row))
					$row=new CTP;
				$repos->numero = $row->numero +1;
				
				$repos->codigo = "CR-".$repos->numero;
				$repos->attributes=$_POST['CTP'];
				$repos->tipoCTP = 3;
				$repos->fechaOrden = date("Y-m-d H:i:s");
				$repos->idUserOT= Yii::app()->user->id;
				$repos->estado=1;
				$repos->idCTPParent=$ctp->idCTP;
				if($repos->responsable=="Otro")
				{
					$otro=$_POST['respOtro'];
					$repos->responsable = $otro;
					$falla = new FallasCTP;
					$falla->nombre = $otro;
					$falla->fecha = date("Y-m-d H:i:s");
					$falla->costoT=0;
				}
				$i=0;$c=0;
				foreach ($_POST['DetalleCTP'] as $item)
				{
					array_push($detalle,new DetalleCTP);
					$detalle[$i]->attributes=$item;
					$almacen= AlmacenProducto::model()->with("idProducto0")->find('idProducto0.detalle="'.$detalle[$i]->formato.'"');
					$detalle[$i]->idAlmacenProducto=$almacen->idAlmacenProducto;
					$costo= MatrizPreciosCTP::model()->find('idTiposClientes=1 and idHorario=1 and idCantidad=1 and idAlmacenProducto='.$detalle[$i]->idAlmacenProducto);
					$detalle[$i]->costo = $costo->precioSF;
					if(!empty($falla))
						$falla->costoT=$falla->costoT+($detalle[$i]->nroPlacas*$detalle[$i]->costo);
					$detalle[$i]->costoTotal = $detalle[$i]->nroPlacas*$detalle[$i]->costo;
					if($detalle[$i]->validate())
						$c++;
					$i++;
				}
				if(!empty($falla))
					$repos->montoVenta=$falla->costoT;
				if($repos->validate() && ($c==$i) && !empty($repos->obs) && !empty($repos->responsable))
				{
					$repos->save();
					
					foreach ($detalle as $item)
					{
						$item->idCTP=$repos->idCTP;
						if(!empty($falla))
							$falla->idCtpRep = $repos->idCTP;
						$item->save();
					}
					if(!empty($falla))
						$falla->save();
					//print_r($detalle);
					$this->redirect(array('orden/rep'));
				}
					
			}
			$this->render('index',array('render'=>'repos','ctp'=>$ctp,'repos'=>$repos,'detalle'=>$detalle,'otro'=>$otro));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	public function actionBuscar()
	{
		$ordenes=new CActiveDataProvider('CTP',array(
				'criteria'=>array(
						'condition'=>'estado=1 and tipoCTP!=3',
						'with'=>array('idCliente0'),
						'order'=>'fechaOrden Desc',
				),
				'pagination'=>array(
						'pageSize'=>'20',
				),));
		$this->render('index',array('render'=>'buscar','ordenes'=>$ordenes));
	}
	
	public function actionBuscarR()
	{
		$ordenes=new CActiveDataProvider('CTP',array(
				'criteria'=>array(
						'condition'=>'estado=1 and tipoCTP=3',
						'with'=>array('idCliente0'),
						'order'=>'fechaOrden Desc',
				),
				'pagination'=>array(
						'pageSize'=>'20',
				),));
		$this->render('index',array('render'=>'buscarR','ordenes'=>$ordenes));
	}
	
	public function actionModificar()
	{
		if(isset($_GET['id']))
		{
			$ctp = $this->verifyModel(CTP::model()->with('idCliente0')->with('detalleCTPs')->findByPk($_GET['id']));
			$sw=0;
			if(isset($_POST['Cliente']))
			{
				$cliente = Cliente::model()->find('nitCi="'.$_POST['Cliente']['nitCi'].'"');
				if($cliente==null)
					$cliente = new Cliente;
			
				$cliente->attributes = $_POST['Cliente'];
                if($cliente->isNewRecord)
                {
                    $tmp = TiposClientes::model()->find('`nombre`="nuevo"');
                    $cliente->idTiposClientes = $tmp->idTiposClientes;
                    $cliente->fechaRegistro = date("Y-m-d");
                }
				if($cliente->save())
					$swc=1;
			}
			
			if(isset($_POST['CTP']))
			{
				$orden = CTP::model()->findByPk($ctp->idCTP);
				$orden->attributes = $_POST['CTP'];
				if(!empty($cliente->idCliente))
					$ctp->idCliente = $cliente->idCliente;
				
				$user = Users::model()->with('idEmpleado0')->findByPk(Yii::app()->user->id);
				$orden->obs = $orden->obs."(Modificado por el usuario ".$user->username." (".$user->idEmpleado0->nombre." ".$user->idEmpleado0->apellido."))";
				
				if($orden->save())
					$sw=1;
				//print_r($_POST['CTP']);
			}

			if(isset($_POST['DetalleCTP']))
			{
				$detalles = DetalleCTP::model()->findAll("idCTP=".$ctp->idCTP);
				if($ctp->estado==1)
				{
					foreach ($detalles as $item)
						$item->delete();
				}
				if($ctp->estado==2)
				{
					foreach ($detalles as $item)
					{
						$almacenes = AlmacenProducto::model()->findByPk($item->idAlmacenProducto);
						$almacenes->stockU = $almacenes->stockU + $item->nroPlacas;
						if($almacenes->save())
							$item->delete();
					}
				}
				$detalle = array();
				foreach ($_POST['DetalleCTP'] as $key=>$item)
				{
					$detalle[$key] = New DetalleCTP;
					$detalle[$key]->attributes=$item;
					$almacen = AlmacenProducto::model()->with('idProducto0')->findByPk($detalle[$key]->idAlmacenProducto);
					$detalle[$key]->formato = $almacen->idProducto0->color;
					$detalle[$key]->idCTP=$ctp->idCTP;
					$detalle[$key]->save();
				}
				$ctp->detalleCTPs = $detalle;
				$sw=1;
				//print_r($detalle);
			}
			if($sw==1)
				$ctp = $this->verifyModel(CTP::model()->with('idCliente0')->with('detalleCTPs')->findByPk($_GET['id']));
			
			if($ctp->tipoCTP==1)
			{
				$productos = new AlmacenProducto('searchCTP');  
				$this->render('cliente',array('cliente'=>$ctp->idCliente0,'detalle'=>$ctp->detalleCTPs,'ctp'=>$ctp,'productos'=>$productos));
			}
			if($ctp->tipoCTP==2)
			{
				$productos = new AlmacenProducto('searchCTP');
				$this->render('interna',array('cliente'=>$ctp->idCliente0,'detalle'=>$ctp->detalleCTPs,'ctp'=>$ctp,'productos'=>$productos));
			}
			if($ctp->tipoCTP==3)
			{
				$ctpB = CTP::model()->with('idCliente0')->with('detalleCTPs')->findByPk($ctp->idCTPParent);
				$this->render('repo/repos',array('ctp'=>$ctpB,'repos'=>$ctp,'detalle'=>$ctp->detalleCTPs,'otro'=>""));
			}
			//print_r($ctp);
		}
		else
			throw new CHttpException(400,'Petición no válida.');
		//$this->redirect(array('orden/buscar'));
	}
	
	public function actionModificarR()
	{
		if(isset($_GET['id']))
		{
			$ctp = $this->verifyModel(CTP::model()->with('idCliente0')->with('detalleCTPs')->findByPk($_GET['id']));
			$sw=0;
				
			if(isset($_POST['CTP']))
			{
				$orden = CTP::model()->findByPk($ctp->idCTP);
				$orden->attributes = $_POST['CTP'];
				
				$user = Users::model()->with('idEmpleado0')->findByPk(Yii::app()->user->id);
				$orden->obs = "Modificado por el usuario ".$user->username." (".$user->idEmpleado0->nombre." ".$user->idEmpleado0->apellido.")";
	
				if($orden->save())
					$sw=1;
				//print_r($_POST['CTP']);
			}
	
			if(isset($_POST['DetalleCTP']))
			{
				$detalles = DetalleCTP::model()->findAll("idCTP=".$ctp->idCTP);
				if($ctp->estado==1)
				{
					foreach ($detalles as $item)
						$item->delete();
				}
				if($ctp->estado==2)
				{
					foreach ($detalles as $item)
					{
						$almacenes = AlmacenProducto::model()->findByPk($item->idAlmacenProducto);
						$almacenes->stockU = $almacenes->stockU + $item->nroPlacas;
						if($almacenes->save())
							$item->delete();
					}
				}
				$detalle = array();$i=0;
				foreach ($_POST['DetalleCTP'] as $item)
				{
					array_push($detalle,New DetalleCTP);
					$detalle[$i]->attributes=$item;
					$almacen= AlmacenProducto::model()->with("idProducto0")->find('idProducto0.detalle="'.$detalle[$i]->formato.'"');
					$detalle[$i]->idAlmacenProducto=$almacen->idAlmacenProducto;
					$detalle[$i]->idCTP=$ctp->idCTP;
					$detalle[$i]->save();
					$i++;
				}
				$sw=1;
				//print_r($_POST['DetalleCTP']);
			}
			if($sw==1)
				$ctp = $this->verifyModel(CTP::model()->with('idCliente0')->with('detalleCTPs')->findByPk($_GET['id']));
				
			if($ctp->tipoCTP==3)
			{
				$ctpB = CTP::model()->with('idCliente0')->with('detalleCTPs')->findByPk($ctp->idCTPParent);
				$this->render('repo/repos',array('ctp'=>$ctpB,'repos'=>$ctp,'detalle'=>$ctp->detalleCTPs,'otro'=>""));
			}
			//print_r($ctp);
		}
		else
			throw new CHttpException(400,'Petición no válida.');
		//$this->redirect(array('orden/buscar'));
	}
	
	public function actionAddDetalle()
	{
		//if(Yii::app()->request->isAjaxRequest && isset($_GET['index']))
		if(isset($_GET['index']))
		{
			$detalle = new DetalleCTP;
			$almacen = new AlmacenProducto;
			$costo = 0;
			if(isset($_GET['al']))
			{
				$almacen = AlmacenProducto::model()
				->with("idProducto0")
				->findByPk($_GET['al']);
				$costo = $almacen->idProducto0->precioCFU;
				
			}
			//print_r($almacen);
			$detalle->idAlmacenProducto = $almacen->idAlmacenProducto;
			if(isset($_GET['factura']))
			{
				if($_GET['factura']==0)
				{
					$costo = $almacen->idProducto0->precioCFU;
				}
				else
				{
					$costo = $almacen->idProducto0->precioSFU;
				}
			}
	
			$this->renderPartial('orden/_newRowDetalleVenta', array(
					'model'=>$detalle,
					'costo'=>$costo,
					'index'=>$_GET['index'],
					'almacen'=>$almacen,
			));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	public function actionAddDetalleI()
	{
		//if(Yii::app()->request->isAjaxRequest && isset($_GET['index']))
		if(isset($_GET['index']))
		{
			$detalle = new DetalleCTP;
			$almacen = new AlmacenProducto;
			$costo = 0;
			if(isset($_GET['al']))
			{
				$almacen = AlmacenProducto::model()
				->with("idProducto0")
				->findByPk($_GET['al']);	
			}
	
			$detalle->idAlmacenProducto = $almacen->idAlmacenProducto;
			
			$this->renderPartial('ointerna/_newRowDetalleVenta', array(
					'model'=>$detalle,
					'index'=>$_GET['index'],
					'almacen'=>$almacen,
			));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	public function actionAddDetalleR()
	{
		//if(Yii::app()->request->isAjaxRequest && isset($_GET['index']))
		if(isset($_GET['index']) && isset($_GET['id']))
		{
			$detalle = DetalleCTP::model()->findByPk($_GET['id']);
			$costo = 0;
			$costo= MatrizPreciosCTP::model()->find('idTiposClientes=1 and idHorario=1 and idCantidad=1 and idAlmacenProducto='.$detalle->idAlmacenProducto);
			$detalle->costo = $costo->precioSF;
			
			//print_r($detalle);
			//return;
			$almacen = AlmacenProducto::model()
				->with("idProducto0")
				->findByPk($detalle->idAlmacenProducto);
			
	
			//$detalle->idAlmacenProducto = $almacen->idAlmacenProducto;
				
			$this->renderPartial('repo/_newRowDetalleRepos', array(
					'model'=>$detalle,
					'index'=>$_GET['index'],
					//'almacen'=>$almacen,
			));
		}
		else
			throw new CHttpException(400,'Petición no válida.');
	}
	
	public function actionAjaxCliente()
	{
		if(Yii::app()->request->isAjaxRequest && isset($_GET['nitCi']))
		//if(isset($_GET['nitCi']))
		{
			//$cliente = $this->verifyModel(Cliente::model()->with('cTPs')->find('nitCi='.$_GET['nitCi']));
			$cliente = $this->verifyModel(Cliente::model()->find('nitCi='.$_GET['nitCi']));
			$deuda=false;
			/*foreach ($cliente->cTPs as $item)
			{
				if($item->montoVenta > $item->montoPagado)
				{
					$deuda=true;
					break;
				}
			}*/
			$cliente = CJSON::encode($cliente);
			$cliente = array('cliente'=>$cliente,'deuda'=>$deuda);
			echo CJSON::encode($cliente);
		}
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
	
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
	
		return $model;
	}
	
	private function getCodigo($tipo)
    {
        $row = CTP::model()->find(array('condition'=>"tipoCTP=".$tipo." and fechaOrden like '%".date('Y-m-d')."%'",'select'=>'count(*) as max'));
        $codigoTMP =($row->max+1)."-".date('md');
        return $codigoTMP;
    }

}
