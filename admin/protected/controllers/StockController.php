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
		$productos=new CActiveDataProvider('AlmacenProducto',
				array(
						'criteria'=>array(
								'condition'=>'idAlmacen=1',
								'with'=>array('idProducto0'),
						),
						'pagination'=>array(
								'pageSize'=>'20',
						),
				));
		$index=1;
		$this->render('distribuidora',array('productos'=>$productos,'index'=>$index));
	}
	
	private function initStock($id)
	{
		$almacen = new AlmacenProducto;
		$almacen->idAlmacen=2;
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