
<?php
if($index==1)
{
	$this->renderPartial('ctp/productos',array('productos'=>$productos));
}	
if($index==0)
{
	$this->renderPartial('ctp/productosAdd',array('productos'=>$productos));
}
if($index==2)
{
	$this->renderPartial('add_reduce',array('model'=>$model,'almacen'=>$almacen,'deposito'=>$deposito));
}
?>
