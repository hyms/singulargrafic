<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Deudores CTP</strong>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$deudores,
            'ajaxUpdate'=>true,
            'itemsCssClass' => 'table table-hover table-condensed',
            'htmlOptions' => array('class' => 'table-responsive'),
            'columns'=>array(
                array(
                    'header'=>'Nro',
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
                array(
                    'header'=>'Nombre y Apellido',
                    'value'=>'$data->idCliente0->nombre." ".$data->idCliente0->apellido',
                ),
                array(
                    'header'=>'Orden de trabajo',
                    'value'=>'$data->codigo',
                ),
                array(
                    'header'=>'Saldo',
                    'value'=>'$data->montoVenta - $data->montoPagado',
                ),
                array(
                    'header'=>'FechaPlazo',
                    'value'=>'date("d-m-Y",strtotime($data->fechaPlazo))',
                ),
                array(
                    'header'=>'',
                    'type'=>'raw',
                    'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-usd\"></span> Cancelar",array("caja/deuda","id"=>$data->idCTP,"serv"=>"ot"))',
                ),
            )
        ));
        ?>
    </div>
</div>