<div class="table-responsive">
<table  class="table table-condensed">
	<thead class="tabular-header"><tr>
		<td><?php echo CHtml::label('Nº','number')?></td>
		<td><?php echo CHtml::label('Formato','formato')?></td>
		<td><?php echo CHtml::label('Nº de placas','nro placas')?></td>
		<td><?php echo CHtml::label('Full','f')?></td>
		<td><?php echo CHtml::label('C','c')?></td>
		<td><?php echo CHtml::label('M','m')?></td>
		<td><?php echo CHtml::label('Y','y')?></td>
		<td><?php echo CHtml::label('B','k')?></td>
		<td><?php echo CHtml::label('Trabajo','trabajo')?></td>
		<td><?php echo CHtml::label('Pinza','pinza')?></td>
		<td><?php echo CHtml::label('Resolucion','resolucion')?></td>
       	<td></td>
 	</tr></thead>
<tbody class="tabular-input-container">
<?php

if(count($detalle)>=1)
{
	if(!isset($detalle->isNewRecord))
	{
		$i=0;
		
		foreach ($detalle as $item)
		{
			if($item->idAlmacenProducto!=null)
			{
				$this->renderPartial('./repo/_newRowDetalleVenta', array(
						'model'=>$item,
						'index'=>$i,
						'almacen'=>AlmacenProducto::model()
									->with("idProducto0")
									->findByPk($item->idAlmacenProducto),
				));
				$i++;
			}
		}
	}
}
?>
</tbody></table>
</div>


<?php Yii::app()->clientScript->registerScript('row',"

function newRow(detalle)
{
	
	var input = $(\"#yw3 tbody\");
	var index = 0;
	if(input.find(\".tabular-input-index\").length>0)
	{
		$(\".tabular-input-index\").each(function() {
		    index = Math.max(index, parseInt(this.value)) + 1;
		});
	}		
	$.ajax({
		type: 'GET',
		url: '".CHtml::normalizeUrl(array('/orden/addDetalleR'))."',
		data: 'index='+index+'&id='+detalle,
		dataType: 'html',
		success: function(html){
			input.append(html);
			input.siblings('.tabular-header').show();
		},
		
	});
	event.preventDefault();
}

",CClientScript::POS_HEAD); ?>