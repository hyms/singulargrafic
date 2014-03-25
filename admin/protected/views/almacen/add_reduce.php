<?php
/* @var $this AlmacenController */
/* @var $model Almacen */
/* @var $form CActiveForm */
?>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'itemsCssClass' => 'table table-hover table-condensed',
	'htmlOptions' => array('class' => 'table-responsive'),
	'columns'=>array(
		
		array(
			'header'=>'#',
			'value'=>'$row+1',       //  row is zero based
		),
		array(
			'name'=>'Tipo Almacen',
			'type'=>'raw',
			'value'=>'$data->TipoAlmacen->nombre'
		),
		array(
			'name'=>'Detalle del Producto',
			'type'=>'raw',
			'value'=>'$data->Producto->Material->nombre." ".$data->Producto->Color->nombre." ".$data->Producto->peso." ".$data->Producto->dimension.", ".$data->Producto->procedencia'
		),
		'stockUnidad',
		'stockPaquete',
		/*array(
			'name'=>'',
			'type'=>'raw',
			'value'=>'CHtml::link("Editar",array("producto/update","id"=>$data->id))'
		),*/
		array(
			'name'=>'',
			'type'=>'raw',
			'value'=>'CHtml::link("Eliminar",array("almacen/delete","id"=>$data->id),array("confirm" => "Esta seguro de Eliminarlo?"))'
		),
		
	)
));
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'almacen-add_reduce-form',
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form'
	),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idProducto',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'idProducto',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'idProducto'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idTipoAlmacen',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'idTipoAlmacen',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'idTipoAlmacen'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'stockUnidad',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'stockUnidad',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'stockUnidad'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'stockPaquete',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'stockPaquete',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'stockPaquete'); ?>
	</div>


	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-2')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
