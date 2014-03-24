<?php

class DistribuidoraController extends Controller
{
	public function actionIndex($id=null)
	{
		$cliente = new Cliente;
		$model = new Venta;
		$producto = new Producto;
		$dataProvider=new CActiveDataProvider('Producto',array(
				'criteria'=>array(
						'with'=>'Color',
						'with'=>'Material',
						'with'=>'Industria',
				),
				'pagination'=>array(
						'pageSize'=>'20',
				),));
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
				'cliente'=>$cliente,
				'model'=>$model,
		));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}