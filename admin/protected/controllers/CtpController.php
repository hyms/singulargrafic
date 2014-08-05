<?php
class CtpController extends Controller
{ 
	
	public function actionMatrizPrecios()
	{
		$model = new MatrizPreciosCTP;
		$placas = AlmacenProducto::model()->with('idProducto0')->findAll('idAlmacen=3');
		$tiposClientes = TiposClientes::model()->findAll('servicio=1');
		$cantidades = CantidadCTP::model()->findAll();
		$horarios = Horario::model()->findAll();
		
		$this->render('matriz',array('model'=>$model,'placas'=>$placas,'tiposClientes'=>$tiposClientes,'cantidades'=>$cantidades,'horarios'=>$horarios));
	}
	
	public function actionHorario()
	{
		$model=new Horario;
		
		if(isset($_GET['id']))
			$model = Horario::model()->findByPk($_GET['id']);
		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='horario-horario-form')
		{
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
	
		if(isset($_POST['Horario']))
		{
			$model->attributes=$_POST['Horario'];
			if($model->save())
        	{
	        	// form inputs are valid, do something here
	        	$this->redirect(array('ctp/matrizPrecios'));
	    	}
		}
		$this->renderPartial('horario',array('model'=>$model));
	}
	
	public function actionCantidad()
	{
		$model=new CantidadCTP;
	
		if(isset($_GET['id']))
			$model = CantidadCTP::model()->findByPk($_GET['id']);
		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='cantidad-ctp-cantidad-form')
		{
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
	
		if(isset($_POST['CantidadCTP']))
		{
			$model->attributes=$_POST['CantidadCTP'];
			if($model->save())
        	{
	        	// form inputs are valid, do something here
	        	$this->redirect(array('ctp/matrizPrecios'));
	    	}
	   	}
	   	$this->renderPartial('cantidad',array('model'=>$model));
	}
					
	public function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
		return $model;
	}
}
?>