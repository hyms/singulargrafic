<?php
class ProductosController extends Controller
{
    public function filters()
    {
        return array( 'accessControl' ); // perform access control for CRUD operations
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'expression'=>'isset($user->role) && ($user->role<=2)',
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $this->render('index',array(
            'render'=>'index',));
    }

    public function actionProductos()
    {
        if(isset($_GET['excel']) && isset(Yii::app()->session['excel']))
        {
            $model= Yii::app()->session['excel'];
            $dataProvider= $model->searchInventarioGral();
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
            $this->createExcel($columnsTitle, $content,'Lista de Productos');
        }
        $dataProvider = new AlmacenProducto('searchInventarioGral');

        $dataProvider->unsetAttributes();
        if(isset($_GET['AlmacenProducto']))
        {
            $dataProvider->attributes = $_GET['AlmacenProducto'];
            $dataProvider->codigo = $_GET['AlmacenProducto']['codigo'];
            $dataProvider->industria = $_GET['AlmacenProducto']['industria'];
            $dataProvider->material = $_GET['AlmacenProducto']['material'];
            $dataProvider->detalle = $_GET['AlmacenProducto']['detalle'];
        }

        $this->render('index',array(
            'render'=>'productos',
            'dataProvider'=>$dataProvider,
        ));
    }

    public function actionNew()
    {
        $model=new Producto;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Producto']))
        {
            $model->attributes=$_POST['Producto'];
            if($model->save())
                if($this->initStock($model->idProducto))
                    $this->redirect(array('productos'));
        }

        $this->render('index',array(
            'render'=>'new',
            'model'=>$model,
        ));
    }

    public function actionEdit()
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
                    $this->redirect(array('productos'));
            }

            $this->render('index',array(
                'render'=>'edit',
                'model'=>$model,
            ));
        }
        else
            throw new CHttpException(400,'La Respuesta de la pagina no Existe.');
    }

    public function actionProductoAdd()
    {
        $almacences = Almacen::model()->findAll('idSucursal IS NOT NULL and idSucursal<>""');
        if(isset($_GET['almacen']))
        {
            $dataProvider = new AlmacenProducto('searchInventarioGral');
            $dataProvider->unsetAttributes();
            if(isset($_GET['AlmacenProducto']))
            {
                $dataProvider->attributes = $_GET['AlmacenProducto'];
                $dataProvider->codigo = $_GET['AlmacenProducto']['codigo'];
                $dataProvider->industria = $_GET['AlmacenProducto']['industria'];
                $dataProvider->material = $_GET['AlmacenProducto']['material'];
                $dataProvider->detalle = $_GET['AlmacenProducto']['detalle'];
            }
            if(isset($_GET['id']))
            {
                $this->initStock($_GET['id'],$_GET['almacen']);
            }
            $this->render('index',array('render'=>'addRemove','dataProvider'=>$dataProvider,'almacen'=>$_GET['almacen'],'almacenes'=>$almacences));
        }
        else
            $this->render('index',array('render'=>'addRemove','dataProvider'=>'','almacen'=>'','almacenes'=>$almacences));
    }

    public function actionProductoDel()
    {
        if(isset($_GET['almacen']))
        {
            if(isset($_GET['id']))
            {
                //$this->initStock($_GET['id'],$_GET['almacen']);
                $almacen = AlmacenProducto::model()->findByPk($_GET['id']);
                if($almacen->stockU >0 || $almacen->stockP)
                {
                    $almacen0 = AlmacenProducto::model()->findByPk('almacen=1 and idProducto='.$almacen->idProducto);
                    $almacen0->stockU =$almacen0->stockU + $almacen->stockU;
                    $almacen0->stockP =$almacen0->stockP + $almacen->stockP;
                    $almacen0->save();
                }
                //$almacen->delete();
            }
            $this->redirect(array('productoAdd','almacen'=>$_GET['almacen']));
        }
        else
            $this->redirect(array('productoAdd'));
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

    public function verifyModel($model)
    {
        if($model===null)
            throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
        return $model;
    }
    private function initStock($id,$alm=1)
    {
        $almacen = new AlmacenProducto;
        $almacen->idAlmacen=$alm;
        $almacen->idProducto=$id;
        $almacen->stockU=0;
        $almacen->stockP=0;
        //print_r($almacen);
        return $almacen->save();
    }
}