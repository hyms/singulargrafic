<?php 
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							/*array('label'=>'Nueva Venta', 'url'=>array('/distribuidora/index')),
							array('label'=>'Ventas por Confirmar', 'url'=>array('/distribuidora/venta')),
							array('label'=>'Ventas Realizadas', 'url'=>array('/distribuidora/ventas')),
							array('label'=>'Ventas a Credito', 'url'=>array('/distribuidora/credito')),*/
							//array('label'=>'Reportes de Ventas', 'url'=>array('/distribuidora/reporte')),
							//array('label'=>'Producto', 'url'=>array('producto/index')),
							array('label'=>'Notas de Venta', 'url'=>array('#')),
							array('label'=>'Deudores', 'url'=>array('#')),
							array('label'=>'Movimientos', 'url'=>array('#')),
							
						),
				)); 
?>