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
			$model=$this->verifyModel(Empresa::model()->findByPk($id));
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
			if($model->validate())
			{
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
			}
			else 
			{
				$new=true;
			}
		}
		$this->render('empresa',array('model'=>$model,'sucursal'=>$sucursal,"new"=>$new,'servicios'=>$servicios));
	}

	public function actionEmpleado($id=null)
	{
		$model=new Empleado;
		$user=new Users;
		
		if($id!=null)
		{
			$model=$this->verifyModel(Empleado::model()->findByPk($id));
			$user=Users::model()->findByPk($model->idUsers);
			if($user==null)
				$user=new Users;
		}
			
		$empleados=Empleado::model()->findall();
		
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['Empleado']))
		{
			$model->attributes = $_POST['Empleado'];
			$model->sucursal = $_POST['sucursal'];
			$model->superior = $_POST['superior'];
			
			$user->attributes = $_POST['Users'];
			if($user->id!=null)
			{
				$userBpk = Users::model()->findByPk($user->id);
				if($userBpk->password!=$user->password)
					$user->password = md5($user->password);
			}
			else 
			{
				$user->password = md5($user->password);
			}
			
			if($model->validate())
			{
				$model->fechaIngreso=date("Y-m-d", strtotime($model->fechaIngreso));
				$user->validate();
				if($user->save())
				{
					$model->idUsers=$user->id;
					
				}
				if($model->save())
				{
					$this->redirect('empleado');
				}
			}
			else 
			{
				$new=true;
			}
		}	
		$this->render('empleado',array('model'=>$model, 'user'=>$user,'empleados'=>$empleados, 'new'=>$new));
			
	}
	
	public function actionServicios($id=null)
	{
		$model=new Servicios;
		if($id!=null)
		{
			$model=$this->verifyModel(Servicios::model()->findByPk($id));
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
			if($model->validate())
			{
				$model->fechaCreacion=date("Y-m-d H:i:s", strtotime($model->fechaCreacion));
				if($model->save())
				{
					$this->redirect('servicios');
				}
			}
			else
			{
				$new=true;
			}
		}
		$this->render('servicios',array('model'=>$model,'servicios'=>$servicios,'new'=>$new));
	}
	
	public function actionCliente($id=null)
	{
		$model=new Cliente;
		
		if($id!=null)
			$model=$this->verifyModel(Cliente::model()->findByPk($id));
			
		$clientes=Cliente::model()->findall();
	
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['Cliente']))
		{
			$model->attributes=$_POST['Cliente'];
			if($model->validate())
			{
				$model->fechaRegistro=date("Y-m-d", strtotime($model->fechaRegistro));
				
				if($model->save())
				{
					$this->redirect('cliente');
				}
			}
			else
			{
				$new=true;
			}
		}
		$this->render('cliente',array('model'=>$model,'clientes'=>$clientes,'new'=>$new));
	}
	
	public function actionProveedor($id=null)
	{
		$model=new Proveedor;
	
		if($id!=null)
			$model=$this->verifyModel(Proveedor::model()->findByPk($id));
			
		$proveedor=Proveedor::model()->findall();
		
		$new=false;
		if(isset($_POST['new']))
			$new=$_POST['new'];
		
		if(isset($_POST['Proveedor']))
		{
			$model->attributes=$_POST['Proveedor'];
			if($model->validate())
			{
				$model->fechaRegistro=date("Y-m-d", strtotime($model->fechaRegistro));
				if($model->save())
				{
					$this->redirect('proveedor');
				}
			}
			else
			{
				$new=true;
			}
		}
		$this->render('proveedor',array('model'=>$model,'proveedor'=>$proveedor,'new'=>$new));
	}
	
	
	//delete's
	public function actionSucursalDelete($id)
	{
		$model=$this->verifyModel(Empresa::model()->findByPk($id));
		$model->delete();
		$this->redirect(array('empresa/sucursal'));
	}
	public function actionEmpleadoDelete($id)
	{
		$model=$this->verifyModel(Empleado::model()->findByPk($id));
		$model->delete();
		$this->redirect(array('empresa/empleado'));
	}
	public function actionServiciosDelete($id)
	{	
		$model=$this->verifyModel(Servicios::model()->findByPk($id));
		$model->delete();
		$this->redirect(array('empresa/servicios'));
	}
	
	private function verifyModel($model)
	{
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		return $model;
	}
}