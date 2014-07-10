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
				/*if($_GET['factura']==0)
				{
					$detalle->costoP = $almacen->idProducto0->precioCFP;
					$detalle->costoU = $almacen->idProducto0->precioCFU;
				}
				else
				{
					$detalle->costoP = $almacen->idProducto0->precioSFP;
					$detalle->costoU = $almacen->idProducto0->precioSFU;
				}*/
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
