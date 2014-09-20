<div class="col-sm-2 hidden-print">
<?php $this->renderPartial('menus/principal'); ?>
</div>

<div class="col-sm-10 ">

<div class="panel panel-default">
	<div class="panel-heading">
		<strong><?php echo $titulo;?></strong>
	</div>
	<div class="panel-body">
	<?php
		if($estado==0) 
		$this->widget('zii.widgets.CMenu',array(
						'htmlOptions' => array('class' => 'nav nav-tabs'),
						'activeCssClass'	=> 'active',
						'encodeLabel' => false,
						'items'=>array(
									array('label'=>'Todos','url'=>array('distribuidora/ventas','t'=>'all')),
									array('label'=>'Mes', 'url'=>array('distribuidora/ventas','m'=>date('m'))),
									array('label'=>'Dia', 'url'=>array('distribuidora/ventas','d'=>date('d'))),
								),
						)); 
	?>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$ventas,
		//'ajaxUpdate'=>true,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
			
			array(
				'header'=>'#',
				'value'=>'$row+1',       //  row is zero based
			),
			'codigo',
			array(
				'name'=>'formaPago',
				'value'=>'($data->formaPago==0)?CHtml::encode("Contado"):CHtml::encode("Credito")',
			),
			array(
				'name'=>'tipoPago',
				'value'=>'($data->tipoPago==0)?CHtml::encode("Con Factura"):CHtml::encode("Sin Factura")',
			),
			array(
				'header'=>'Cliente',
				'value'=>'$data->Cliente->nitCi." - ".$data->Cliente->apellido',
			),
			'fechaVenta',
			'montoTotal',
			array(
				'header'=>'',
				'type'=>'raw',
				'value'=>'CHtml::link("Ver", array("preview","id"=>$data->id))',
			),
			
		)
	)); 
	?>
	</div>
</div>
</div>