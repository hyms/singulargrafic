<div class="col-sm-2">
<?php $this->renderPartial('menu');?>
</div>
<div class="col-sm-10">

<?php
	if(!empty($material))
	{
		$material =  new CArrayDataProvider($material,
				array(
						'id'=>'idAlmacenProducto',
						'keyField' => 'id',
						'keys'=>array('id'),
						'pagination'=>array('pageSize'=>'20',),
				));//*/
		
		$this->widget('zii.widgets.grid.CGridView', array(
				'dataProvider'=>$material,
				'ajaxUpdate'=>true,
				'itemsCssClass' => 'table table-hover table-condensed',
				'htmlOptions' => array('class' => 'table-responsive'),
				'columns'=>array(
						array(
								'header'=>'Nro',
								'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
						),
						array(
								'header'=>'Codigo',
								'value'=>'$data->idProducto0->codigo',
						),
						array(
								'header'=>'Material',
								'value'=>'$data->idProducto0->material',
						),
						array(
								'header'=>'Color',
								'value'=>'$data->idProducto0->color',
						),
						array(
								'header'=>'Detalle',
								'value'=>'$data->idProducto0->detalle',
						),
						array(
								'header'=>'Stock Unidad',
								'value'=>'$data->stockU',
						),
						array(
								'header'=>'Stock Paquete',
								'value'=>'$data->stockP',
						),
						array(
								'header'=>'',
								'type'=>'raw',
								'value'=>'CHtml::link("Stock",array("ctp/productos","id"=>$data->idAlmacenProducto), array("class" => "openDlg divDialog"))',
						),
				)
		));
	} 
?>

</div>
<?php Yii::app()->clientScript->registerScript('row',"

$('#document').ready(function(){
    $('.openDlg').live('click', function(){
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

",CClientScript::POS_HEAD); ?>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array('id'=>'divDialog',
    'options'=>array( 'title'=>'Añadir a Stock', 'autoOpen'=>false, 'modal'=>true, 'width'=>800)));
?>
    <div class="divForForm"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>