<?php 
class StockController extends Controller
{
	public function filters()
	{
		return array( 'accessControl' ); // perform access control for CRUD operations
	}
	
	public function accessRules() {
		return array(
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'expression'=>'isset($user->role) && ($user->role==="1")',
				),
				array('deny',
						'users'=>array('*'),
				),
		);
	}
	
	public function actionIndex()
	{
		$this->render("index",array('render'=>''));
	} 

    public function actionAlmacen()
    {
        if(isset($_GET['excel']) && isset(Yii::app()->session['excel']))
        {
            $model= Yii::app()->session['excel'];
            $dataProvider= $model->search();
            $dataProvider->pagination= false; // for retrive all modules
            $data = $dataProvider->data;
            $columnsTitle=array('Nro','Codigo','Material','Detalle Producto','Precio S/F','Precio C/F','Industria','Cant.xPaqt.','Stock Unidad','Stock Paquete');
            $content=array();
            $index=1;
            foreach ($data as $item)
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
            $this->createExcel($columnsTitle, $content,'almacen '.date('Ymd'));
        }
        $dataProvider = new AlmacenProducto('search');

        $dataProvider->unsetAttributes();
        if(isset($_GET['almacen']))
        {
            $dataProvider->idAlmacen=$_GET['almacen'];
            $title = Almacen::model()->findByPk($_GET['almacen'])->nombre;
            if(isset($_GET['AlmacenProducto']))
            {
                $dataProvider->attributes = $_GET['AlmacenProducto'];
                $dataProvider->codigo = $_GET['AlmacenProducto']['codigo'];
                $dataProvider->industria = $_GET['AlmacenProducto']['industria'];
                $dataProvider->material = $_GET['AlmacenProducto']['material'];
                $dataProvider->detalle = $_GET['AlmacenProducto']['detalle'];
                $dataProvider->color = $_GET['AlmacenProducto']['color'];
                $dataProvider->marca = $_GET['AlmacenProducto']['marca'];
            }
            $this->render('index',array('render'=>'almacen','productos'=>$dataProvider,'almacen'=>$_GET['almacen'],'title'=>$title));
        }
        else
            throw new CHttpException(400,'La Respuesta de la pagina no Existe.');
    }

    public function actionStockAdd()
    {
        if(isset($_GET['id']) && isset($_GET['almacen']))
        {
            $almacen=$this->verifyModel(AlmacenProducto::model()->with('idProducto0')->findByPk($_GET['id']));
            $deposito=new AlmacenProducto;
            if($_GET['almacen']!=1)
                $deposito=AlmacenProducto::model()->find('idAlmacen=1 and idProducto='.$almacen->idProducto);
            $model=new MovimientoAlmacen;

            $model->idProducto = $almacen->idProducto;
            $model->idAlmacenDestino = $almacen->idAlmacen;
            $model->idAlmacenOrigen = $deposito->idAlmacen;
            $model->idUser = Yii::app()->user->id;
            $model->fechaMovimiento = date("Y-m-d H:i:s");

            if(isset($_POST['MovimientoAlmacen']))
            {
                $model->attributes=$_POST['MovimientoAlmacen'];
                if(!$deposito->isNewRecord){
                    $deposito->stockU = $deposito->stockU - $model->cantidadU;
                    while($deposito->stockU<0)
                    {
                        $deposito->stockU=$deposito->stockU+$almacen->idProducto0->cantXPaquete;
                        $deposito->stockP = $deposito->stockP - 1;
                    }
                    $deposito->stockP = $deposito->stockP - $model->cantidadP;

                    if($deposito->stockP < 0)
                        $model->addError('cantidadP','No existen suficientes insumos');
                    else{
                        if($model->save())
                        {
                            // form inputs are valid, do something here
                            $almacen->stockU = $almacen->stockU + $model->cantidadU;
                            $almacen->stockP = $almacen->stockP + $model->cantidadP;

                            if($almacen->save() && $deposito->save())
                                $this->redirect(array('stock/almacen','almacen'=>$_GET['almacen']));
                        }
                    }
                }
                else{
                    if($model->save())
                    {
                        // form inputs are valid, do something here
                        $almacen->stockU = $almacen->stockU + $model->cantidadU;
                        $almacen->stockP = $almacen->stockP + $model->cantidadP;

                        if($almacen->save())
                            $this->redirect(array('stock/almacen','almacen'=>$_GET['almacen']));
                    }
                }
            }
            $index=2;
            $this->renderPartial('forms/add_reduce',array('model'=>$model,'almacen'=>$almacen,'deposito'=>$deposito));

        }
        else
            throw new CHttpException(400,'La Respuesta de la pagina no Existe.');
    }

    public function actionMovimientos()
    {
        if(isset($_GET['excel']) && isset(Yii::app()->session['excel']))
        {
            $movimientos= Yii::app()->session['excel'];
            $dataProvider= $movimientos->searchReporte();
            $dataProvider->pagination= false; // for retrive all modules
            $data = $dataProvider->data;
            $columnsTitle=array('Nro','Codigo','Material','Detalle Producto','Industria','De','A','Cant. Unidad','Cant. Paquete','Fecha');
            $content=array();
            $index=1;
            foreach ($data as $item)
            {
                array_push($content,array($index,
                    $item->idProducto0->codigo,
                    $item->idProducto0->material,
                    $item->idProducto0->color." ".$item->idProducto0->detalle." ".$item->idProducto0->marca,
                    $item->idProducto0->industria,
                    (!empty($item->idAlmacenOrigen0))?$item->idAlmacenOrigen0->nombre:"",
                    (!empty($item->idAlmacenDestino0))?$item->idAlmacenDestino0->nombre:"",
                    $item->cantidadU,
                    $item->cantidadP,
                    $item->fechaMovimiento));
                $index++;
            }
            $this->createExcel($columnsTitle, $content);
        }
        $movimientos=new MovimientoAlmacen('searchReporte');
        $movimientos->unsetAttributes();
        if(isset($_GET['MovimientoAlmacen']))
        {
            $movimientos->attributes = $_GET['MovimientoAlmacen'];
            $movimientos->codigo = $_GET['MovimientoAlmacen']['codigo'];
            $movimientos->material = $_GET['MovimientoAlmacen']['material'];
            $movimientos->color = $_GET['MovimientoAlmacen']['color'];
            $movimientos->detalle = $_GET['MovimientoAlmacen']['detalle'];
            $movimientos->origen = $_GET['MovimientoAlmacen']['origen'];
            $movimientos->destino = $_GET['MovimientoAlmacen']['destino'];
            if(isset($_GET['MovimientoAlmacen']['start_date'])&& isset($_GET['MovimientoAlmacen']['end_date']))
            {
                $movimientos->start_date = $_GET['MovimientoAlmacen']['start_date'];
                $movimientos->end_date = $_GET['MovimientoAlmacen']['end_date'];
            }
        }

        $this->render('index',array(
            'render'=>'movimientos',
            'movimientos'=>$movimientos,
        ));
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

    private function createExcel($columnsTitle,$content,$title="")
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
        $objPHPExcel->getActiveSheet()->setTitle($title);


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Redirect output to a clientâ€™s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$title.'.xls"');
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

    protected function getUltimoDiaMes($elAnio,$elMes) {
        return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }
}
?>