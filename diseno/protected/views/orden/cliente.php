<div class="panel panel-default">
    <div class="panel-body" style="overflow: auto;">
        <?php $this->renderPartial('tables/producto',array('productos'=>$productos,'index'=>'cliente','clientes'=>$clientes));?>
    </div>
</div>

<div class = "row">
    <h3 class="col-xs-4">Orden de Trabajo</h3>
    <h3 class="col-xs-4 text-center"><?php echo $ctp->codigo;?></h3>
    <h3 class="col-xs-4 text-right"><?php echo date("d/m/Y",strtotime($ctp->fechaOrden));?></h3>

</div>

<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'form',
    //'action'=>CHtml::normalizeUrl(array((empty($ctp->idCtp))?'/orden/cliente':"/ctp/modificar")),
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
        'role'=>'form'
    ),
));

echo ((!empty($ctp->idCtp))?CHtml::activeHiddenField($ctp,'idCtp'):'');
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Datos de Cliente</strong>
    </div>
    <div class="panel-body" style="overflow: auto;">
        <?php $this->renderPartial('forms/orden/cliente',array('cliente'=>$cliente,'ctp'=>$ctp));?>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Datos de Orden</strong>
    </div>
    <div class="panel-body" style="overflow: auto;">
        <?php $this->renderPartial('forms/orden/detalleOrden',array('detalle'=>$detalle,'ctp'=>$ctp));?>
    </div>
</div>

<div class="form-group">
    <div class="text-center">
        <?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
        <?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-default hidden-print','id'=>'save')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>