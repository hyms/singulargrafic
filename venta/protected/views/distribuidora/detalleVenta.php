

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
			<td>'.CHtml::activeLabelEx($detalle,'adicional').'</td>
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
		'removeTemplate'=>'<td class="col-sm-1">{link}</td>',
		'removeLabel'=>Yii::t('ui','Quitar'),
		'removeHtmlOptions'=>array('class'=>'btn btn-danger'),
)); 
?>
	<div class="form-group col-sm-6">
	    <?php echo CHtml::label("Observaciones","obs",array('class'=>'control-label col-sm-4'))?>
	    <div class="col-sm-8">
		<?php echo CHtml::textArea("Observaciones","",array('class'=>'form-control'))?>
	   	</div>
	</div>
	<div class="form-horizontal col-sm-offset-2 col-sm-4" >
		
		<div class="form-group ">
	    	<?php echo CHtml::label("Total","total",array('class'=>'control-label col-sm-4'))?>
	    	<div class="col-sm-8">
	      	<?php echo CHtml::textField('total',"00",array('class'=>'form-control input-sm','disabled'=>true,"id"=>"total")); ?>
	    	</div>
	  	</div>
	  	<div class="form-group ">
	    	<?php echo CHtml::label("Pagado","pagado",array('class'=>'control-label col-sm-4'))?>
	    	<div class="col-sm-8">
	      	<?php echo CHtml::textField('pagado',"",array('class'=>'form-control input-sm',"id"=>"pagado")); ?>
	    	</div>
	  	</div>
	  	<div class="form-group ">
	    	<?php echo CHtml::label("Cambio","cambio",array('class'=>'control-label col-sm-4'))?>
	    	<div class="col-sm-8">
	      	<?php echo CHtml::textField('cambio',"00",array('class'=>'form-control input-sm','disabled'=>true,"id"=>"cambio")); ?>
	    	</div>
	  	</div>
	  	
	</div>
	
	
	
</div>
	
<?php Yii::app()->getClientScript()->registerScript("ajax_total",
"
   	function calcular_total() {
		importe_total = 0
		$('.costo*').each(
			function(index, value) {
				importe_total = importe_total + parseFloat($(this).val()*1);
			}
		);
		$('#total').val(parseFloat(importe_total).toFixed(2));
		$('#cambio').val(resta($('#pagado').val(),$('#total').val()).toFixed(2));
	}
		
	function suma(a,b)
	{
		return ((a*1) + (b*1));
	}
	
	function resta(a,b)
	{
		
		return ((a*1) - (b*1));
	}
		 
	
    
",CClientScript::POS_HEAD); ?>
