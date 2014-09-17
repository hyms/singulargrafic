<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
<?php 
	$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Envios Realizados', 'url'=>array('caja/envios','envios'=>true)),
							array('label'=>'Nuevo Envio', 'url'=>array('caja/envios','nuevo'=>true)),
						),
				)); 
?>	

<?php if(isset($realizado)){?>
<h3>Envios de Materiales</h3>
<?php 


	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$envios->search(),
		'filter'=>$envios,
		'ajaxUpdate'=>true,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
			array(
					'header'=>'Nro',
					'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
			),

			array(
					'header'=>'Origen',
					'type'=>'raw',
					'value'=>'$data->origen',
					'filter'=>CHtml::activeTextField($envios, 'origen',array("class"=>"form-control input-sm")),
			),
			array(
					'header'=>'Destino',
					'type'=>'raw',
					'value'=>'$data->destino',
					'filter'=>CHtml::activeTextField($envios, 'destino',array("class"=>"form-control input-sm")),
			),
			array(
					'header'=>'Fecha de Envio',
					'type'=>'raw',
					'value'=>'$data->fechaEnvio',
					'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'name'=>'fechaEnvio',
							'attribute'=>'fechaEnvio',
							'language'=>'es',
							'model'=>$envios,
							'options'=>array(
									'showAnim'=>'fold',
									'dateFormat'=>'yy-mm-dd',
							),
							'htmlOptions'=>array(
									'class'=>'form-control input-sm',
							),
					),
							true),
			),
			array(
					'header'=>'Responsable',
					'type'=>'raw',
					'value'=>'$data->responsable',
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("ver",array("caja/envio","id"=>$data->idEnvioMaterial))',
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("imprimir","#")',
			),
		)
	));
	
}
?>

<?php
if(isset($nuevo))
{
	$this->renderPartial('envio',array('productos'=>$productos,'model'=>$envio,'detalle'=>$detalle));	
}

?>
</div>