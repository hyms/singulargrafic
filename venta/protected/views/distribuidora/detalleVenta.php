<?php
/* @var $this DetalleVentaController */
/* @var $model DetalleVenta */
/* @var $form CActiveForm */
?>

<div class="form">
<?php
$detalles=array();
if(count($detalle)==1)
	array_push($detalles,$detalle);
$this->widget('ext.widgets.tabularinput.XTabularInput',array(
		'models'=>$detalles,
		'containerTagName'=>'table',
		'headerTagName'=>'thead',
		'header'=>'
        <tr>
            <td>'.CHtml::activeLabelEx($detalle,'idProducto').'</td>
            <td></td>
        </tr>
    ',
		'inputContainerTagName'=>'tbody',
		'inputTagName'=>'tr',
		'inputView'=>'_tabularInputAsTable',
		'inputUrl'=>$this->createUrl('request/addTabularInputsAsTable'),
		'addTemplate'=>'<tbody><tr><td colspan="3">{link}</td></tr></tbody>',
		'addLabel'=>Yii::t('ui','Añadir Producto'),
		'addHtmlOptions'=>array('class'=>'blue pill full-width'),
		'removeTemplate'=>'<td>{link}</td>',
		'removeLabel'=>Yii::t('ui','Quitar'),
		'removeHtmlOptions'=>array('class'=>'red pill'),
)); 
?>
<?php /*$form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalle-venta-detalleVenta-form',
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
		<?php echo $form->labelEx($model,'id',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'id',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idVenta',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'idVenta',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'idVenta'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idProducto',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'idProducto',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'idProducto'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'cantUnidad',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'cantUnidad',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'cantUnidad'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'cantPaquete',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'cantPaquete',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'cantPaquete'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'costoTotal',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->textField($model,'costoTotal',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'costoTotal'); ?>
	</div>


	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default col-sm-offset-2')); ?>
	</div>

<?php $this->endWidget(); */?>

</div><!-- form -->
