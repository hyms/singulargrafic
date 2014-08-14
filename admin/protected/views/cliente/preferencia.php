<h2>Clientes CTP</h2>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cliente-form',
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div style="height: 600px; overflow=auto;">
<table class="table table-hover table-condensed">
<thead>
<tr>
	<th><?php echo "Nro";?></th>
	<th><?php echo "Nit/Ci";?></th>
	<th><?php echo "Apellido";?></th>
	<th class="text-center" colspan=3><?php echo "Preferencia Cliente";?></th>
</tr>
</thead>
<tbody>
<?php
$i=0; 
foreach ($clientes as $cliente){
$i++;
?>
<tr>
	<td><?php echo $i;?></td>
	<td><?php echo $cliente->nitCi;?></td>
	<td><?php echo $cliente->apellido;?></td>
	<td><?php echo CHtml::activeRadioButtonList($cliente,"[$i]idTiposClientes",CHtml::listData(TiposClientes::model()->findAll("servicio=1"),"idTiposClientes","nombre"),array("separator"=>"</td><td>","labelOptions"=>array("display"=>"inline"),'id'=>'Cliente_idTiposClientes_'.$i));?></td>
</tr>
<?php }?>
</tbody>
</table>
<?php /* $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$clientes,
	'itemsCssClass' => 'table table-hover table-condensed',
	'htmlOptions' => array('class' => 'table-responsive'),
	'columns'=>array(
		array(
				'header'=>'Nro',
				'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
		),
		array(
				'header'=>'Nit/Ci',
				'value'=>'$data->nitCi',
		),
		array(
				'header'=>'Apellido',
				'value'=>'$data->apellido',
		),
		array(
				'header'=>'Preferencia Cliente',
				'type'=>'raw',
				'value'=>'CHtml::activeCheckBoxList($data,"idTiposClientes",CHtml::listData(TiposClientes::model()->findAll("servicio=1"),"idTiposClientes","nombre"),array("separator"=>"	","labelOptions"=>array("display"=>"inline")))'
		),
	)
	));*/
?>
</div>
<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default')); ?>

<?php $this->endWidget(); ?>