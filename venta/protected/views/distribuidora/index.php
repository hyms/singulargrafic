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
			'htmlOptions'=>array(
					'class'=>'form-horizontal',
					'role'=>'form'
			),
	));
	?>
	<h2 >Detalle de Venta</h2>
	<?php $this->renderPartial('detalleVenta',array('detalle'=>$detalle,'almacen'=>$almacen))?>
	
	<?php $this->renderPartial('ventaProducto',array('ventaTmp'=>$ventaTmp,'cliente'=>$cliente,'almacen'=>$almacen,'empleado'=>$empleado,'form'=>$form)); ?>
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
	
",CClientScript::POS_READY); ?>