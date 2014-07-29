<?php 
class InventarioController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		/*return array(
			'accessControl', // perform access control for CRUD operations
		);*/
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		/*return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);*/
	}
	
	public function actionIndex()
	{
		if(isset($_GET['excel']))
		{
			if($_GET['excel'])
			{
				$almacenProducto= AlmacenProducto::model()->with('idProducto0')->findAll(array('condition'=>'idAlmacen=1','order'=>'idProducto0.Material, idProducto0.codigo, idProducto0.detalle'));
				
				$columnsTitle=array('Nro','Codigo','Material','Detalle Producto','Precio S/F','Precio C/F','Industria','Cant.xPaqt.','Stock Unidad','Stock Paquete');
				$content=array();
				$index=1;
				foreach ($almacenProducto as $item)
				{
					array_push($content,array($index,
					$item->idProducto0->codigo,
					$item->idProducto0->material,
					$item->idProducto0->color." ".$item->idProducto0->detalle." ".$item->idProducto0->marca,
					$item->idProducto0->precioSFU."/".$item->idProducto0->precioSFP,
					$item->idProducto0->precioCFU."/".$item->idProducto0->precioCFP,
					$item->idProducto0->industria,
					$item->idProducto0->cantXPaquete,
					$item->stockU,
					$item->stockP));
					$index++;
				}
				$this->createExcel($columnsTitle, $content);
			}
		}
		$dataProvider=new CActiveDataProvider('AlmacenProducto',
				array(	
						'criteria'=>array(
							'condition'=>'idAlmacen=1',
							'with'=>array('idProducto0'),
							'order'=>'idProducto0.Material, idProducto0.codigo, idProducto0.detalle',
						),
						'pagination'=>array(
						'pageSize'=>'20',
				),));
		$this->render('index',array(
				'dataProvider'=>$dataProvider
		));
	} 
	
	public function actionCreate()
	{
		$model=new Producto;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Producto']))
		{
			$model->attributes=$_POST['Producto'];
			if($model->save())
				if($this->initStock($model->idProducto))
					$this->redirect(array('index'));
		}
		
		$this->render('create',array(
				'model'=>$model,
		));
	}
	
	public function actionUpdate()
	{
		if($_GET['id'])
		{
			$model=$this->verifyModel(Producto::model()->findByPk($_GET['id']));
	
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
		else
			throw new CHttpException(400,'La Respuesta de la pagina no Existe.');
	}
	
	public function actionStock()
	{
		if($_GET['id'])
		{
			$almacen=$this->verifyModel(AlmacenProducto::model()->with('idProducto0')->findByPk($_GET['id']));
			
			$model=new MovimientoAlmacen;
			
			// uncomment the following code to enable ajax-based validation
			/*
			 if(isset($_POST['ajax']) && $_POST['ajax']==='movimiento-almacen-add_reduce-form')
			 {
			echo CActiveForm::validate($model);
			Yii::app()->end();
			}
			*/
			$model->idProducto = $almacen->idProducto;
			$model->idAlmacenDestino = $almacen->idAlmacen;
			//$idUser->idUser = Yii::app()->user->id;
			$model->fechaMovimiento = date("Y-m-d H:i:s");
			
			if(isset($_POST['MovimientoAlmacen']))
			{
				$model->attributes=$_POST['MovimientoAlmacen'];
				
				if($model->save())
				{
	            // form inputs are valid, do something here
					$almacen->stockU = $almacen->stockU + $model->cantidadU;
					$almacen->stockP = $almacen->stockP + $model->cantidadP;
					if($almacen->save())
						$this->redirect(array('index'));
				}
			}
			$this->render('add_reduce',array('model'=>$model,'almacen'=>$almacen));
			
		}
		else
			throw new CHttpException(400,'La Respuesta de la pagina no Existe.');
	}
	
	public function actionMovimientos()
	{
		if(isset($_GET['excel']))
		{
			if($_GET['excel'])
			{
				$movimientos=MovimientoAlmacen::model()
													->with('idAlmacenOrigen0')
													->with('idAlmacenDestino0')
													->with('idProducto0')
													->findAll(array('order'=>'fechaMovimiento DESC'));
				$columnsTitle=array('Nro','Codigo','Material','Detalle Producto','Industria','De','A','Cant. Unidad','Cant. Paquete','Fecha');
				$content=array();
				$index=1;
				foreach ($movimientos as $item)
				{
					array_push($content,array($index,
					$item->idProducto0->codigo,
					$item->idProducto0->material,
					$item->idProducto0->color." ".$item->idProducto0->detalle." ".$item->idProducto0->marca,
					$item->idProducto0->industria,
					(!empty($item->idAlmacenOrigen0))?$item->idAlmacenOrigen0->nombre:"",
					$item->idAlmacenDestino0->nombre,
					$item->cantidadU,
					$item->cantidadP,
					$item->fechaMovimiento));
					$index++;
				}
				$this->createExcel($columnsTitle, $content);
			}
		}
		$movimientos=new CActiveDataProvider('MovimientoAlmacen',
				array(
						'criteria'=>array(
								'with'=>array('idAlmacenOrigen0','idAlmacenDestino0','idProducto0'),
								'order'=>'fechaMovimiento DESC',
						),
						'pagination'=>array(
								'pageSize'=>'20',
						),));
		$this->render('movimientos',array(
				'movimientos'=>$movimientos
		));		
	}
	
	public function actionMatrizCTP()
	{
		
	}
	
	private function createExcel($columnsTitle,$content,$sum=array(),$title="")
	{
		if($title=="")
		{
			$title="Reports";
		}
		Yii::import('ext.phpexcel.XPHPExcel');
		$objPHPExcel= XPHPExcel::createPHPExcel();
		$objPHPExcel->getProperties()
		->setCreator("Grafica Singular")
		->setLastModifiedBy("Grafica Singular")
		->setTitle($title)
		->setSubject($title)
		->setDescription($title.".xlsx");
		
		$column=65;
		//assign titles 
		foreach ($columnsTitle as $item)
		{
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue(chr($column).'1', $item);
			$objPHPExcel->getActiveSheet()->getColumnDimension(chr($column))->setAutoSize(true);
			$column++;
		}
		
		//create content
		$index=2;
		foreach ($content as $items)
		{
			$column=65;
			foreach ($items as $item)
			{
				
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue(chr($column).($index), $item);
				$objPHPExcel->getActiveSheet()->getColumnDimension(chr($column))->setAutoSize(true);
				$column++;
			}
			$index++;
		}
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Report');
			
			
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		// Redirect output to a clientâ€™s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Report.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
			
		// If you're serving to IE over SSL, then the following may be needed
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
			
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		Yii::app()->end();
	}
	
	private function initStock($id)
	{
		$almacen = new AlmacenProducto;
		$almacen->idAlmacen=1;
		$almacen->idProducto=$id;
		$almacen->stockU=0;
		$almacen->stockP=0;
		return $almacen->save();
	} 
	
	public function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
		return $model;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param Cliente $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='producto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
?>