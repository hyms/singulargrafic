<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Deudores</strong>
    </div>
    <div class="panel-body">

        <?php // echo CHtml::link('Añadir',array('cliente/Create'), array('class' => 'btn btn-default') ); ?>

        <?php $this->widget('zii.widgets.grid.CGridView',
            array(
                'dataProvider'=>$clientes,
                'itemsCssClass' => 'table table-hover table-condensed',
                'htmlOptions' => array('class' => 'table-responsive'),
                'columns'=>array(
                    array(
                        'header'=>'Orden',
                        'value'=>'$data->apellido',
                    ),
                    array(
                        'header'=>'Cliente',
                        'value'=>'$data->apellido',
                    ),
                    array(
                        'header'=>'Total',
                        'value'=>'$data->apellido',
                    ),
                    array(
                        'header'=>'Desc.',
                        'value'=>'$data->apellido',
                    ),
                    array(
                        'header'=>'Cobrar',
                        'value'=>'$data->apellido',
                    ),
                    array(
                        'header'=>'A/C',
                        'value'=>'$data->apellido',
                    ),
                    array(
                        'header'=>'Cancelado',
                        'value'=>'$data->apellido',
                    ),
                    array(
                        'header'=>'Saldo',
                        'value'=>'$data->apellido',
                    )
                )
            )
        );
        ?>
    </div>
</div>