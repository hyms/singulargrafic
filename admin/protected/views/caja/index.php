<div class="col-sm-2">
<?php $this->renderPartial('menu');?>
</div>
<div class="col-sm-10">
<h2>Cajas</h2>
<?php echo CHtml::link('Añadir',array('caja/caja'), array('class' => 'btn btn-default') ); ?>
<table class="table table-hover table-condensed">
<thead>
	<tr>
		<th>Nro</th>
		<th>Nombre</th>
		<th>Asignado a</th>
		<th></th>
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
		<td><?php
			$us="";
			foreach($item->cajaVentas as $user)
			{
				$us=$us.$user->idUser0->username.", ";
			} 
			echo $us;
		?></td>
		<td><?php echo CHtml::link("Editar",array("caja/caja","id"=>$item->idCaja));?></td>
		<td><?php echo CHtml::link("Asignar a",array("#","id"=>$item->idCaja));?></td>
		</tr>
		<?php 
	} 
?>
</tbody>
</table>
</div>
