

<div class="table-responsive form-group">
<?php

echo '<table id="yw3" class="table"><thead class="tabular-header"><tr>
			<td>'.CHtml::label('Nº','number').'</td>
			<td>'.CHtml::activeLabelEx($almacen,'Producto.codigo').'</td>
			<td>'.CHtml::label('Detalle de producto','detalle').'</td>
			<td>'.CHtml::activeLabelEx(new DetalleVenta,'cantUnidad').'</td>
			<td>'.CHtml::activeLabelEx(new DetalleVenta,'cantPaquete').'</td>
			<td>'.CHtml::activeLabelEx(new DetalleVenta,'adicional').'</td>
			<td>'.CHtml::label('Total','total').'</td>
            <td></td>
        </tr>';

echo '</thead><tbody class="tabular-input-container">';
if(count($detalle)>=1)
{
	$i=0;
	foreach ($detalle as $item)
	{
		if($item->idAlmacen!=null)
		{
			$this->renderPartial('_newRowDetalleVenta', array(
					'model'=>$item,
					'index'=>$i,
					'almacen'=>$almacen = Almacen::model()	->with("Producto")
															->with("Producto.Color")
															->with("Producto.Material")
															//->with("Producto.Industria")
															->findByPk($item->idAlmacen),
					'costos'=>array(),
			));
			$i++;
		}
	}
}

//print_r($detalle);
echo '</tbody></table>';

?>
	<div class="form-group col-sm-6">
	    <?php echo CHtml::activeLabelEx($venta,"obs",array('class'=>'control-label col-sm-4'))?>
	    <div class="col-sm-8">
		<?php echo CHtml::activeTextArea($venta,"obs",array('class'=>'form-control'))?>
	   	</div>
	</div>
	<div class=" col-sm-offset-2 col-sm-4" >
		
		<div class="form-group ">
	    	<?php echo CHtml::activeLabelEx($venta,"montoTotal",array('class'=>'control-label col-sm-4'))?>
	    	<div class="col-sm-8">
	      	<?php echo CHtml::activeTextField($venta,"montoTotal",array('class'=>'form-control input-sm','readonly'=>true,"id"=>"total")); ?>
	    	</div>
	  	</div>
	  	<div class="form-group ">
	    	<?php echo CHtml::activeLabelEx($venta,"montoPagado",array('class'=>'control-label col-sm-4'))?>
	    	<div class="col-sm-8">
	      	<?php echo CHtml::activeTextField($venta,"montoPagado",array('class'=>'form-control input-sm',"id"=>"pagado")); ?>
	    	</div>
	  	</div>
	  	<div class="form-group ">
	    	<?php echo CHtml::activeLabelEx($venta,"montoCambio",array('class'=>'control-label col-sm-4'))?>
	    	<div class="col-sm-8">
	      	<?php echo CHtml::activeTextField($venta,"montoCambio",array('class'=>'form-control input-sm','readonly'=>true,"id"=>"cambio")); ?>
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

