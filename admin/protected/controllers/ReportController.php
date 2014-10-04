<?php 
class ReportController extends Controller
{
	public function filters()
	{
		return array( 'accessControl' ); // perform access control for CRUD operations
	}
	
	public function accessRules() {
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'expression'=>'isset($user->role) && (($user->role<=2))',
			),
			array('deny',
					'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{
		/*$dataProvider=new CActiveDataProvider('AlmacenProducto',
				array(	
						'criteria'=>array(
							'condition'=>'idAlmacen=1',
							'with'=>array('idProducto0'),
						),
						'pagination'=>array(
						'pageSize'=>'20',
				),));*/
		$this->render('index');
	}

	public function actionProducto()
	{
		$this->render('index',array('render'=>'producto'));
	}
	
	public function actionProductoSaldo()
	{
		if(isset($_GET['almacen']))
		{
			$startDate=date("Y")."-".date("m")."-1 00:00:00";
			$endDate=date("Y-m-d H:i:s");
				
			$startDateS=date("Y")."-".(date("m")-1)."-1 00:00:00";
			$endDateS=date("Y")."-".date("m")."-1 00:00:00";
			
			$this->getSaldoAnterior($_GET['almacen']);
			$almacenes = AlmacenProducto::model()->with('idProducto0')->findAll('idAlmacen='.$_GET['almacen']);
			
			$saldos = array();
			$entradaU=array();$entradaP=array();
			$salidasU=array();$salidasP=array();
			$entradasF=array();
			$salidasF=array();
			$costoF=array();
			foreach ($almacenes as $key => $almacen)
			{
				$saldoA[$key] = new SaldoProducto;
				$entradaU[$key]=0;$entradaP[$key]=0;
				$salidasU[$key]=0;$salidasP[$key]=0;
				$saldo = SaldoProducto::model()->with('idAlmacen0')->with('idAlmacen0.idProducto0')->find('`t`.idAlmacen='.$almacen->idAlmacenProducto);
				$entradas = MovimientoAlmacen::model()->findAll('idAlmacenDestino='.$almacen->idAlmacen.' and idProducto='.$almacen->idProducto.' and fechaMovimiento Between "'.$startDate.'" and "'.$endDate.'"');
				foreach ($entradas as $entrada)
				{
					$entradaU[$key]=$entradaU[$key]+$entrada->cantidadU;
					$entradaP[$key]=$entradaP[$key]+$entrada->cantidadP;
				}
				$salidas = MovimientoAlmacen::model()->findAll('idAlmacenOrigen='.$almacen->idAlmacen.' and idProducto='.$almacen->idProducto.' and fechaMovimiento Between "'.$startDate.'" and "'.$endDate.'"');
				foreach ($salidas as $salida)
				{
					$salidasU[$key]=$salidasU[$key]+$salida->cantidadU;
					$salidasP[$key]=$salidasP[$key]+$salida->cantidadP;
				}
				$saldos[$key]=$saldo;
				$saldoA[$key]->saldoU=$entradaU[$key]-$salidasU[$key];
				$saldoA[$key]->saldoP=$entradaP[$key]-$salidasP[$key];
				while($saldoA[$key]->saldoU<0 && $saldo['idAlmacen0']['idProducto0']['cantXPaquete']!=0)
				{
					$saldoA[$key]->saldoP=$saldoA[$key]->saldoP-1;
					$saldoA[$key]->saldoU=$saldoA[$key]->saldoU+$saldo['idAlmacen0']['idProducto0']['cantXPaquete'];
				}
				
				$saldoA[$key]->idAlmacen=$almacen->idAlmacenProducto;
				$entradasF[$key]=array('unidad'=>$entradaU[$key],'paquete'=>$entradaP[$key]);
				$salidasF[$key]=array('unidad'=>$salidasU[$key],'paquete'=>$salidasP[$key]);
				$costoF[$key]=($saldoA[$key]->saldoU*$almacen->idProducto0->precioSFU)+($saldoA[$key]->saldoP*$almacen->idProducto0->precioSFP);
			}
			if(isset($_GET['excel']))
			{
				$this->exportExcel($saldos, $entradasF, $salidasF, $saldoA, $costoF);
			}
            $this->render('index',array('render'=>'saldos','saldoA'=>$saldos,'entradas'=>$entradasF,'salidas'=>$salidasF,'saldoB'=>$saldoA,'costos'=>$costoF,'almacen'=>$_GET['almacen']));
		}
		else
			$this->render('index',array('render'=>'saldos','saldoA'=>'','entradas'=>'','salidas'=>'','saldoB'=>'','costos'=>'','almacen'=>''));
	}
	
	public function actionProductoAgotarse()
	{
		if(isset($_GET['almacen']))
		{
			$almacenes = AlmacenProducto::model()->with('idProducto0')->findAll('idAlmacen='.$_GET['almacen'].' and (stockP+(stockU/idProducto0.cantXPaquete))<=5');
			//print_r($almacenes);return true;
			$this->render('index',array('render'=>'agotarse','resultado'=>$almacenes));
		}
		else 
			$this->render('index',array('render'=>'agotarse','resultado'=>''));
	}
	
	public function actionCliente()
	{
		$this->render('cliente');
	}
	
	public function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
		return $model;
	}

	protected function getUltimoDiaMes($elAnio,$elMes) {
		return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
	}
	
	protected function getSaldoAnterior($almacen)
	{
		$startDateS=date("Y")."-".(date("m")-1)."-1 00:00:00";
		$endDateS=date("Y")."-".date("m")."-1 00:00:00";
		$saldos = SaldoProducto::model()->with('idAlmacen0')->with('idAlmacen0.idProducto0')->findAll(array('condition'=>'`idAlmacen0`.idAlmacen='.$almacen.' and `t`.fechaSaldo Between "'.$startDateS.'" and "'.$endDateS.'"','order'=>'idProducto0.Material,idProducto0.codigo, idProducto0.detalle'));
			
		if(empty($saldos) || count($saldos)==0)
		{
			$almacenes = AlmacenProducto::model()->findAll('idAlmacen='.$almacen);
			foreach ($almacenes as $key => $almacen)
			{
				$saldos = new SaldoProducto;
				$entradaTU=0;$entradaTP=0;
				$salidasTU=0;$salidasTP=0;
				$entradas = MovimientoAlmacen::model()->findAll('idAlmacenDestino='.$almacen->idAlmacen.'  and idProducto='.$almacen->idProducto.' and fechaMovimiento Between "'.$startDateS.'" and "'.$endDateS.'"');
				foreach ($entradas as $entrada)
				{
					$entradaTU=$entradaTU+$entrada->cantidadU;
					$entradaTP=$entradaTP+$entrada->cantidadP;
				}
				$salidas = MovimientoAlmacen::model()->findAll('idAlmacenOrigen='.$almacen->idAlmacen.'  and idProducto='.$almacen->idProducto.' and fechaMovimiento Between "'.$startDateS.'" and "'.$endDateS.'"');
				foreach ($salidas as $salida)
				{
					$salidasTU=$salidasTU+$salida->cantidadU;
					$salidasTP=$salidasTP+$salida->cantidadP;
				}
				$saldos->saldoU=$entradaTU-$salidasTU;
				$saldos->saldoP=$entradaTP-$salidasTP;
				$saldos->idAlmacen=$almacen->idAlmacenProducto;
				$saldos->fechaRealizado=date("Y-m-d H:i:s");
				$saldos->fechaSaldo=date("Y")."-".(date("m")-1)."-".$this->getUltimoDiaMes(date("Y"), (date("m")-1));
				$saldos->save();
				//print_r($saldos->attributes);
				//echo '<br>';
			}
			$saldos = SaldoProducto::model()->with('idAlmacen0')->with('idAlmacen0.idProducto0')->findAll(array('condition'=>'`idAlmacen0`.idAlmacen='.$almacen.' and `t`.fechaSaldo Between "'.$startDateS.'" and "'.$endDateS.'"','order'=>'idProducto0.Material,idProducto0.codigo, idProducto0.detalle'));
		}
		return $saldos;
	}
	
	private function exportExcel($saldoA,$entradas,$salidas,$saldoB,$costos)
	{
        foreach ($saldoA as $key=>$item)
        {
            //print_r($item['idAlmacen']); return true;
            $resultado[$key]=array(
                'id'=>$item['idAlmacen'],
                'codigo'=>$item['idAlmacen0']['idProducto0']['codigo'],
                'detalle'=>$item['idAlmacen0']['idProducto0']['material'].", ".$item['idAlmacen0']['idProducto0']['color']." ".$item['idAlmacen0']['idProducto0']['detalle'].", ".$item['idAlmacen0']['idProducto0']['marca'],
                'saldoAnterior'=>array('saldoU'=>$item['saldoU'],'saldoP'=>$item['saldoP']),
                'entradas'=>array('saldoU'=>$entradas[$key]['unidad'],'saldoP'=>$entradas[$key]['paquete']),
                'salidas'=>array('saldoU'=>$salidas[$key]['unidad'],'saldoP'=>$salidas[$key]['paquete']),
                'saldoActual'=>array('saldoU'=>$saldoB[$key]->saldoU,'saldoP'=>$saldoB[$key]->saldoP),
                'costo'=>$costos[$key],
            );
        }
		//print_r($resultado);
		$resultado = $this->array_orderby($resultado, 'detalle', SORT_ASC);
		//array_multisort($resultado['detalle'], SORT_ASC);
		$columnsTitle=array('No','codigo','Detalle Producto','Saldo Anterior','','Entradas','','Salidas','','Saldo Actual','','Costo');
		$content=array();
		$index=1;
		foreach ($resultado as $item)
		{
			array_push($content,array($index,
			$item['codigo'],
			$item['detalle'],
			$item['saldoAnterior']['saldoU'],$item['saldoAnterior']['saldoP'],
			$item['entradas']['saldoU'],$item['entradas']['saldoP'],
			$item['salidas']['saldoU'],$item['salidas']['saldoP'],
			$item['saldoActual']['saldoU'],$item['saldoActual']['saldoP'],
			$item['costo']));
			$index++;
		}
		
		$total = 0;
		foreach ($costos as $costo)
			$total=$total+$costo;
		array_push($content,array('','','','','','','','','','','Total',$total));
		//print_r($content);
		$this->createExcel($columnsTitle, $content,'Saldos de Productos '.date('Ymd'));
	}
	/*public function actionBalance()
	{
		$startDate=date("Y")."-".date("m")."-1 00:00:00";
		$endDate=date("Y-m-d H:i:s");
			
		$startDateS=date("Y")."-".(date("m")-1)."-1 00:00:00";
		$endDateS=date("Y")."-".date("m")."-1 00:00:00";
		
		$saldos = $this->getSaldoAnterior($_GET['almacen']);
		$almacenes = AlmacenProducto::model()->findAll('idAlmacen='.$_GET['almacen']);
		
		$saldo = array();
		$entradaTU=array();$entradaTP=array();
		$salidasTU=array();$salidasTP=array();
		foreach ($almacenes as $key => $almacen)
		{
			$saldoA[$key] = new SaldoProducto;
			$entradaTU[$key]=0;$entradaTP[$key]=0;
			$salidasTU[$key]=0;$salidasTP[$key]=0;
			$entradas = MovimientoAlmacen::model()->findAll('idAlmacenDestino='.$almacen->idAlmacen.' and idProducto='.$almacen->idProducto.' and fechaMovimiento Between "'.$startDate.'" and "'.$endDate.'"');
			foreach ($entradas as $entrada)
			{
				$entradaTU[$key]=$entradaTU[$key]+$entrada->cantidadU;
				$entradaTP[$key]=$entradaTP[$key]+$entrada->cantidadP;
			}
			$salidas = MovimientoAlmacen::model()->findAll('idAlmacenOrigen='.$almacen->idAlmacen.' and idProducto='.$almacen->idProducto.' and fechaMovimiento Between "'.$startDate.'" and "'.$endDate.'"');
			foreach ($salidas as $salida)
			{
				$salidasTU[$key]=$salidasTU[$key]+$salida->cantidadU;
				$salidasTP[$key]=$salidasTP[$key]+$salida->cantidadP;
			}
			$saldoA[$key]->saldoU=$entradaTU[$key]-$salidasTU[$key];
			$saldoA[$key]->saldoP=$entradaTP[$key]-$salidasTP[$key];
			$saldoA[$key]->idAlmacen=$almacen->idAlmacenProducto;
			if($saldoA[$key]->saldoU !=$almacen->stockU || $saldoA[$key]->saldoP !=$almacen->stockP)
			{
				$movimiento=new MovimientoAlmacen;
				$movimiento->idProducto = $almacen->idProducto0->idProducto;
				$movimiento->idAlmacenDestino = $almacen->idAlmacen;
				//$movimiento->idAlmacenOrigen = $almacen->idAlmacen;
				//$idUser->idUser = Yii::app()->user->id;
				$movimiento->fechaMovimiento = date("Y-m-d H:i:s");
				if($saldoA[$key]->saldoU !=$almacen->stockU)
					$movimiento->cantidadU = $almacen->stockU+$salidasTU[$key];
				if($saldoA[$key]->saldoP !=$almacen->stockP)
					$movimiento->cantidadP = $almacen->stockP+$salidasTP[$key];
				
				$movimiento->obs = "Balance de Sistema";
				$movimiento->save();
			}
		}
		$entradas=array('unidad'=>$entradaTU,'paquete'=>$entradaTP);
		$salidas=array('unidad'=>$salidasTU,'paquete'=>$salidasTP);
		$this->render('productoSaldo',array('saldoA'=>$saldos,'entradas'=>$entradas,'salidas'=>$salidas,'saldoB'=>$saldoA));
	}*/

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
	
	private function array_orderby()
	{
		$args = func_get_args();
		$data = array_shift($args);
		foreach ($args as $n => $field) {
			if (is_string($field)) {
				$tmp = array();
				foreach ($data as $key => $row)
					$tmp[$key] = $row[$field];
				$args[$n] = $tmp;
			}
		}
		$args[] = &$data;
		call_user_func_array('array_multisort', $args);
		return array_pop($args);
	}
}