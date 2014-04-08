<?php
/* @var $this DistribuidoraController */

$this->breadcrumbs=array(
	'Distribuidora',
);
?>
<div class="col-md-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-md-10">
	<h2>Nueva Venta</h2>
	<div class="row">
	<?php $this->renderPartial('producto',array('productos'=>$productos)); ?>
	</div>
<div >
	<?php
	/* @var $this DetalleVentaController */
	/* @var $model DetalleVenta */
	/* @var $form CActiveForm */
	$form=$this->beginWidget('CActiveForm', array(
			'id'=>'detalle-venta-detalleVenta-form',
			'action'=>CHtml::normalizeUrl(array('/distribuidora/index')),
			'htmlOptions'=>array(
					'class'=>'form-horizontal',
					'role'=>'form'
			),
	));
	?>
	<h2 >Detalle de Venta</h2>
	<?php $this->renderPartial('detalleVenta',array('venta'=>$venta,'detalle'=>$detalle,'almacen'=>$almacen,'factura'=>$factura))?>
	
	<?php $this->renderPartial('ventaProducto',array('venta'=>$venta,'cliente'=>$cliente,'empleado'=>$empleado,'form'=>$form)); ?>
	<div class="form-group">
		<?php echo CHtml::submitButton('Finalizar',array('class'=>'btn btn-default')); ?>
	</div>
	<?php $this->endWidget(); ?>	
</div>
</div>


<?php Yii::app()->getClientScript()->registerScript("ajax_cliente",
"
   
	function cliente (nitCi)
	{
		nitCi = jQuery.trim(nitCi);
        $.ajax({
            url: '".CHtml::normalizeUrl(array('/distribuidora/ajaxCliente'))."', 
            type: 'GET', 
            data: { nitCi: nitCi},
            success: function (data){ 
            			$('#apellido').val(data['apellido']); 
            			$('#clienteNit').val(data['nitCi']);
					 },
			error:	$('#clienteNit').val(nitCi),
        });
	}
		
    $('#NitCi').keydown(function(e){ 
        if(e.keyCode==13 || e.keyCode==9) 
	    { 
	    	if($('#NitCi').val()!=\"\")
	     		cliente($('#NitCi').val())
	      	return true; 
	    } 
           
    });
    
    $('#NitCi').blur(function(e){ 
        if($('#NitCi').val()!=\"\")
	     	cliente($('#NitCi').val())
    });
    
    $('#apellido').keydown(function(e){ 
        if(e.keyCode==13 || e.keyCode==9) 
	    { 
	    	$('#clienteApellido').val($('#apellido').val());
	      	return true; 
	    } 
           
    });
    
    $('#apellido').blur(function(e){ 
        $('#clienteApellido').val($('#apellido').val());
	      	return true;
    });
    
	$('#pagado').blur(function(e){
		$('#cambio').val(resta($('#pagado').val(),$('#total').val()).toFixed(2));
		return true;
	});
	$('#pagado').keydown(function(e){
		if(e.keyCode==13 || e.keyCode==9) 
	    { 
			$('#cambio').val(resta($('#pagado').val(),$('#total').val()).toFixed(2));
			return true;
		}
	});
	
	$(\"#yw3 .tabular-input-remove\").live(\"click\", function(event) {
		event.preventDefault();
		$(this).parents(\".tabular-input:first\").remove();
		$('.tabular-input-container').filter(function(){return $.trim($(this).text())==='' && $(this).children().length == 0}).siblings('.tabular-header').hide();
	});
",CClientScript::POS_READY); ?>