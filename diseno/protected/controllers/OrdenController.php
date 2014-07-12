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
		$this->render('index');
	}
	
	public function actionCliente()
	{
		$cliente = new Cliente;
		$detalle = new DetalleCTP;
		$ctp = new CTP;
		$productos = new AlmacenProducto('searchCTP');
		
		$row = CTP::model()->find(array("condition"=>"tipoOrden=1",'order'=>'fechaOrden Desc'));
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
		$ctp->codigo = chr($ctp->serie)."C-".$ctp->numero."-".date("y");
		$ctp->formaPago = 0;
		$ctp->tipoOrden = 1;
		$ctp->fechaOrden = date("Y-m-d H:i:s");
		$ctp->idUserOT= Yii::app()->user->id;
		
		$swc=0; $swv=0;
		if(isset($_POST['Cliente']))
		{
			$cliente = Cliente::model()->find('nitCi="'.$_POST['Cliente']['nitCi'].'"');
			if($cliente==null)
				$cliente = new Cliente;
		
			$cliente->attributes = $_POST['Cliente'];
			if(empty($cliente->fechaRegistro))
				$cliente->fechaRegistro = date("Y-m-d");
			if($cliente->save())
				$swc=1;
		}
		
		if(isset($_POST['CTP']))
		{
			$ctp->attributes = $_POST['CTP'];
			$row = CTP::model()->find(array("condition"=>"tipoOrden=".$ctp->tipoOrden,'order'=>'fechaOrden Desc'));
			if(empty($row))
				$row=new Venta;
			if($ctp->tipoOrden==1)
				$ctp->codigo = chr($ctp->serie)."C-".$ctp->numero."-".date("y");
			else
				$ctp->codigo = $ctp->numero."-C";
				
			if(empty($row->serie) && $ctp->tipoOrden==1)
				$row->serie = 65;
			$ctp->numero = $row->numero +1;
			if($row->numero==1001 && $ctp->tipoOrden==1)
			{
				$row->numero=1;
				$row->serie++;
				if($row->serie==91)
					$row->serie = 65;
			}
			$ctp->serie = $row->serie;
			$ctp->estado = 1;
			if($ctp->formaPago==1)
			{
				$ctp->estado = 2;
			}
			if($ctp->validate())
				$swv=1;
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
				if($detalle[$i]->validate())
				{
					$det--;
				}
				$i++;
			}
		}
		//print_r($ctp);
		if($swc==1 && $swv==1 && $det==0)
		{
			$ctp->idCliente = $cliente->idCliente;
		
			if($ctp->save())
			{
				foreach($detalle as $item)
				{
					$item->idCTP = $ctp->idCTP;
					$item->save();
				}
				$this->redirect(array('orden/rep'));
			}
		}
		
		$this->render('cliente',array('cliente'=>$cliente,'detalle'=>$detalle,'ctp'=>$ctp,'productos'=>$productos));
	}
	
	public function actionInterna()
	{
		$ordenes=new CActiveDataProvider('CTP',array(
				'pagination'=>array(
						'pageSize'=>'20',
				),));
		$this->render('interna',array('ordenes'=>$ordenes));
	}
	
	public function actionRep()
	{
		$ordenes=new CActiveDataProvider('CTP',array(
				'pagination'=>array(
						'pageSize'=>'20',
				),));
		$this->render('rep',array('ordenes'=>$ordenes));
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
