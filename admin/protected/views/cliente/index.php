<?php
/* @var $this EmpleadoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Clientes',
);

?>
 
<h1>Clientes</h1>

<?php echo CHtml::link('Añadir',array('cliente/Create'), array('class' => 'btn btn-default') ); ?>
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
				'value'=>'CHtml::link("Editar",array("cliente/update","id"=>$data->idCliente))'
		),
	)
	));
?>

<?php
Yii::app()->clientScript->registerScript('row',"
$('#document').ready(function(){
	$('.openDlg').click(function(){
		var dialogId = $(this).attr('class').replace('openDlg ', '');
		$.ajax({
			'type': 'GET',
			'url' : $(this).attr('href'),
			success: function (data) {
				 
				$('#'+dialogId+' div.divForForm').html(data);
				$( '#'+dialogId ).dialog( 'open' );
			},
			dataType: 'html',
		});
		return false; // prevent normal submit
	})
}); 
",CClientScript::POS_READY);?>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array('id'=>'divDialog',
    'options'=>array( 'title'=>'Detalle de Venta', 'autoOpen'=>false, 'modal'=>true, 'width'=>800)));
?>
    <div class="divForForm"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
