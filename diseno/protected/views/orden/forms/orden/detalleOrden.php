<div class="table-responsive">
    <table id="yw3" class="table table-condensed">
        <thead class="tabular-header"><tr>
            <td><?php echo CHtml::label('Nº','number')?></td>
            <td><?php echo CHtml::label('Formato','formato')?></td>
            <td><?php echo CHtml::label('Nº de placas','nro placas')?></td>
            <td><?php echo CHtml::label('Full','f')?></td>
            <td><?php echo CHtml::label('C','c')?></td>
            <td><?php echo CHtml::label('M','m')?></td>
            <td><?php echo CHtml::label('Y','y')?></td>
            <td><?php echo CHtml::label('B','k')?></td>
            <td><?php echo CHtml::label('Trabajo','trabajo')?></td>
            <td><?php echo CHtml::label('Pinza','pinza')?></td>
            <td><?php echo CHtml::label('Resolucion','resolucion')?></td>
            <td><?php echo CHtml::label('Adicional','adicional')?></td>
            <td></td>
        </tr></thead>
        <tbody class="tabular-input-container">
        <?php
        if(count($detalle)>=1){
            if(!isset($detalle->isNewRecord)){
                foreach ($detalle as $key=>$item){
                    if($item->idAlmacenProducto!=null){
                        $this->renderPartial('forms/_newRowDetalleVenta', array(
                            'model'=>$item,
                            'index'=>$key,
                            'costo'=>"cliente",
                            'almacen'=>AlmacenProducto::model()
                                    ->with("idProducto0")
                                    ->findByPk($item->idAlmacenProducto),
                        ));
                    }
                }
            }
        }
        ?>
        </tbody>
    </table>
</div>
<div class="form-group">
    <div class="col-xs-7">
        <?php echo CHtml::activeLabelEx($ctp,"obs",array('class'=>'control-label col-xs-4'))?>
        <div class="col-xs-8">
            <?php echo CHtml::activeTextArea($ctp,"obs",array('class'=>'form-control'))?>
        </div>
        <?php echo CHtml::error($ctp,"obs",array('class'=>'label label-danger')); ?>
    </div>
    <div class="col-xs-5" >
        <div class="form-group">
            <?php echo CHtml::activeLabelEx($ctp,"fechaEntega",array('class'=>'control-label col-xs-5'))?>
            <div class="col-xs-7">
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name'=>'fechaEntega',
                    'attribute'=>'fechaEntega',
                    'language'=>'es',
                    'model'=>$ctp,
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd',
                    ),
                    'htmlOptions'=>array(
                        'class'=>'form-control input-sm',
                    ),
                )); ?>
            </div>
            <?php echo CHtml::error($ctp,"fechaEntega",array('class'=>'label label-danger')); ?>
        </div>
    </div>
</div>
<?php
$this->renderPartial('scripts/operaciones');
$this->renderPartial('scripts/removeList');