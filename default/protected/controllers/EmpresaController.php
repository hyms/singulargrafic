<?php

class EmpresaController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionSucursal($id=null)
	{
		$model=new Empresa;
		$servicios = new Servicios;
		if($id!=null)
		{
			$model=Empresa::model()->findByPk($id);
			$servicios=Servicios::model()->with('empresaServicio')->findall('idEmpresa='.$id);
		}
		
		$sucursal=Empresa::model()->findall();
		
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['Empresa']))
		{
			$model->attributes=$_POST['Empresa'];
			$model->ciudad=$_POST['ciudad']; 
			$model->patern=$_POST['Superior'];
			
			if($model->save())
			{
				$count=0;
				EmpresaServicio::model()->deleteAll('idEmpresa='.$model->id);
				
				while(isset($_POST['Servicios'.$count]))
				{
					$ser= EmpresaServicio::model()->find('idEmpresa='.$model->id.' and idServicio='.$_POST['Servicios'.$count]);
					if(empty($ser))
						$ser = new EmpresaServicio;
					
					$ser->idEmpresa=$model->id;
					$ser->idServicio=$_POST['Servicios'.$count];
					
					if(isset($_POST['Servicios'.$count-1]))
					{
						$sw=0;
						for($id=0;$i<=$count;$i++)
						{
							if($_POST['Servicios'.$i]==$_POST['Servicios'.$count])
							{
								$sw=1; break;
							}
						}
						if($sw==0)
							$ser->save();
					}
					else 
					{
						$ser->save();
					}
					$count++;
				}
				$this->redirect('sucursal');
			}
			else 
			{
				$this->render('empresa',array('model'=>$model,'sucursal'=>$sucursal,"new"=>$new,'servicios'=>$servicios));
			}
		}
		else 
		{
			$this->render('empresa',array('model'=>$model,'sucursal'=>$sucursal,"new"=>$new,'servicios'=>$servicios));
		}
	}

	public function actionEmpleado($id=null)
	{
		$model=new Empleado;
		
		if($id!=null)
			$model=Empleado::model()->findByPk($id);
			
		$empleados=Empleado::model()->findall();
		
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['Empleado']))
		{
			$model->attributes=$_POST['Empleado'];
			$model->sucursal=$_POST['sucursal'];
			$model->superior=$_POST['superior'];
			$model->fechaIngreso=date("Y-m-d", strtotime($model->fechaIngreso));
			
			if($model->save())
			{
				$this->redirect('empleado');
			}
			else 
			{
				$this->render('empleado',array('model'=>$model,'empleados'=>$empleados,'new'=>$new));
			}
		}
		else 
		{
			$this->render('empleado',array('model'=>$model,'empleados'=>$empleados,'new'=>$new));
		}
	}
	
	public function actionServicios($id=null)
	{
		$model=new Servicios;
		if($id!=null)
		{
			$model=Servicios::model()->findByPk($id);
		}
		$servicios=Servicios::model()->findall();
		
		$new=false;
		if(isset($_POST['new']))
		{
			$new=$_POST['new'];
		}
		if(isset($_POST['Servicios']))
		{
			$model->attributes=$_POST['Servicios'];
			$model->fechaCreacion=date("Y-m-d H:i:s", strtotime($model->fechaCreacion));
			print_r($_POST['Servicios']);
			if($model->save())
			{
				$this->redirect('servicios');
			}
			else
			{
				$this->render('servicios',array('model'=>$model,'servicios'=>$servicios,'new'=>$new));
			}
		}
		else
		{
			$this->render('servicios',array('model'=>$model,'servicios'=>$servicios,'new'=>$new));
		}
	}
	
	public function actionCliente($id=null)
	{
		$model=new Cliente;
		
		if($id!=null)
			$model=Cliente::model()->findByPk($id);
			
		$clientes=Cliente::model()->findall();
	
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['Cliente']))
		{
			$model->attributes=$_POST['Cliente'];
			$model->fechaRegistro=date("Y-m-d", strtotime($model->fechaRegistro));
			
			if($model->save())
			{
				$this->redirect('cliente');
			}
			else 
			{
				$this->render('cliente',array('model'=>$model,'clientes'=>$clientes,'new'=>$new));
			}
		}
		else 
		{
			$this->render('cliente',array('model'=>$model,'clientes'=>$clientes,'new'=>$new));
		}
	}
	
	public function actionProveedor($id=null)
	{
		$model=new Proveedor;
	
		if($id!=null)
			$model=Proveedor::model()->findByPk($id);
			
		$proveedor=Proveedor::model()->findall();
		
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['Proveedor']))
		{
			$model->attributes=$_POST['Proveedor'];
			$model->fechaRegistro=date("Y-m-d", strtotime($model->fechaRegistro));
			
			if($model->save())
			{
				$this->redirect('proveedor');
			}
			else 
			{
				$this->render('proveedor',array('model'=>$model,'proveedor'=>$proveedor,'new'=>$new));
			}
		}
		else 
		{
			$this->render('proveedor',array('model'=>$model,'proveedor'=>$proveedor,'new'=>$new));
		}
	}
	
	
	//delete's
	public function actionSucursalDelete($id)
	{
		$model=Empresa::model()->findByPk($id);
		$model->delete();
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('empresa/sucursal'));
	}
	public function actionEmpleadoDelete($id)
	{
		$model=Empleado::model()->findByPk($id);
		$model->delete();
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('empresa/empleado'));
	}
	public function actionServiciosDelete($id)
	{	
		$model=Servicios::model()->findByPk($id);
		$model->delete();
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('empresa/servicios'));
	}
}