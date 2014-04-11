<div class="col-md-2">
<?php $this->renderPartial('menu'); ?>
</div>
<div class="col-md-10">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$ventas,
	//'ajaxUpdate'=>true,
	'itemsCssClass' => 'table table-hover table-condensed',
	'htmlOptions' => array('class' => 'table-responsive'),
	'columns'=>array(
		
		array(
			'header'=>'#',
			'value'=>'$row+1',       //  row is zero based
		),
		'codigo',
		array(
			'header'=>'Tipo Pago',
			'value'=>'($data->idTipoPago==0)?CHtml::encode("Contado"):CHtml::encode("Credito")',
		),
		array(
			'header'=>'Cliente',
			'value'=>'$data->Cliente->nitCi." - ".$data->Cliente->apellido',
		),
		'fechaVenta',
		'montoTotal',
		array(
			'header'=>'',
			'type'=>'raw',
			'value'=>'CHtml::link("Ver", "#", array("id"=>$data->id, "class"=>"getid", "onclick"=>"$(\"#preview\").dialog(\"open\");"))',
		),
		
	)
)); 
?>
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'preview',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Vista Previa',
        'autoOpen'=>false,
        'modal'=>false,
		'height'=>529,
		'width'=>793,
		'resizable'=>false
    ),

));
$this->widget('ext.mPrint.mPrint', array(
		'title' => '  ',          //the title of the document. Defaults to the HTML title
		'tooltip' => 'Imprimir',        //tooltip message of the print icon. Defaults to 'print'
		'text' => 'Imprimir',   //text which will appear beside the print icon. Defaults to NULL
		'element' => '#print',        //the element to be printed.
		/*'exceptions' => array(       //the element/s which will be ignored
				'.summary',
				'.search-form'
		),*/
		'publishCss' => true,       //publish the CSS for the whole page?
		'visible' => true,  //should this be visible to the current user?
		'alt' => 'Imprimir',       //text which will appear if image can't be loaded
		//'debug' => true,            //enable the debugger to see what you will get
		'id' => 'print-div'         //id of the print link
));
echo '<div id="print"></div>';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php 
$url = $this->createAbsoluteUrl('distribuidora/preview');
$script = "jQuery(function($) {
jQuery('body').delegate('.getid', 'click', function(){

var ids = jQuery(this).attr('id');
jQuery.ajax({
type: 'GET',
url: '".$url."',
data: 'id='+ids,
success: function(data, textStatus, XMLHttpRequest){jQuery('#print').html(data);}
});

});
});";
Yii::app()->clientScript->registerScript(1,$script,CClientScript::POS_END); 
?>
</div>