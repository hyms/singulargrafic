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
		$cajas = Caja::model()->findAll();
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
			
	public function actionAssign()
	{
		if(isset($_GET['id']))
		{
			
			$users = new CActiveDataProvider('Users',
					array(	
							'pagination'=>array(
								'pageSize'=>'20',
							),
						));
			$this->render('assign',array('users'=>$users));
		}
		else
			throw new CHttpException(400,'Petición no válida.');	
	} 	
	
	public function actionChicas()
	{
		$cajaChica=new CActiveDataProvider('CajaChica',
				array(
						'criteria'=>array(
							'with'=>array('idUser0'),
						),
						'pagination'=>array(
								'pageSize'=>'20',
						),));
		$this->render('cajaChica',array('cajaChica'=>$cajaChica));
	}
	
	public function actionChicasAdd()
	{
		$cajaChica=new CajaChica;
		
		// uncomment the following code to enable ajax-based validation
		/*
		 if(isset($_POST['ajax']) && $_POST['ajax']==='caja-chica-CajaChicaForm-form')
		 {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
		if(isset($_GET['id']))
		{
			$cajaChica = CajaChica::model()->findByPk($_GET['id']);
		}
			
		if(isset($_POST['CajaChica']))
		{
		$cajaChica->attributes=$_POST['CajaChica'];
			if($cajaChica->save())
			{
				//print_r($cajaChica);
				$this->redirect(array('caja/chicas'));
			}
		}
		$this->render('CajaChicaForm',array('model'=>$cajaChica));
	}
	
	public function actionTipo()
	{
		//$model=new TipoMovimiento;
		$model=new CActiveDataProvider('TipoMovimiento',
				array(
				'pagination'=>array(
						'pageSize'=>'20',
				),));
		$this->render('tipo',array('model'=>$model));
	}
	
	public function actionTipoAdd()
	{
		$model=new TipoMovimiento;
		
		// uncomment the following code to enable ajax-based validation
		/*
		 if(isset($_POST['ajax']) && $_POST['ajax']==='tipo-movimiento-movimientoForm-form')
		 {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
		
		if(isset($_GET['id']))
		{
			$model = TipoMovimiento::model()->findByPk($_GET['id']);
		}
		
		if(isset($_POST['TipoMovimiento']))
		{
			$model->attributes=$_POST['TipoMovimiento'];
			if($model->save())
			{
		    	$this->redirect(array("caja/tipo"));
			}
		}
		$this->render('movimientoForm',array('model'=>$model));
	} 
	
	public function actionTipoChica()
	{
		if(isset($_GET['id']))
		{
			$caja= CajaChica::model()
					->with('idUser0')
					->findByPk($_GET['id']);
			if(isset($_GET['tm']))
			{
				$cajaTipo = CajaChicaTipo::model()->find('idcajaChica='.$_GET['id'].' and idTipoMovimiento='.$_GET['tm']);
				if(!isset($cajaTipo))
				{
					$cajaTipo = new CajaChicaTipo;
					$cajaTipo->idcajaChica = $_GET['id'];
					$cajaTipo->idTipoMovimiento = $_GET['tm'];
					$cajaTipo->save();
				}
			}
			
			if(isset($_GET['del']))
			{
				$cajaTipo = CajaChicaTipo::model()->findByPk($_GET['del']);
				if(isset($cajaTipo))
					$cajaTipo->delete();
			}
			
			$tipo = TipoMovimiento::model()->findAll();
			$this->render('tipoChica',array('tipo'=>$tipo,'caja'=>$caja));
		}
		else
			throw new CHttpException(400,'La Respuesta de la pagina no Existe.');
		
	}
	protected function getLink($idCaja,$idTipo)
	{
		$cajaTipo = CajaChicaTipo::model()->find('idcajaChica='.$idCaja.' and idTipoMovimiento='.$idTipo);
		if(isset($cajaTipo))
		{
			$link = CHtml::link('Quitar',array('caja/tipoChica','id'=>$idCaja,'del'=>$cajaTipo->idcajaChicaTipo),array('class'=>'btn btn-danger btn-sm'));
		}
		else
		{
			$link = CHtml::link('Añadir',array('caja/tipoChica','id'=>$idCaja,'tm'=>$idTipo) ,array('class'=>'btn btn-success btn-sm'));
		}
		return $link;
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
	
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
	
		return $model;
	}
}
