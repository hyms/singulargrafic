<?php
class CtpController extends Controller
{ 
	
	public function actionMatrizPrecios()
	{
		$model ="";//  new MatrizPreciosCTP;	
		$placas = AlmacenProducto::model()->with('idProducto0')->findAll('idAlmacen=3');
		$tiposClientes = TiposClientes::model()->findAll('servicio=1');
		$cantidades = CantidadCTP::model()->findAll();
		$horarios = Horario::model()->findAll();
		
		$matriz = MatrizPreciosCTP::model()->findAll();
		if(!empty($matriz))
		{
			$model = array();
			$i=0; $j=0; $k=0;
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
			$cantidad = end($cantidades);
			if($i<$cantidad->idCantidadCTP)
			{
				foreach ($placas as $placa)
					foreach ($tiposClientes as $tipoCliente)
						foreach ($horarios as $horario)
						{
							$model[$placa->idAlmacenProducto][$tipoCliente->idTiposClientes][$cantidad->idCantidadCTP][$horario->idHorario] = new MatrizPreciosCTP;
						}
						
			}
			$tipoCliente = end($tiposClientes);
			if($j<$tipoCliente->idTiposClientes)
			{
				foreach ($placas as $placa)
					foreach ($cantidades as $cantidad)
						foreach ($horarios as $horario)
						{
							$model[$placa->idAlmacenProducto][$tipoCliente->idTiposClientes][$cantidad->idCantidadCTP][$horario->idHorario] = new MatrizPreciosCTP;
						}
			
			}
			$placa = end($placas);
			if($k<$placa->idAlmacenProducto)
			{
				foreach ($tiposClientes as $tipoCliente)
					foreach ($cantidades as $cantidad)
						foreach ($horarios as $horario)
						{
							$model[$placa->idAlmacenProducto][$tipoCliente->idTiposClientes][$cantidad->idCantidadCTP][$horario->idHorario] = new MatrizPreciosCTP;
						}
						
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
	
	public function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'La Respuesta de la pagina no Existe.');
		return $model;
	}
}
?>