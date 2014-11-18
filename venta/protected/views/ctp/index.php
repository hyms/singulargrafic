<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Top 5 Clientes</strong>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$clientes,
            'itemsCssClass' => 'table table-hover table-condensed',
            'htmlOptions' => array('class' => 'table-responsive'),
            'columns'=>array(
                array(
                    'header'=>'Nro',
                    'value'=>'($row+1)',
                ),
                array(
                    'header'=>'NitCi',
                    'type'=>'raw',
                    'value'=>'$data["idCliente0"]["nitCi"]',
                ),
                array(
                    'header'=>'Apellido',
                    'type'=>'raw',
                    'value'=>'$data["idCliente0"]["apellido"]',
                ),
                array(
                    'header'=>'Responsable',
                    'type'=>'raw',
                    'value'=>'$data["responsable"]',
                ),

                array(
                    'header'=>'cantidad',
                    'type'=>'raw',
                    'value'=>'$data["cantidad"]',
                ),
            )
        ));
        ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Placas por agotarse</strong>
    </div>
    <div class="panel-body" style="overflow: auto;">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$agotarse,
            'itemsCssClass' => 'table table-hover table-condensed',
            'htmlOptions' => array('class' => 'table-responsive'),
            'columns'=>array(
                array(
                    'header'=>'Nro',
                    'value'=>'($row+1)',
                ),
                array(
                    'header'=>'Formato',
                    'type'=>'raw',
                    'value'=>'$data["idProducto0"]["color"]." - ".$data["idProducto0"]["detalle"]',
                ),
                array(
                    'header'=>'stock',
                    'type'=>'raw',
                    'value'=>'$data["stockU"]',
                ),
            )
        ));
        ?>
    </div>
</div>