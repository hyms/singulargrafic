<?php 
class InventarioController extends Controller
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
		$dataProvider=new CActiveDataProvider('Producto',
				array('pagination'=>array(
						'pageSize'=>'1',
				),));
		$this->render('index',array(
				'dataProvider'=>$dataProvider
		));
	} 
	
	public function actionCreate()
	{
		$model=new Producto;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Producto']))
		{
			$model->attributes=$_POST['Producto'];
			if($model->save())
				if($this->initStock($model->idProducto))
					$this->redirect(array('index'));
		}
		
		$this->render('create',array(
				'model'=>$model,
		));
	}
	
	public function actionUpdate()
	{
		if($_GET['id'])
		{
			$model=$this->verifyModel(Producto::model()->findByPk($_GET['id']));
	
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
	
			if(isset($_POST['Producto']))
			{
				$model->attributes=$_POST['Producto'];
				if($model->save())
					$this->redirect(array('index'));
			}
	
			$this->render('update',array(
					'model'=>$model,
			));
		}
		else
			throw new CHttpException(400,'La Respuesta de la pagina no Existe.');
	}
	
	public function actionStock()
	{
		if($_GET['id'])
		{
			$model=$this->verifyModel(AlmacenProducto::model()->find('idProducto='.$_GET['id']));
			
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
			
			if(isset($_POST['AlmacenProducto']))
			{
				$model->attributes=$_POST['AlmacenProducto'];
				if($model->save())
					$this->redirect(array('index'));
			}
			
			$this->render('update',array(
					'model'=>$model,
			));
		}
		else
			throw new CHttpException(400,'La Respuesta de la pagina no Existe.');
	}
	
	private function initStock($id)
	{
		$almacen = new AlmacenProducto;
		$almacen->idAlmacen=1;
		$almacen->idProducto=$id;
		$almacen->stockU=0;
		$almacen->stockP=0;
		return $almacen->save();
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