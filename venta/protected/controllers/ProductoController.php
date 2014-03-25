<?php

class ProductoController extends Controller
{
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=Producto::model()->findByPk($id);
		
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

}