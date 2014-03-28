<?php

class ProductoController extends Controller
{
	
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
			if($model->validate())
			{
				if($model->save())
					$this->redirect(array('index'));
			}
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
		$model=$this->verifyModel(Producto::model()->findByPk($id));
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Producto']))
		{
			$model->attributes=$_POST['Producto'];
			if($model->save())
				$this->redirect(array('index'));
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
		$model=$this->verifyModel(Producto::model()->findByPk($id));
		$model->delete();
		$this->redirect(array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
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
		));
	}

	public function actionMaterial($id=NULL)
	{
		$model=new Material;
		
		if($id!=null)
			$model=$this->verifyModel(Material::model()->findByPk($id));
			
		$materiales=Material::model()->findall();
		
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['Material']))
		{
			$model->attributes=$_POST['Material'];
			if($model->validate())
			{
				if($model->save())
				{
					$this->redirect('material');
				}
			}
			else
			{
				$new=true;
			}
		}
		$this->render('material',array('model'=>$model,'material'=>$materiales,'new'=>$new));
		
	}
	
	public function actionColor($id=null)
	{
		$model=new Color;
		
		if($id!=null)
			$model=$this->verifyModel($model=Color::model()->findByPk($id));
			
		$colores=Color::model()->findall();
		
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['Color']))
		{
			$model->attributes=$_POST['Color'];
			
			if($model->validate())
			{
				if($model->save())
				{
					$this->redirect('color');
				}
			}
			else
			{
				$new=true;
			}
		}
		$this->render('color',array('model'=>$model,'colores'=>$colores,'new'=>$new));
		
	}
	
	public function actionIndustria($id=null)
	{
		$model=new Industria;
		if($id!=null)
			$model=$model=$this->verifyModel(Industria::model()->findByPk($id));
			
		$industrias=Industria::model()->findall();
		
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['Industria']))
		{
			$model->attributes=$_POST['Industria'];
				
			if($model->validate())
			{	
				if($model->save())
				{
					$this->redirect('industria');
				}
			}
			else
			{
				$new=true;
			}
			
		}
		$this->render('industria',array('model'=>$model,'industrias'=>$industrias,'new'=>$new));
		
	}
	
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
	
		return $model;
	}
}