<?php

class WebpageController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionPages($id = NULL)
	{
		$pages = new Pages;
		$paginas = $pages->nombres();
		
		if($id != null)
			$pages=Pages::model()->findByPk($id);
		
		if(isset($_POST['Pages']))
		{
			
			
			$pages->nombre=$_POST['Pages']['nombre'];
			$pages->contenido=$_POST['contenido'];
			if($_POST['Pages']['enable'])
				$pages->enable=1;
			else
				$pages->enable=0;
			$pages->order=$_POST['Pages']['order'];
			$pages->fecha=date("Y-m-d H:i:s");
			
			if($pages->save())
			{
				$this->redirect(array('webpage/pages'));
			}
			else 
			{
				$this->render('pages',array('model'=>$pages, 'paginas'=>$paginas));
			}
		}
		else
		{
			$this->render('pages',array('model'=>$pages, 'paginas'=>$paginas));
		}
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