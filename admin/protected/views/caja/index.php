<div class="col-xs-2">
<?php $this->renderPartial('menu');?>
</div>
<div class="col-xs-10">
<h2>Cajas</h2>
<?php echo CHtml::link('Añadir',array('caja/caja'), array('class' => 'btn btn-default') ); ?>
<table class="table table-hover table-condensed">
<thead>
	<tr>
		<th>Nro</th>
		<th>Nombre</th>
		<th>Saldo</th>
		<th></th>
		
	</tr>
</thead>
<tbody>
<?php	
$index=0;
	foreach($cajas as $item)
	{
		?>
		<tr>
		<td><?php $index++; echo $index;?></td>
		<td><?php echo $item->nombre;?></td>
		<td><?php echo $item->saldo;?></td>
		<td><?php echo CHtml::link("Editar",array("caja/caja","id"=>$item->idCaja));?></td>
		</tr>
		<?php 
	} 
?>
</tbody>
</table>
</div>
