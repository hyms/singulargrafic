<?php
/* @var $this DetalleVentaController */
/* @var $model DetalleVenta */
/* @var $form CActiveForm */
$form=$this->beginWidget('CActiveForm', array(
		'id'=>'detalle-venta-detalleVenta-form',
		'htmlOptions'=>array(
				'class'=>'form-horizontal',
				'role'=>'form'
		),
));
?>

<div class="table-responsive form-group">
<?php
$detalles=array();
if(count($detalle)==1)
	array_push($detalles,$detalle);
//print_r($detalle);
$this->widget('ext.widgets.tabularinput.XTabularInput',array(
		'models'=>$detalles,
		'containerTagName'=>'table',
		'headerTagName'=>'thead',
		'header'=>'
        <tr>
			<td>'.CHtml::label('Nº','number').'</td>
			<td>'.CHtml::activeLabelEx($detalle,'Producto.codigo').'</td>
			<td>'.CHtml::label('Detalle de producto','detalle').'</td>
			<td>'.CHtml::activeLabelEx($detalle,'Almacen.stockUnidad').'</td>
			<td>'.CHtml::activeLabelEx($detalle,'Almacen.stockPaquete').'</td>
			<td>'.CHtml::label('Total','total').'</td>
            <td></td>
        </tr>
    ',
		'inputContainerTagName'=>'tbody',
		'inputTagName'=>'tr',
		'inputView'=>'_newRowDetalleVenta',
		'inputUrl'=>$this->createUrl('distribuidora/newRow'),
		'addTemplate'=>'<tbody><tr><td colspan="3">{link}</td></tr></tbody>',
		'addLabel'=>Yii::t('ui',''),
		//'addHtmlOptions'=>array('class'=>'btn btn-default'),
		'removeTemplate'=>'<td>{link}</td>',
		'removeLabel'=>Yii::t('ui','Quitar'),
		'removeHtmlOptions'=>array('class'=>'btn btn-danger'),
)); 
?>
	<p class="col-md-offset-9 col-sm-2"><?php echo CHtml::textField('total',"00",array('class'=>'form-control input-sm','disabled'=>true)); ?></p>
</div>
<div>
	<?php echo CHtml::hiddenField('clienteNit','',array("id"=>"clienteNit")); ?>
	<?php echo CHtml::hiddenField('clienteApellido','',array("id"=>"clienteApellido")); ?>
</div>
	<div class="form-group">
		<?php echo CHtml::submitButton('Finalizar',array('class'=>'btn btn-default')); ?>
	</div>
<?php $this->endWidget(); ?>

