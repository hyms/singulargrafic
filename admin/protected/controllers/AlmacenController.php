<?php

class AlmacenController extends Controller
{
	
	public function filters()
	{
		return array( 'accessControl' ); // perform access control for CRUD operations
	}
	
	public function accessRules() {
		return array(
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'expression'=>'isset($user->role) && ($user->role==="1")',
				),
				array('deny',
						'users'=>array('*'),
				),
		);
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Almacen;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Almacen']))
		{
			$model->attributes=$_POST['Almacen'];
			if($model->validate())
			{
				if($model->idTipoAlmacen==1)
				{	
					if($model->save())
						$this->redirect(array('index'));
				}
				else 
				{
					$almacen=$this->verifyModel(Almacen::model()->find('idTipoAlmacen=1 and idProducto='.$model->idProducto));
					$almacen->stockPaquete=$almacen->stockPaquete-$model->stockPaquete;
					$almacen->stockUnidad=$almacen->stockUnidad-$model->stockUnidad;
					if($almacen->stockPaquete>=0 && $almacen->stockUnidad>=0)
					{
						if($model->save())
						{
							$almacen->save();
							$this->redirect(array('index'));
						}
					}
					else 
					{
						if($almacen->stockPaquete<0)
							$model->addError('stockPaquete', 'La cantidad de <b>stockPaquete</b> debe ser menor al de deposito');
						if($almacen->stockUnidad<0)
							$model->addError('stockUnidad', 'La cantidad de <b>stockUnidad</b> debe ser menor al de deposito');
						
					}
				}
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=$this->verifyModel(Almacen::model()->findByPk($id));
		if($model->idTipoAlmacen==1)
		{
			$count=Almacen::model()->findAll('idProducto='.$model->idProducto);
			
			if(count($count)==1)
				$model->delete();
		}
		else 
		{
			$principal=Almacen::model()->find('idProducto='.$model->idProducto.' and idTipoAlmacen=1');
			$principal->stockUnidad=$principal->stockUnidad + $model->stockUnidad;
			$principal->stockPaquete=$principal->stockPaquete + $model->stockPaquete;
			//print_r($principal);
			//print_r($model);
			if($principal->save())
				$model->delete();
		}
		
		$this->redirect(array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Almacen');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
				'criteria'=>array(
					'with'=>array('TipoAlmacen','Producto','Producto.Color','Producto.Material'),
					'order'=>'Producto.codigo',
				),
				
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
	}

	/**
	 * Performs the AJAX validation.
	 * @param Almacen $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='almacen-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionTipoAlmacen($id=null)
	{
		$model=new TipoAlmacen;
		if($id!=null)
			$model=$this->verifyModel(TipoAlmacen::model()->findByPk($id));
			
		$tipos=TipoAlmacen::model()->findall();
		
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['TipoAlmacen']))
		{
			$model->attributes=$_POST['TipoAlmacen'];
			if($model->validate())
			{
				if($model->save())
				{
					$this->redirect(array('tipoAlmacen'));
				}
			}
			else
			{
				$new=true;
			}
		}
		
		$this->render('tipoAlmacen',array('model'=>$model,'tipos'=>$tipos,'new'=>$new));
		
	}
	
	public function actionAdd_reduce($al=NULL, $id=NULL)
	{
		$productos=new Producto('searchAll');
		$productos->unsetAttributes();
		$producto=null;
		if($al!=null)
		{
			$productos->almacen=$al;
		}
		
		if (isset($_GET['Producto'])) 
		{
			$productos->attributes = $_GET['Producto'];
			$productos->color = $_GET['Producto']['color'];
			$productos->material = $_GET['Producto']['material'];
			$productos->industria = $_GET['Producto']['industria'];
			//$productos->almacen = $_GET['Producto']['almacen'];
		}
		
		
		$almacenes = TipoAlmacen::model()->findAll();
		$model=new MovimientoAlmacen;
		if($id!=null)
		{
			$model->idAlmacen = $id;
			$producto = $this->verifyModel(Producto::model()->with('Almacen')->with('Color')->with('Material')->with('Industria')->find('Almacen.id='.$model->idAlmacen));
		}
		
		if(isset($_POST['MovimientoAlmacen']))
		{
			print_r($_POST);
			$model->attributes=$_POST['MovimientoAlmacen'];
			
			$model->fechaInicio=date("Y-m-d H:i:s");
			$model->estado="2";
			if($model->save())
			{
				$almacen=Almacen::model()->findByPK($model->idAlmacen);
				$almacen->stockUnidad = $almacen->stockUnidad + $model->unidad;
				$almacen->stockPaquete = $almacen->stockPaquete + $model->paquete;
				if($almacen->save())
				{
					$model->fechaFinal=date("Y-m-d H:i:s");
					$model->estado="1";
					if($model->save())
					{
						$this->redirect(array('add_reduce'));
					}
				}
			}
		}
		//$producto = $this->verifyModel(Producto::model()->with('Almacen')->with('Color')->with('Material')->with('Industria')->find('Almacen.id='.$model->idAlmacen));
		$this->render('add_reduce',array(
				'pagination'=>array(
						'pageSize'=>20,
				),
				'model'=>$model,
				'almacenes'=>$almacenes,
				'productos'=>$productos,
				'producto'=>$producto
		));
	}
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
	
		return $model;
	}
}
