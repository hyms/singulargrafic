
<?php
if($index==1)
{
	$this->renderPartial('distribuidora/productos',array('productos'=>$productos));
}	
if($index==0)
{
	$this->renderPartial('distribuidora/productosAdd',array('productos'=>$productos));
}
if($index==2)
{
	$this->renderPartial('distribuidora/add_reduce',array('model'=>$model,'almacen'=>$almacen,'deposito'=>$deposito));
}
?>
