<?php
$dataProvider =  new CArrayDataProvider($clientes,
    array(
        'id'=>'idCliente',
        'keyField' => 'id',
        'keys'=>array('id', 'nitCi', 'apellido','idPreferencia',),
        'pagination'=>false,
        'sort'=>array(
            'attributes'=>array(
                'id', 'nitCi', 'apellido','idPreferencia',
            ),
        ),
    ));
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Preferencias de Clientes CTP</strong>
    </div>
    <div class="panel-body" style="overflow: auto; height: 600px;">

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'form',
            'htmlOptions'=>array(
                'class'=>'form-horizontal',
                'role'=>'form'),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation'=>false,
        ));/* ?>

            <table class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th><?php echo "Nro";?></th>
                    <th><?php echo "Nit/Ci";?></th>
                    <th><?php echo "Apellido";?></th>
                    <th class="text-center" colspan=3><?php echo "Preferencia Cliente";?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=0;
                foreach ($clientes as $cliente){
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $cliente->nitCi;?></td>
                        <td><?php echo $cliente->apellido;?></td>
                        <td><?php echo CHtml::activeRadioButtonList($cliente,"[$i]idTiposClientes",CHtml::listData(TiposClientes::model()->findAll("servicio=1"),"idTiposClientes","nombre"),array("separator"=>"</td><td>","labelOptions"=>array("display"=>"inline"),'id'=>'Cliente_idTiposClientes_'.$i));?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <?php */
        $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'itemsCssClass' => 'table table-hover table-condensed',
	'htmlOptions' => array('class' => 'table-responsive'),
	'columns'=>array(
		/*array(
				'header'=>'Nro',
				'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
		),*/
		array(
                'header'=>'Nit/Ci',
				'name'=>'nitCi',
				'value'=>'$data->nitCi',
		),
		array(
				'header'=>'Apellido',
                'name'=>'apellido',
				'value'=>'$data->apellido',
		),
		array(
				'header'=>'Preferencia Cliente',
				'type'=>'raw',
                'headerHtmlOptions' => array(
                    'class' => 'text-center','colspan'=>3,
                ),
                'value'=>'CHtml::activeRadioButtonList($data,"[$row]idTiposClientes",CHtml::listData(TiposClientes::model()->findAll("servicio=1"),"idTiposClientes","nombre"),array("separator"=>"</td><td>","labelOptions"=>array("display"=>"inline"),"id"=>"Cliente_idTiposClientes_".$row))'
		),
	)
	));//*/
            ?>

            <?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-default hidden-print','id'=>'save')); ?>

        <?php $this->endWidget(); ?>
    </div>
</div>