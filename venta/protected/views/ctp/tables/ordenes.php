<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo</strong>
    </div>
    <div class="panel-body">
<?php 
$sw=0;

if(!empty($estado))
	$sw=$estado;

if($sw==1)
{
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
        'activeCssClass'	=> 'active',
        'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
        'encodeLabel' => false,
        'items'=>array(
            array('label'=>'Cliente', 'url'=>array('ctp/buscar','t'=>1)),
            array('label'=>'Interna', 'url'=>array('ctp/buscar','t'=>2)),
            array('label'=>'Repeticion', 'url'=>array('ctp/buscar','t'=>3)),
        ),
    ));
} 
?>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$ordenes->searchOrder(),
        'filter'=>$ordenes,
        'ajaxUpdate'=>false,
		'itemsCssClass' => 'table table-hover table-condensed',
		'htmlOptions' => array('class' => 'table-responsive'),
		'columns'=>array(
			array(
					'header'=>'Nro',
					'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
			),
			array(
					'header'=>'codigo',
					'value'=>'$data->codigo',
			),
			array(
					'header'=>'Apellido Cliente',
					'value'=>'(isset($data->idCliente0->apellido))?$data->idCliente0->apellido:""',
			),
			array(
					'header'=>'Costo',
					'value'=>'$data->montoVenta',	
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'($data->tipoCTP==1)?CHtml::link("Ver",array("ctp/orden","id"=>$data->idCTP),array("class"=>"btn btn-success btn-sm")):""',
			),
			array(
					'header'=>'',
					'type'=>'raw',
					'value'=>'($data->estado==2 || $data->tipoCTP!=1)?CHtml::link("imprimir",array("ctp/preview","id"=>$data->idCTP)):""',	
			),
		)
	));
?>
    </div>
</div>