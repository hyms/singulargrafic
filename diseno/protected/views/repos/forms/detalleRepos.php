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
                        $this->renderPartial('forms/_newRowDetalleRepos', array(
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
        </tbody></table>

    <div>


        <?php Yii::app()->getClientScript()->registerScript("ajax_total",
            "
                   function calcular_total() {
                    importe_total = 0
                    $('.costo*').each(
                        function(index, value) {
                            importe_total = importe_total + parseFloat($(this).val()*1);
                        }
                    );
                    $('#total').val(parseFloat(importe_total).toFixed(1));
                    cambio();
                }
            ",CClientScript::POS_HEAD); ?>

<?php
$this->renderPartial('scripts/operaciones');
$this->renderPartial('scripts/removeList');
?>