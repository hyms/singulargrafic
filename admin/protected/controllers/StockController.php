<?php 
class StockController extends Controller
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
		$this->render("index");
		/*$dataProvider=new CActiveDataProvider('AlmacenProducto',
				array(	
						'criteria'=>array(
							'condition'=>'idAlmacen=1',
							'with'=>array('idProducto0'),
						),
						'pagination'=>array(
						'pageSize'=>'20',
				),));
		$this->render('index',array(
				'dataProvider'=>$dataProvider
		));*/
	} 
	
	public function actionDistribuidora()
	{
		//$productos=AlmacenProducto::model()->findAll('idAlmacen=2');
		$productos=new CActiveDataProvider('AlmacenProducto',
				array(
						'criteria'=>array(
								'condition'=>'idAlmacen=2',
								'order'=>'idProducto0.material',
								'with'=>array('idProducto0'),
						),
						'pagination'=>array(
								'pageSize'=>'20',
						),
				));
		$index=1;
		$this->render('distribuidora',array('productos'=>$productos,'index'=>$index));		
	}
	
	public function actionDistribuidoraAdd()
	{
		//$productos=AlmacenProducto::model()->findAll('idAlmacen=2');
		if(isset($_GET['id']))
		{
			//$res=false;
			$productos= $this->verifyModel(Producto::model()->findByPk($_GET['id']));
			/*$almacen=AlmacenProducto::model()->find('idProducto='.$productos->idProducto.' and idAlmacen=2');
			if(empty($almacen))*/
			
			if($this->initStock($productos->idProducto))
				$this->redirect(array("stock/distribuidoraAdd"));
		}
		
		$productos=new CActiveDataProvider('AlmacenProducto',
				array(
						'criteria'=>array(
								'condition'=>'idAlmacen=1',
								'order'=>'idProducto0.material',
								'with'=>array('idProducto0'),
						),
						'pagination'=>array(
								'pageSize'=>'20',
						),
				));
		$index=0;
		$this->render('distribuidora',array('productos'=>$productos,'index'=>$index));
	}
	
	public function actionStockDistribuidora()
	{
		if($_GET['id'])
		{
			$almacen=$this->verifyModel(AlmacenProducto::model()->with('idProducto0')->findByPk($_GET['id']));
			$deposito=AlmacenProducto::model()->find('idAlmacen=1 and idProducto='.$almacen->idProducto);
			$model=new MovimientoAlmacen;
				
			// uncomment the following code to enable ajax-based validation
			/*
			if(isset($_POST['ajax']) && $_POST['ajax']==='movimiento-almacen-add_reduce-form')
			{
			echo CActiveForm::validate($model);
			Yii::app()->end();
			}
			*/
			$model->idProducto = $almacen->idProducto;
			$model->idAlmacenDestino = $almacen->idAlmacen;
			$model->idAlmacenOrigen = $deposito->idAlmacen;
			//$idUser->idUser = Yii::app()->user->id;
			$model->fechaMovimiento = date("Y-m-d H:i:s");
		
			if(isset($_POST['MovimientoAlmacen']))
			{
				$model->attributes=$_POST['MovimientoAlmacen'];
				
				$deposito->stockU = $deposito->stockU - $model->cantidadU;
				if($deposito->stockU<0)
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
						
						if($almacen->save() && $deposito->save())
							$this->redirect(array('distribuidora'));
					}
				}
			}
			$index=2;
			$this->render('distribuidora',array('model'=>$model,'almacen'=>$almacen,'deposito'=>$deposito,'index'=>$index));
							
		}
		else
						throw new CHttpException(400,'La Respuesta de la pagina no Existe.');
	}
	
	private function initStock($id)
	{
		$almacen = new AlmacenProducto;
		$almacen->idAlmacen=2;
		$almacen->idProducto=$id;
		$almacen->stockU=0;
		$almacen->stockP=0;
		$res=$almacen->save();
		return $res;
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
}
?>