<?php

class ProductoController extends Controller
{
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>Producto::model()->findByPk($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Producto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Producto']))
		{
			$model->attributes=$_POST['Producto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Producto']))
		{
			$model->attributes=$_POST['Producto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Producto');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Producto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Producto']))
			$model->attributes=$_GET['Producto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionMaterial($id=NULL)
	{
		$model=new Material;
		
		if($id!=null)
			$model=Material::model()->findByPk($id);
			
		$materiales=Material::model()->findall();
		
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['Material']))
		{
			$model->attributes=$_POST['Material'];
			
			if($model->save())
			{
				$this->redirect('material');
			}
			else 
			{
				$this->render('material',array('model'=>$model,'material'=>$materiales,'new'=>$new));
			}
		}
		else 
		{
			$this->render('material',array('model'=>$model,'material'=>$materiales,'new'=>$new));
		}
	}
	
	public function actionColor($id=null)
	{
		$model=new Color;
		
		if($id!=null)
			$model=Color::model()->findByPk($id);
			
		$colores=Color::model()->findall();
		
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['Color']))
		{
			$model->attributes=$_POST['Color'];
			
			if($model->save())
			{
				$this->redirect('color');
			}
			else 
			{
				$this->render('color',array('model'=>$model,'colores'=>$colores,'new'=>$new));
			}
		}
		else 
		{
			$this->render('color',array('model'=>$model,'colores'=>$colores,'new'=>$new));
		}
	}
	
	public function actionIndustria($id=null)
	{
		$model=new Industria;
		if($id!=null)
			$model=Industria::model()->findByPk($id);
			
		$industrias=Industria::model()->findall();
		
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['Industria']))
		{
			$model->attributes=$_POST['Industria'];
				
			if($model->save())
			{
				$this->redirect('industria');
			}
			else
			{
				$this->render('industria',array('model'=>$model,'industrias'=>$industrias,'new'=>$new));
			}
		}
		else
		{
			$this->render('industria',array('model'=>$model,'industrias'=>$industrias,'new'=>$new));
		}
	}
}