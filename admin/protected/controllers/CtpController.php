<?php
class CtpController extends Controller
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
	
	public function actionMatrizPrecios()
	{
		$model ="";//  new MatrizPreciosCTP;	
		$placas = AlmacenProducto::model()->with('idProducto0')->findAll(array('condition'=>'idAlmacen=3', 'order'=>'idProducto0.detalle'));
		$tiposClientes = TiposClientes::model()->findAll('servicio=1');
		$cantidades = CantidadCTP::model()->findAll();
		$horarios = Horario::model()->findAll();
		
		$matriz = MatrizPreciosCTP::model()->findAll();
		if(!empty($matriz))
		{
			$model = array();
			$i=0; $j=0; $k=0;
			foreach ($placas as $placa)
				foreach ($tiposClientes as $tipoCliente)
					foreach ($cantidades as $cantidad)
						foreach ($horarios as $horario)
						{
							$model[$placa->idAlmacenProducto][$tipoCliente->idTiposClientes][$cantidad->idCantidadCTP][$horario->idHorario] = new MatrizPreciosCTP;
						}
					
			foreach ($matriz as $item)
			{
				$model[$item->idAlmacenProducto][$item->idTiposClientes][$item->idCantidad][$item->idHorario] = $item;
				if($i<$item->idCantidad)
					$i=$item->idCantidad;
				if($j<$item->idTiposClientes)
					$j=$item->idTiposClientes;
				if($k<$item->idAlmacenProducto)
					$k=$item->idAlmacenProducto;
			}
		}
		else
		{
			$model = new MatrizPreciosCTP;	
		}		
		
		if(isset($_POST['MatrizPreciosCTP']))
		{
			$model = array();
			//$model->attributes = $_POST['MatrizPreciosCTP'];
			$placas = array();
			foreach ($_POST['MatrizPreciosCTP'] as $key => $placa)
			{
				array_push($placas, AlmacenProducto::model()->with('idProducto0')->findByPk($key));
				$tiposClientes = array();
				foreach ($_POST['MatrizPreciosCTP'][$key] as $keyTC => $tipoCliente)
				{
					array_push($tiposClientes, TiposClientes::model()->find('servicio=1 and idTiposClientes='.$keyTC));
					$cantidades = array();
					foreach ($_POST['MatrizPreciosCTP'][$key][$keyTC] as $keyC => $cantidad)
					{
						array_push($cantidades, CantidadCTP::model()->findByPk($keyC));
						$horarios = array();
						foreach ($_POST['MatrizPreciosCTP'][$key][$keyTC][$keyC] as $keyH => $horario)
						{
							array_push($horarios, Horario::model()->findByPk($keyH));
							$model[$key][$keyTC][$keyC][$keyH] = MatrizPreciosCTP::model()->find('idAlmacenProducto='.$key.' and idTiposClientes='.$keyTC.' and idCantidad='.$keyC.' and idHorario='.$keyH);
							if(empty($model[$key][$keyTC][$keyC][$keyH]))
								$model[$key][$keyTC][$keyC][$keyH] = new MatrizPreciosCTP;
							
							$model[$key][$keyTC][$keyC][$keyH]->attributes = $horario;
							$model[$key][$keyTC][$keyC][$keyH]->idAlmacenProducto = $key;
							$model[$key][$keyTC][$keyC][$keyH]->idTiposClientes = $keyTC;
							$model[$key][$keyTC][$keyC][$keyH]->idCantidad = $keyC;
							$model[$key][$keyTC][$keyC][$keyH]->idHorario = $keyH;
							if($model[$key][$keyTC][$keyC][$keyH]->validate())
								$model[$key][$keyTC][$keyC][$keyH]->save();
						}
					}
				} 
			}
		}
		$this->render('matriz',array('model'=>$model,'placas'=>$placas,'tiposClientes'=>$tiposClientes,'cantidades'=>$cantidades,'horarios'=>$horarios));
	}
	
	public function actionHorario()
	{
		$model=new Horario;
		
		if(isset($_GET['id']))
			$model = Horario::model()->findByPk($_GET['id']);
		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='horario-horario-form')
		{
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
	
		if(isset($_POST['Horario']))
		{
			$model->attributes=$_POST['Horario'];
			if($model->save())
        	{
	        	// form inputs are valid, do something here
	        	$this->redirect(array('ctp/matrizPrecios'));
	    	}
		}
		$this->renderPartial('horario',array('model'=>$model));
	}
	
	public function actionCantidad()
	{
		$model=new CantidadCTP;
	
		if(isset($_GET['id']))
			$model = CantidadCTP::model()->findByPk($_GET['id']);
		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='cantidad-ctp-cantidad-form')
		{
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
	
		if(isset($_POST['CantidadCTP']))
		{
			$model->attributes=$_POST['CantidadCTP'];
			if($model->save())
        	{
	        	// form inputs are valid, do something here
	        	$this->redirect(array('ctp/matrizPrecios'));
	    	}
	   	}
	   	$this->renderPartial('cantidad',array('model'=>$model));
	}

	public function actionDelCantidad()
	{
		if(isset($_GET['id']))
		{
			$model = $this->verifyModel(CantidadCTP::model()->findByPk($_GET['id']));
			$matriz = MatrizPreciosCTP::model()->findAll('idCantidad='.$model->idCantidadCTP);
			//print_r($matriz);
			if(!empty($matriz))
			{
				$i = count($matriz);
				foreach ($matriz as $item)
				{
					if($item->delete())
						$i--;
				}
				if($i==0){
					if($model->delete())
						$this->redirect(array('ctp/matrizPrecios'));
				}
			}
			else
			{
				if($model->delete())
					$this->redirect(array('ctp/matrizPrecios'));
			}
		}
	}

    public function actionMovimientos()
    {
        $cond3="";
        $f="";
        $saldo="";
        $cf=array("ctp/movimientos",'f'=>0);
        $sf=array("ctp/movimientos",'f'=>1);
        $ventas = new CTP('searchCTP');

        $ventas->unsetAttributes();
        if(isset($_GET['f']))
            $ventas->tipoOrden = $_GET['f'];

        if(isset($_GET['d']) || isset($_GET['m']))
        {
            $d=date("d");
            $m=date("m");
            $y=date("Y");

            if(isset($_GET['d']) )
            {
                $d=$_GET['d'];
                if($d==0)
                {
                    $m=$m-1;
                    if($m<10 && $m>0)
                        $m = "0".$m;

                    $d=$this->getUltimoDiaMes($y, $m);
                }
                $ventas->fechaOrden = $y."-".$m."-".$d;
                $cf=array("ctp/movimientos",'f'=>0,'d'=>$_GET['d']);
                $sf=array("ctp/movimientos",'f'=>1,'d'=>$_GET['d']);
                //$cond3=array("distribuidora/previewDay","f"=>$ventas->tipoVenta,"d"=>date("d",strtotime($ventas->fechaVenta)));
            }
            if(isset($_GET['m']))
            {
                $m=$_GET['m'];
                $ventas->fechaOrden = $y."-".$m;
                $cf=array("ctp/movimientos",'f'=>0,'m'=>$_GET['m']);
                $sf=array("ctp/movimientos",'f'=>1,'m'=>$_GET['m']);
                //$cond3=array("distribuidora/previewDay","f"=>$ventas->tipoVenta,"m"=>date("m",strtotime($ventas->fechaVenta)));
            }

            if(isset($_GET['CTP']))
            {
                $ventas->attributes = $_GET['CTP'];

                if(isset($_GET['CTP']['apellido']))
                    $ventas->apellido = $_GET['CTP']['apellido'];
                if(isset($_GET['CTP']['nit']))
                    $ventas->nit = $_GET['CTP']['nit'];

            }

            if(isset($_GET['d']) )
                $cond3=array("ctp/previewDay","f"=>$ventas->tipoOrden,"d"=>date("d",strtotime($ventas->fechaOrden)));
            if(isset($_GET['m']))
                $cond3=array("ctp/previewDay","f"=>$ventas->tipoOrden,"m"=>date("m",strtotime($ventas->fechaOrden)));
        }



        if(isset($_GET['d']))
        {
            $saldo = CajaArqueo::model()->find(array('condition'=>"idCaja=".$this->cajaCTP." and fechaVentas<'".$ventas->fechaOrden."'",'order'=>'idCajaArqueo Desc'));
            //print_r($saldo);
            if(!empty($saldo))
                $saldo = $saldo->saldo;
        }

        $this->render('base',array('render'=>'movimientos','ventas'=>$ventas,'saldo'=>$saldo,'cond3'=>$cond3,'cf'=>$cf,'sf'=>$sf));
    }

    public function actionReport()
    {
        $this->render('index',array('render'=>''));
    }

    public function actionReportDate()
    {
        $cond3="";
        $saldo="";
        $cf=array("ctp/reportDate",'f'=>0);
        $sf=array("ctp/reportDate",'f'=>1);
        $ventas = new CTP('searchReport');

        $ventas->unsetAttributes();
        if(isset($_GET['CTP']['idSucursal']))
        {
        $ventas->idSucursal=$_GET['CTP']['idSucursal'];
        }
        if(isset($_GET['f']))
            $ventas->tipoOrden = $_GET['f'];

        if(isset($_GET['d']) || isset($_GET['m']))
        {
            $m=date("m");
            $y=date("Y");

            if(isset($_GET['d']) )
            {
                $d=$_GET['d'];
                if($d==0)
                {
                    $m=$m-1;
                    if($m<10 && $m>0)
                        $m = "0".$m;

                    $d=$this->getUltimoDiaMes($y, $m);
                }
                $ventas->fechaOrden = $y."-".$m."-".$d;
                $cf=array("ctp/reportDate",'f'=>0,'d'=>$_GET['d']);
                $sf=array("ctp/reportDate",'f'=>1,'d'=>$_GET['d']);
                //$cond3=array("distribuidora/previewDay","f"=>$ventas->tipoVenta,"d"=>date("d",strtotime($ventas->fechaVenta)));
            }
            if(isset($_GET['m']))
            {
                $m=$_GET['m'];
                $ventas->fechaOrden = $y."-".$m;
                $cf=array("ctp/reportDate",'f'=>0,'m'=>$_GET['m']);
                $sf=array("ctp/reportDate",'f'=>1,'m'=>$_GET['m']);
                //$cond3=array("distribuidora/previewDay","f"=>$ventas->tipoVenta,"m"=>date("m",strtotime($ventas->fechaVenta)));
            }

            if(isset($_GET['CTP']))
            {
                $ventas->attributes = $_GET['CTP'];

                if(isset($_GET['CTP']['apellido']))
                    $ventas->apellido = $_GET['CTP']['apellido'];
                if(isset($_GET['CTP']['nit']))
                    $ventas->nit = $_GET['CTP']['nit'];

            }

            /*if(isset($_GET['d']) )
                //$cond3=array("ctp/previewDay","f"=>$ventas->tipoOrden,"d"=>date("d",strtotime($ventas->fechaOrden)));
            if(isset($_GET['m']))
                //$cond3=array("ctp/previewDay","f"=>$ventas->tipoOrden,"m"=>date("m",strtotime($ventas->fechaOrden)));*/
        }



        if(isset($_GET['d']))
        {
            $saldo = CajaArqueo::model()->find(array('condition'=>"idCaja=".$this->cajaCTP." and fechaVentas<'".$ventas->fechaOrden."'",'order'=>'idCajaArqueo Desc'));
            if(!empty($saldo))
                $saldo = $saldo->saldo;
        }

        $this->render('index',array('render'=>'reportDate','model'=>$ventas,'saldo'=>$saldo,'cond3'=>$cond3,'cf'=>$cf,'sf'=>$sf));
    }

	public function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
		return $model;
	}
}
?>