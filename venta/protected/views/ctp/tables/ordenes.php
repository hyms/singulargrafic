<h3><?php echo "Ordenes de trabajo";?></h3>
<?php 
$sw=0;

if(!empty($estado))
	$sw=$estado;

if($sw==1)
{
	$this->renderPartial('menus/ordenes');
} 
?>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$ordenes,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
			array(
					'header'=>'Nro',
					'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
			),
			array(
					'header'=>'codigo',
					'value'=>'$data->codigo',
			),
			array(
					'header'=>'Apellido Cliente',
					'value'=>'(isset($data->idCliente0->apellido))?$data->idCliente0->apellido:""',
			),
			array(
					'header'=>'Costo',
					'value'=>'$data->montoVenta',	
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'($data->tipoCTP==1)?CHtml::link("Ver",array("ctp/orden","id"=>$data->idCTP),array("class"=>"btn btn-success btn-sm")):""',
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'($data->estado==2 || $data->tipoCTP!=1)?CHtml::link("imprimir",array("ctp/preview","id"=>$data->idCTP)):""',	
			),
		)
	));
?>