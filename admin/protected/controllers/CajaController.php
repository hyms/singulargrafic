<?php

class CajaController extends Controller
{
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/*$dataProvider=new CActiveDataProvider('Caja',
				array(	
						'criteria'=>array(
							'with'=>array('cajaVentas','cajaVentas.idUser0'),
						),
						'pagination'=>array(
						'pageSize'=>'20',
				),));*/
		$cajas = Caja::model()->with('cajaVentas')->with('cajaVentas.idUser0')->findAll();
		$this->render('index',array('cajas'=>$cajas));
	}
	
	public function actionCaja()
	{
		$model=new Caja;
		
		if(isset($_GET['id']))
			$model=Caja::model()->findByPk($_GET['id']);
	
		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='caja-cajaForm-form')
		{
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
	
		if(isset($_POST['Caja']))
		{
			$model->attributes=$_POST['Caja'];
			if($model->save())
			{
			// form inputs are valid, do something here
				$this->redirect(array('index'));
			}
		}
		$this->render('cajaForm',array('model'=>$model));
	}
			
			
	/**
	 * Performs the AJAX validation.
	 * @param Caja $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='Caja-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionTipoCaja($id=null)
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
