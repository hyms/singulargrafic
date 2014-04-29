<?php
$this->breadcrumbs=array(
	'Distribuidora',
);
?>
<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">

<div class="panel panel-default">
	<div class="panel-heading">
		<strong class="panel-title">Productos</strong>
	</div>
  	<div class="panel-body" style="overflow: auto;">
		<?php $this->renderPartial('producto',array('productos'=>$productos)); ?>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<span class="panel-title"><strong>Nueva Venta</strong> <?php echo ((!empty($venta->serie))?(chr($venta->serie)."-"):"").$venta->codigo;?></span>
		<span style="float:right;"><strong>Fecha:</strong> <?php echo date("d-m-Y", strtotime($venta->fechaVenta));?></span>
	</div>
	
	<div class="panel-body">
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
	
	<?php $this->renderPartial('detalleVenta',array('venta'=>$venta,'detalle'=>$detalle,'almacen'=>$almacen))?>
	<div class="form-group">
	<?php $this->renderPartial('datosVenta',array('venta'=>$venta,'cliente'=>$cliente,'empleado'=>$empleado,'form'=>$form)); ?>
	</div>
	<div class="form-group">
		<?php echo CHtml::submitButton('Continuar',array('class'=>'btn btn-default col-sm-offset-5')); ?>
	</div>
	<?php $this->endWidget(); ?>	
	</div>
</div>

</div>

<?php Yii::app()->getClientScript()->registerScript("ajax_cliente",
"
   
	function cliente (nitCi)
	{
		nitCi = jQuery.trim(nitCi);
		if(nitCi.length>0){
	        $.ajax({
	            url: '".CHtml::normalizeUrl(array('/distribuidora/ajaxCliente'))."', 
	            type: 'GET', 
	            data: { nitCi: nitCi},
	            success: function (data){ 
				 			data = JSON.parse(data);
	            			$('#apellido').val(data[\"apellido\"]); 
	            			$('#clienteNit').val(data[\"nitCi\"]);
						 },
				error:	$('#clienteNit').val(nitCi),
	        });
		}
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