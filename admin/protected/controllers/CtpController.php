<?php
class CtpController extends Controller
{ 
	
	public function actionMatrizPrecios()
	{
		$model=new MatrizPreciosCTP;
		$this->render('matriz',array('model'=>$model));
	}
	
	public function actionHorario()
	{
		$model=new Horario;
	
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
			if($model->validate())
			{
					// form inputs are valid, do something here
				return;
			}
		}
		$this->renderPartial('horario',array('model'=>$model));
	}
	
	public function actionCantidad()
	{
		$model=new CantidadCTP;
	
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
		if($model->validate())
        {
	        	// form inputs are valid, do something here
	        		return;
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