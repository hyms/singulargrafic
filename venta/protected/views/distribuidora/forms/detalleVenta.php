<table id="yw3" class="table table-condensed">
    <thead class="tabular-header"><tr>
        <td><?php echo CHtml::label('Nº','number')?></td>
        <td><?php echo CHtml::label('Codigo','codigo')?></td>
        <td><?php echo CHtml::label('Detalle de producto','detalle')?></td>
        <td><?php echo CHtml::label('Cant. Unidad','cantUnidad')?></td>
        <td><?php echo CHtml::label('Precio Unidad','precioUnidad')?></td>
        <td><?php echo CHtml::label('Cant. Paquete','cantPaquete')?></td>
        <td><?php echo CHtml::label('Precio Paquete','precioPaquete')?></td>
        <td><?php echo CHtml::label('Adicional','adicional')?></td>
        <td><?php echo CHtml::label('Total','total')?></td>
        <td></td>
    </tr></thead>
    <tbody class="tabular-input-container">
    <?php
    if(count($detalle)>=1)
    {
        if(!isset($detalle->isNewRecord))
        {
            $i=0;
            foreach ($detalle as $item)
            {
                if($item->idAlmacenProducto!=null)
                {
                    $this->renderPartial('forms/_newRowDetalleVenta', array(
                        'model'=>$item,
                        'index'=>$i,
                        'almacen'=>AlmacenProducto::model()
                                ->with("idProducto0")
                                ->findByPk($item->idAlmacenProducto),
                    ));
                    $i++;
                }
            }
        }
    }
    ?>
    </tbody>
</table>

<div class="form-group">
    <div class="col-xs-7">
        <?php echo CHtml::activeLabelEx($venta,"obs",array('class'=>'control-label col-xs-4'))?>
        <div class="col-xs-8">
            <?php echo CHtml::activeTextArea($venta,"obs",array('class'=>'form-control'))?>
        </div>
        <?php echo CHtml::error($venta,"obs",array('class'=>'label label-danger')); ?>
    </div>

    <div class="col-xs-5" >
        <div class="form-group">
            <?php echo CHtml::activeLabelEx($venta,"montoVenta",array('class'=>'control-label col-xs-4'))?>
            <div class="col-xs-8">
                <?php echo CHtml::activeTextField($venta,"montoVenta",array('class'=>'form-control input-sm','readonly'=>true,"id"=>"total")); ?>
            </div>
            <?php echo CHtml::error($venta,"montoVenta",array('class'=>'label label-danger')); ?>
        </div>

        <div class="form-group">
            <?php echo CHtml::activeLabelEx($venta,"montoPagado",array('class'=>'control-label col-xs-4'))?>
            <div class="col-xs-8">
                <?php echo CHtml::activeTextField($venta,"montoPagado",array('class'=>'form-control input-sm',"id"=>"pagado")); ?>
            </div>
            <?php echo CHtml::error($venta,"montoPagado",array('class'=>'label label-danger')); ?>
        </div>

        <div class="form-group ">
            <?php echo CHtml::activeLabelEx($venta,"montoCambio",array('class'=>'control-label col-xs-4'))?>
            <div class="col-xs-8">
                <?php echo CHtml::activeTextField($venta,"montoCambio",array('class'=>'form-control input-sm','readonly'=>true,"id"=>"cambio")); ?>
            </div>
            <?php echo CHtml::error($venta,"montoCambio",array('class'=>'label label-danger')); ?>
        </div>
    </div>
</div>

<?php
$this->renderPartial("scripts/totalVenta");
$this->renderPartial("scripts/detalleVenta");
$this->renderPartial("scripts/removeList");
?>