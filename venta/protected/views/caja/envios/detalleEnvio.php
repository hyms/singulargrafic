<div >
<table id="yw3" class="table table-condensed">
	<thead class="tabular-header"><tr>
		<td><?php echo CHtml::label('Nº','number')?></td>
		<td><?php echo CHtml::label('Codigo','codigo')?></td>
		<td><?php echo CHtml::label('Detalle de producto','detalle')?></td>
		<td><?php echo CHtml::label('Cant. Unidad','cantUnidad')?></td>
		<td><?php echo CHtml::label('Cant. Paquete','cantPaquete')?></td>
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
				$this->renderPartial('envios/_newRowDetalleEnvio', array(
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



<?php Yii::app()->getClientScript()->registerScript("ajax_detalleventa","
	$(\"#yw3 .tabular-input-remove\").live(\"click\", function(event) {
		event.preventDefault();
		$(this).parents(\".tabular-input:first\").remove();
		$('.tabular-input-container').filter(function(){return $.trim($(this).text())==='' && $(this).children().length == 0}).siblings('.tabular-header').hide();
	});
			
			
",CClientScript::POS_READY); ?>