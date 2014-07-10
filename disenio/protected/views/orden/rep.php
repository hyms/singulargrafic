<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">

<h3><?php echo "Ordenes de trabajo";?></h3>
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
					'header'=>'',
					'type'=>'raw',
					'value'=>'CHtml::link("Ver","#",array("class"=>"btn btn-success btn-sm"))',
			),
		)
	));
?>

</div>