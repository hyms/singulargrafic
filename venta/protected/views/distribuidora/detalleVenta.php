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
</div>
<div>
	<?php echo CHtml::hiddenField('clienteId','',array("id"=>"clienteId")); ?>
</div>
	<div class="form-group">
		<?php echo CHtml::submitButton('Finalizar',array('class'=>'btn btn-default')); ?>
	</div>
<?php $this->endWidget(); ?>

