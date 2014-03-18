<?php

class WebpageController extends Controller
{
	public function actionIndex()
	{
		$this->redirect(array('site/index'));
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
	
	public function actionBanner()
	{
		$dataProvider=new CActiveDataProvider('Banner');
		$this->render('banner/index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionBannerCreate()
	{
		$model=new Banner;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Banner']))
		{
			if(!empty($_FILES['Banner']['name']['imagen']))
			{
				$imagen = CUploadedFile::getInstance($model, 'imagen');
				$model->imagen = $imagen->getName();
				if($imagen->saveAs('images/banner/'.$imagen,false))
					$imagen->saveAs(Yii::app()->basePath.'/../../images/'.$imagen);
			}
			else 
			{
				$model->imagen="";
			}
			$model->fecha = date("Y-m-d H:i:s");
			$model->order = $_POST['Banner']['order'];
			$model->texto = $_POST['texto'];
			
			if($model->save())
			{
				$this->redirect(array('webpage/banner'));
			}
			else 
			{
				$this->render('banner/create',array('model'=>$model));
			}
		}
		else
		{
			$this->render('banner/create',array('model'=>$model));
		}

	}
	
	public function actionBannerUpdate($id)
	{
		$model=Banner::model()->findByPk($id);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Banner']))
		{	
			if(!empty($_FILES['Banner']['name']['imagen']))
			{
				$imagen = CUploadedFile::getInstance($model, 'imagen');
				$model->imagen = $imagen->getName();
				if($imagen->saveAs('images/banner/'.$imagen,false))
					$imagen->saveAs(Yii::app()->basePath.'/../../images/'.$imagen);
			}
			$model->fecha = date("Y-m-d H:i:s");
			$model->order = $_POST['Banner']['order'];
			$model->texto = $_POST['texto'];
			if($model->save())
			{
				$this->redirect(array('webpage/banner'));
			}
			else 
			{
				$this->render('banner/update',array('model'=>$model));
			}
		}
		else
		{
			$this->render('banner/update',array('model'=>$model));
		}
	}
	
	public function actionBannerDelete($id)
	{
		$model=Banner::model()->findByPk($id);
		$model->delete();
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('webpage/banner'));
	}
}