<?php

class OrdenController extends Controller
{
	protected $sucursal;
    protected $almacen;

    public function init()
    {
        $this->sucursal =  Yii::app()->user->getState('idSucursal');
        if(!empty($this->sucursal))
        {
            $this->almacen = Almacen::model()->find('idSucursal='.$this->sucursal.' and nombre like "CTP%"');
            if(!empty($this->almacen))
                $this->almacen = $this->almacen->idAlmacen;
            else
                throw new CHttpException(500,'Page not found.');
        }
        parent::init();
    }

	public function filters()
	{
		return array( 'accessControl' ); // perform access control for CRUD operations
	}
	
	public function accessRules() {
		return array(
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						//'actions'=>array('index'),
						'expression'=>'isset($user->role) && ($user->role===4)',
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'expression'=>'isset($user->role) && ($user->role<=2)',
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
        $productos->idAlmacen = $this->almacen;
        $productos->material = "PLACAS CTP";

        $ctp->idSucursal = $this->sucursal;
        $ctp->tipoCTP = 1;
		$ctp->codigo = $this->getCodigo($ctp->tipoCTP);
		$ctp->fechaOrden = date("Y-m-d H:i:s");
		$ctp->idUserOT = Yii::app()->user->id;

		$swc=0; $swv=0;
		if(isset($_POST['Cliente']))
		{
			$cliente = $this->saveCliente($_POST['Cliente']);
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
			$det = count($_POST['DetalleCTP']);
			foreach ($_POST['DetalleCTP'] as $key=>$item)
			{
				$detalle[$key] = new DetalleCTP;
				$detalle[$key]->attributes = $item;
				$almacen = AlmacenProducto::model()->with('idProducto0')->findByPk($detalle[$key]->idAlmacenProducto);
				$detalle[$key]->formato = $almacen->idProducto0->color;
					
				if($detalle[$key]->validate())
					$det--;
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
        $productos->idAlmacen = $this->almacen;
        $productos->material = "PLACAS CTP";

        $ctp->tipoCTP = 2;
        $ctp->idSucursal = $this->sucursal;
        $ctp->formaPago = 1;
        $ctp->tipoOrden = 1;
        $ctp->fechaOrden = date("Y-m-d H:i:s");
        $ctp->idUserOT= Yii::app()->user->id;
        $ctp->estado =1;
		$row = CTP::model()->find(array("condition"=>"tipoCTP=".$ctp->tipoCTP." and idSucursal=".$ctp->idSucursal,'order'=>'fechaOrden Desc'));
		if(empty($row))
			$row=new CTP;
		$ctp->numero = $row->numero +1;
		$ctp->codigo = "CI-".$ctp->numero;

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
			$det=count($_POST['DetalleCTP']);
			foreach ($_POST['DetalleCTP'] as $key=>$item)
			{
				$detalle[$key]=new DetalleCTP;
				$detalle[$key]->attributes = $item;
				$almacen = AlmacenProducto::model()->with('idProducto0')->findByPk($detalle[$key]->idAlmacenProducto);
				$detalle[$key]->formato = $almacen->idProducto0->color;
				if($detalle[$key]->validate())
					$det--;
			}
		}

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

	public function actionBuscar()
	{
		$ordenes=new CActiveDataProvider('CTP',array(
				'criteria'=>array(
						'condition'=>'estado=1 and tipoCTP!=3 and idSucursal='.$this->sucursal,
						'with'=>array('idCliente0'),
						'order'=>'fechaOrden Desc',
				),));
		$this->render('index',array('render'=>'buscar','ordenes'=>$ordenes));
	}

	public function actionModificar()
	{
		if(isset($_GET['id']))
		{
			$ctp = $this->verifyModel(CTP::model()->with('idCliente0')->with('detalleCTPs')->findByPk($_GET['id']));
            $orden="";
			$sw=0;
			if(isset($_POST['Cliente']))
			{
				$cliente = $this->saveCliente($_POST['Cliente']);
			}
			
			if(isset($_POST['CTP']))
			{
				$orden = CTP::model()->findByPk($ctp->idCTP);
				$orden->attributes = $_POST['CTP'];
				if(!empty($cliente->idCliente))
					$ctp->idCliente = $cliente->idCliente;
				
				$user = Users::model()->with('idEmpleado0')->findByPk(Yii::app()->user->id);
				$orden->obs = $orden->obs."(Modificado por el usuario ".$user->username." (".$user->idEmpleado0->nombre." ".$user->idEmpleado0->apellido."))";
				
				if($orden->validate())
					$sw=1;
			}

			if(isset($_POST['DetalleCTP']))
			{
                $detalle = array(); $d=count($_POST['DetalleCTP']);
                foreach ($_POST['DetalleCTP'] as $key=>$item)
                {
                    $detalle[$key] = New DetalleCTP;
                    $detalle[$key]->attributes=$item;
                    $almacen = AlmacenProducto::model()->with('idProducto0')->findByPk($detalle[$key]->idAlmacenProducto);
                    $detalle[$key]->formato = $almacen->idProducto0->color;
                    $detalle[$key]->idCTP=$ctp->idCTP;
                    if($detalle[$key]->validate())
                        $d--;
                }
                if($d==0)
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
                    if($sw==1){
                        $orden->save();
                        foreach($detalle as $item)
                            $item->save();
                        $this->redirect(array('buscar'));
                    }
                }
			}
			
			if($ctp->tipoCTP==1)
			{
				$productos = new AlmacenProducto('searchCTP');
                $productos->idAlmacen = $this->almacen;
                $productos->material = "PLACAS CTP";
				$this->render('index',array('render'=>'modificarC','cliente'=>$ctp->idCliente0,'detalle'=>$ctp->detalleCTPs,'ctp'=>$ctp,'productos'=>$productos));
			}
			if($ctp->tipoCTP==2)
			{
				$productos = new AlmacenProducto('searchCTP');
                $productos->idAlmacen = $this->almacen;
                $productos->material = "PLACAS CTP";
				$this->render('index',array('render'=>'modificarI','cliente'=>$ctp->idCliente0,'detalle'=>$ctp->detalleCTPs,'ctp'=>$ctp,'productos'=>$productos));
			}
		}
		else
			throw new CHttpException(400,'Invalid request.');
	}

	public function actionAddDetalle()
	{
		if(Yii::app()->request->isAjaxRequest && isset($_GET['index']))
		//if(isset($_GET['index']))
		{
            $costo="";
			$detalle = new DetalleCTP;
			$almacen = new AlmacenProducto;
			if(isset($_GET['al']))
			{
				$almacen = AlmacenProducto::model()
				->with("idProducto0")
				->findByPk($_GET['al']);
			}
            if(isset($_GET['costo']))
                $costo=$_GET['costo'];

			$detalle->idAlmacenProducto = $almacen->idAlmacenProducto;
			$this->renderPartial('forms/_newRowDetalleVenta', array(
					'model'=>$detalle,
					'index'=>$_GET['index'],
                    'costo'=>$costo,
					'almacen'=>$almacen,
			));
		}
		else
			throw new CHttpException(400,'Invalid request.');
	}
	
	/*public function actionAddDetalleI()
	{
		if(Yii::app()->request->isAjaxRequest && isset($_GET['index']))
		//if(isset($_GET['index']))
		{
			$detalle = new DetalleCTP;
			$almacen = new AlmacenProducto;
			if(isset($_GET['al']))
			{
				$almacen = AlmacenProducto::model()
				->with("idProducto0")
				->findByPk($_GET['al']);	
			}
	
			$detalle->idAlmacenProducto = $almacen->idAlmacenProducto;
			
			$this->renderPartial('forms/interna/_newRowDetalleVenta', array(
					'model'=>$detalle,
					'index'=>$_GET['index'],
					'almacen'=>$almacen,
			));
		}
		else
			throw new CHttpException(400,'Invalid request.');
	}*/
	/*
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
	*/
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
	
	/*protected function getRemoveLinkAndIndexInput($index)
	{
		$removeLink=CHtml::link('Quitar', '#', array('class'=>'btn btn-danger tabular-input-remove')).'<input type="hidden" class="tabular-input-index" value="'.$index.'" />';
		$removeLink=strtr("<td>{link}</td>", array('{link}'=>$removeLink));
		return $removeLink;
	}*/
	
	protected function getUltimoDiaMes($elAnio,$elMes) {
		return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
	}
	
	private function verifyModel($model)
	{
		if($model===null or empty($model))
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
	
		return $model;
	}
	
	private function getCodigo($tipo)
    {
        $row = CTP::model()->find(array('condition'=>"tipoCTP=".$tipo." and fechaOrden like '%".date('Y-m-d')."%'",'select'=>'count(*) as max'));
        $codigoTMP =($row->max+1)."-".date('md');
        return $codigoTMP;
    }

    private function saveCliente($post)
    {
        $cliente = Cliente::model()->find('nitCi="'.$post['nitCi'].'"');
        if(empty($cliente))
            $cliente = new Cliente;

        $cliente->attributes = $post;

        if($cliente->isNewRecord)
        {
            $cliente->fechaRegistro = date("Y-m-d");
        }
        if(empty($cliente->idTiposClientes))
        {
            $tmp = TiposClientes::model()->find('`nombre`="nuevo"');
            $cliente->idTiposClientes = $tmp->idTiposClientes;
        }
        return $cliente;
    }

}
