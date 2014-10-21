<div class="table-responsive">
    <table id="yw3" class="table table-condensed">
        <thead class="tabular-header"><tr>
            <td><?php echo CHtml::label('Nº','number')?></td>
            <td><?php echo CHtml::label('Formato','formato')?></td>
            <td><?php echo CHtml::label('Nº de placas','nro placas')?></td>
            <td><?php echo CHtml::label('C','c')?></td>
            <td><?php echo CHtml::label('M','m')?></td>
            <td><?php echo CHtml::label('Y','y')?></td>
            <td><?php echo CHtml::label('B','k')?></td>
            <td><?php echo CHtml::label('Trabajo','trabajo')?></td>
            <td><?php echo CHtml::label('Pinza','pinza')?></td>
            <td><?php echo CHtml::label('Resolucion','resolucion')?></td>
            <td><?php echo CHtml::label('Costo','costo')?></td>
            <td><?php echo CHtml::label('Adicional','adicional')?></td>
            <td><?php echo CHtml::label('Total','total')?></td>
        </tr></thead>
        <tbody class="tabular-input-container">
        <?php

        if(count($detalle)>=1)
        {
            if(!isset($detalle->isNewRecord))
            {
                foreach ($detalle as $key => $item)
                {
                    if($item->idAlmacenProducto!=null)
                    {
                        $this->renderPartial('forms/orden/_newRowDetalleVenta', array(
                            'model'=>$item,
                            'index'=>$key,
                            'costo'=>0,
                            'almacen'=>AlmacenProducto::model()
                                    ->with("idProducto0")
                                    ->findByPk($item->idAlmacenProducto),
                        ));
                    }
                }
            }
        }
        ?>
        </tbody></table>
</div>
<div class="form-group">
    <div class="col-xs-7">
        <div class="form-group">
            <?php echo CHtml::activeLabelEx($ctp,"obs",array('class'=>'control-label col-xs-4'))?>
            <div class="col-xs-8">
                <?php echo CHtml::activeTextArea($ctp,"obs",array('class'=>'form-control','readonly'=>true))?>
            </div>
            <?php echo CHtml::error($ctp,"obs",array('class'=>'label label-danger')); ?>
        </div>

        <div class="form-group">
            <?php echo CHtml::activeLabelEx($ctp,"obsCaja",array('class'=>'control-label col-xs-4'))?>
            <div class="col-xs-8">
                <?php echo CHtml::activeTextArea($ctp,"obsCaja",array('class'=>'form-control'))?>
            </div>
            <?php echo CHtml::error($ctp,"obsCaja",array('class'=>'label label-danger')); ?>
        </div>
    </div>

    <div class="col-xs-5">
        <?php if($ctp->tipoCTP ==1){?>
            <div class="form-group">
                <?php echo CHtml::activeLabelEx($ctp,"montoVenta",array('class'=>'control-label col-xs-4'))?>
                <div class="col-xs-8">
                    <?php echo CHtml::activeTextField($ctp,"montoVenta",array('class'=>'form-control input-sm','readonly'=>true,"id"=>"total")); ?>
                </div>
                <?php echo CHtml::error($ctp,"montoVenta",array('class'=>'label label-danger')); ?>
            </div>

            <div class="form-group">
                <?php echo CHtml::activeLabelEx($ctp,"montoPagado",array('class'=>'control-label col-xs-4'))?>
                <div class="col-xs-8">
                    <?php echo CHtml::activeTextField($ctp,"montoPagado",array('class'=>'form-control input-sm',"id"=>"pagado")); ?>
                </div>
                <?php echo CHtml::error($ctp,"montoPagado",array('class'=>'label label-danger')); ?>
            </div>

            <div class="form-group">
                <?php echo CHtml::activeLabelEx($ctp,"montoCambio",array('class'=>'control-label col-xs-4'))?>
                <div class="col-xs-8">
                    <?php echo CHtml::activeTextField($ctp,"montoCambio",array('class'=>'form-control input-sm','readonly'=>true,"id"=>"cambio")); ?>
                </div>
                <?php echo CHtml::error($ctp,"montoCambio",array('class'=>'label label-danger')); ?>
            </div>
        <?php }?>
    </div>

</div>

<?php
$this->renderPartial('scripts/operaciones');
$this->renderpartial('scripts/totalVenta');
$this->renderPartial('scripts/detalleVenta');
$this->renderPartial('scripts/removeList');
?>