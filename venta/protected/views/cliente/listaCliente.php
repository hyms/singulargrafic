<?php $i=0; ?>
<table class="table table-hover table-condensed">
	<thead>
	<tr>
		<th>Nº</th>
		<th>NitCi</th>
		<th>Apellido - Nombre</th>
		<th>Cant. Compras</th>
		<th>Cant. Creditos</th>
		<th>Monto Deuda</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($cliente as $item){?>
	<tr>
	<td><?php echo (($i=$i+1) + ($pages->currentPage*$pages->pageCount));?></td>
	<td><?php echo $item->nitCi;?></td>
	<td><?php echo $item->apellido." - ".$item->nombre;?></td>
	<td><?php echo $datos['compra'][$item->id]?></td>
	<td><?php echo $datos['credito'][$item->id]?></td>
	<td><?php echo $datos['deuda'][$item->id]?></td>
	<td><?php echo CHtml::link('ver',array('cliente/detail','id'=>$item->id));?></td>
	</tr>
	<?php }?>
	</tbody>
</table>
<?php $this->widget('CLinkPager', array(
		'pages' => $pages,
)) 
/*$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$cliente,
	//'ajaxUpdate'=>true,
	'itemsCssClass' => 'table table-hover table-condensed',
	'htmlOptions' => array('class' => 'table-responsive'),
	'columns'=>array(
		
		array(
			'header'=>'#',
			'value'=>'$row+1',       //  row is zero based
		),
			
			
			array(
			'header'=>'',
			'type'=>'raw',
			'value'=>'',
			
		),
		
	)
));*/ ?>