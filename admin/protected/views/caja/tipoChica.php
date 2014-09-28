<div class="col-xs-2">
<?php $this->renderPartial('menu');?>
</div>
<div class="col-xs-10">
	<h2>Asignar Tipos de Movimientos</h2>
	
	<p><strong>Caja Chica de:</strong> <?php echo $caja->idUser0->username;?></p>
	<p><strong>Detalle:</strong> <?php echo $caja->detalle;?></p>
	<div class="panel panel-default" style="width:500px; height:300px; overflow=auto;">
		<div class="panel-heading"><strong>Tipos de Movimientos</strong></div>
		<div class="panel-body">
		<?php if(isset($tipo)){ ?> 
			<table class="table table-hover table-condensed">
			<thead>
			<tr>
				<th>Nro</th>
				<th>Nombre</th>
				<th>&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				$i=1;
				foreach ($tipo as $item)
				{
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $item->nombre;?></td>
				<td><?php echo $this->getLink($caja->idcajaChica,$item->idTipoMovimiento)?></td>
			</tr>
			<?php $i++; }	?>
			</tbody>
		</table>
			<?php }else echo "No existen datos";?>
		  </div>
		</div>
	
</div>