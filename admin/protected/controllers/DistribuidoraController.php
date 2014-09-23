<?php
class DistribuidoraController extends Controller
{
    var $cajaDistribuidora=2;
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

    public function actionReport()
    {
        $this->render('reports',array('render'=>'report'));
    }

    public function actionReportDate()
    {
        if(isset($_GET['excel']) && isset(Yii::app()->session['excel']))
        {
            $model = Yii::app()->session['excel'];
            $dataProvider= $model->searchDistribuidora();
            $dataProvider->pagination= false; // for retrive all modules
            $data = $dataProvider->data;

            $columnsTitle=array('Nro','Nº de Venta','Apellido','NitCI','Monto de la Venta','Monto Pagado','Fecha');
            $content=array();
            $index=1;
            foreach ($data as $item)
            {
                array_push($content,array($index,
                    $item->codigo,
                    $item->idCliente0->apellido,
                    $item->idCliente0->nitCi,
                    $item->montoVenta,
                    $item->montoPagado,
                    $item->fechaVenta,
                ));
                $index++;
            }
            $total=0;
            foreach ($data as $item)
            {
                $dato=$item->montoPagado-$item->montoCambio;
                if($dato>0)
                    $total = $total+$dato;
            }
            array_push($content,array('','','','','','total',$total));
            $this->createExcel($columnsTitle, $content,'Reporte de Ventas '.date('Ymd'));
        }
        $cond3="";
        $f="";
        $saldo="";
        $cf=array("distribuidora/reportDate",'f'=>0);
        $sf=array("distribuidora/reportDate",'f'=>1);
        $ventas = new Venta('searchDistribuidora');

        $ventas->unsetAttributes();
        if(isset($_GET['singular']))
            $ventas->nit="000";

        if(isset($_GET['f']))
            $ventas->tipoVenta = $_GET['f'];

        if(isset($_GET['d']) || isset($_GET['m']))
        {
            $d=date("d");
            $m=date("m");
            $y=date("Y");
            if(isset($_GET['d']))
            {
                $d=$_GET['d'];
                if($d==0)
                {
                    $m=$m-1;
                    if($m<10 && $m>0)
                        $m = "0".$m;

                    $d=$this->getUltimoDiaMes($y, $m);
                }
                $ventas->fechaVenta = $y."-".$m."-".$d;
                $cf=array("distribuidora/reportDate",'f'=>0,'d'=>$_GET['d']);
                $sf=array("distribuidora/reportDate",'f'=>1,'d'=>$_GET['d']);
            }
            if(isset($_GET['m']))
            {
                $m=$_GET['m'];
                $ventas->fechaVenta = $y."-".$m;
                $cf=array("distribuidora/reportDate",'f'=>0,'m'=>$_GET['m']);
                $sf=array("distribuidora/reportDate",'f'=>1,'m'=>$_GET['m']);
            }

        }

        //print_r($ventas);
        if(isset($_GET['Venta']))
        {
            $ventas->attributes = $_GET['Venta'];

            if(isset($_GET['Venta']['apellido']))
                $ventas->apellido = $_GET['Venta']['apellido'];
            if(isset($_GET['Venta']['nit']))
                $ventas->nit = $_GET['Venta']['nit'];

        }

        if(isset($_GET['d']))
        {
            $saldo = CajaArqueo::model()->find(array('condition'=>"idCaja=".$this->cajaDistribuidora." and fechaVentas<'".$ventas->fechaVenta."'",'order'=>'idCajaArqueo Desc'));
            //print_r($saldo);
            if(!empty($saldo))
                $saldo = $saldo->saldo;
        }

        $this->render('reports',array('render'=>'movimientos','ventas'=>$ventas,'saldo'=>$saldo,'cf'=>$cf,'sf'=>$sf));
    }

    public function actionReportProducto()
    {
        if(isset($_GET['excel']) && isset(Yii::app()->session['excel']))
        {
            $model = Yii::app()->session['excel'];
            $dataProvider= $model->searchVenta();
            $dataProvider->pagination= false; // for retrive all modules
            $datas = $dataProvider->data;

            $columnsTitle=array('Nro','Nº de Venta','Apellido','Codigo','material','color','detalle','cantidad Unidad','cantidad paquete','Fecha');
            $content=array();
            $index=1;
            foreach ($datas as $data)
            {
                array_push($content,array($index,
                    $data->idVenta0->codigo,
                    $data->idVenta0->idCliente0->apellido,
                    $data->idAlmacenProducto0->idProducto0->codigo,
                    $data->idAlmacenProducto0->idProducto0->material,
                    $data->idAlmacenProducto0->idProducto0->color,
                    $data->idAlmacenProducto0->idProducto0->detalle,
                    $data->cantidadU,
                    $data->cantidadP,
                    $data->idVenta0->fechaVenta
                ));
                $index++;
            }

            $this->createExcel($columnsTitle, $content, 'Ventas por Productos '.date('Ymd'));
        }
        $movimentoProducto=new DetalleVenta('searchVenta');
        //init filter
        $movimentoProducto->unsetAttributes();
        if (isset($_GET['DetalleVenta'])){
            //$movimentoProducto->attributes = $_GET['DetalleVenta'];
            $movimentoProducto->codigo=$_GET['DetalleVenta']['codigo'];
            $movimentoProducto->fecha=$_GET['DetalleVenta']['fecha'];
            //$movimentoProducto->apellido=$_GET['DetalleVenta'];
            $movimentoProducto->codigoProducto=$_GET['DetalleVenta']['codigoProducto'];
            $movimentoProducto->color=$_GET['DetalleVenta']['color'];
            $movimentoProducto->material=$_GET['DetalleVenta']['material'];
            $movimentoProducto->detalle=$_GET['DetalleVenta']['detalle'];
        }
        //end filter
        $this->render('reports',array('render'=>'movProducto','ventas'=>$movimentoProducto));
    }
    public function actionVentaView()
    {
        if(isset($_GET['id']))
        {
            $ventas = Venta::model()
                ->with("idCliente0")
                ->with("detalleVentas")
                ->with("detalleVentas.idAlmacenProducto0")
                ->with("detalleVentas.idAlmacenProducto0.idProducto0")
                ->with("idCajaMovimientoVenta0")
                ->with("idCajaMovimientoVenta0.idUser0")
                ->with("idCajaMovimientoVenta0.idUser0.idEmpleado0")
                ->findByPk($_GET['id']);
            $this->renderPartial('tables/detalleVenta',array('venta'=>$ventas));
        }
        else
            throw new CHttpException(400,'Petición no válida.');
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

    public function verifyModel($model)
    {
        if($model===null)
            throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
        return $model;
    }
}