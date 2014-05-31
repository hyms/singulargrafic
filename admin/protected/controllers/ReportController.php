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
		/*return array(
			'accessControl', // perform access control for CRUD operations
		);*/
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		/*return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);*/
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
		if(isset($_GET['f']))
		{
			$f=$_GET['f'];
			if($_GET['f']==0)
			{
				$factura=" and tipoVenta=0";
			}
			else
			{
				$factura=" and tipoVenta=1";
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
				$cond1=array("report/venta","f"=>0,"d"=>$_GET['d']);
				$cond2=array("report/venta","f"=>1,"d"=>$_GET['d']);
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
				$cond1=array("report/venta","f"=>0,"m"=>$_GET['m']);
				$cond1=array("report/venta","f"=>1,"m"=>$_GET['m']);
				$m=$_GET['m'];
				$d=$this->getUltimoDiaMes($y, $m);
				$start=$y."-".$m."-1 00:00:00";
				$end=$y."-".$m."-".$d." 23:59:59";
			}
			$condition="'".$start."'<=fechaVenta AND fechaVenta<='".$end."'";
			$ventas = new CActiveDataProvider('Venta',
					array('criteria'=>array(
							'condition'=>$condition.$factura,
							'with'=>array('idCliente0'),
							'order'=>'fechaPlazo ASC',
					),
							'pagination'=>array(
									'pageSize'=>20,
							),));
				
		}
		else
		{
			$cond1=array("report/venta","f"=>0);
			$cond2=array("report/venta","f"=>1);
			if($factura="")
				$ventas = new CActiveDataProvider('Venta',
						array('criteria'=>array(
								'with'=>array('idCliente0'),
								'order'=>'fechaPlazo ASC',
						),
								'pagination'=>array(
										'pageSize'=>20,
								),));
			else
				$ventas = new CActiveDataProvider('Venta',
						array('criteria'=>array(
								'with'=>array('idCliente0'),
								'condition'=>$factura,
								'order'=>'fechaPlazo ASC',
						),
								'pagination'=>array(
										'pageSize'=>20,
								),));
				
		}
		//$this->render('movimientos',array('ventas'=>$ventas,'cond1'=>$cond1,'cond2'=>$cond2,'cond3'=>$cond3));
		$this->render('venta',array('ventas'=>$ventas,'cond1'=>$cond1,'cond2'=>$cond2));
	}
	
	public function actionProducto()
	{
		$this->render('producto');
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
}
?>