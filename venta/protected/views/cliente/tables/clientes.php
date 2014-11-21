<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Lista de Clientes</strong>
    </div>
    <div class="panel-body" style="overflow: auto;">

<?php // echo CHtml::link('Añadir',array('cliente/Create'), array('class' => 'btn btn-default') ); ?>
<?php echo "  ".CHtml::link('Añadir Tipo Cliente',array('cliente/tipoCliente'), array('class' => 'openDlg divDialog') ); ?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'itemsCssClass' => 'table table-hover table-condensed',
	'htmlOptions' => array('class' => 'table-responsive'),
	'columns'=>array(
		array(
				'header'=>'Nro',
				'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
		),
		array(
				'header'=>'Nombre',
				'value'=>'$data->nombre',
		),
		array(
				'header'=>'Apellido',
				'value'=>'$data->apellido',
		),
		array(
				'header'=>'Nit/Ci',
				'value'=>'$data->nitCi',
		),
		array(
				'header'=>'Telefono',
				'value'=>'$data->telefono',
		),
		array(
				'header'=>'',
				'type'=>'raw',
				'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-edit\"></span> Editar",array("cliente/update","id"=>$data->idCliente))'
		),
	)
	));
?>
    </div>
</div>