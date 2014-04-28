<?php
/* @var $this DistribuidoraController */

$this->breadcrumbs=array(
	'Recibos',
);
?>
<div class="col-sm-2">
<?php $this->renderPartial('menu'); ?>
</div>

<div class="col-sm-10">
<?php
	$this->widget('zii.widgets.CMenu',array(
		'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
		'activeCssClass'	=> 'active',
		'encodeLabel' => false,
		'items'=>array(
			array('label'=>'Ventas Dia','url'=>array('caja/index','vd'=>date('d'))),
			array('label'=>'Libro Diario', 'url'=>array('caja/index','ld'=>date('d'))),
			array('label'=>'Recibos Dia', 'url'=>array('caja/index','rd'=>date('d'))),
		),
	));
?>
	<div class="col-sm-offset-3 col-sm-7">
	<div class="form-group">
	<?php echo CHtml::link('Imprimir', '#', array("class"=>"btn btn-default hidden-print","onClick"=>"printView()")); ?>
	</div>
	</div>
<?php 
	if($vd)
	{
		$this->renderPartial('ventaDia',array('tabla'=>$tabla));
	}
	
	if($ld)
	{
		$this->renderPartial('libroDiario');
	}
	
?>

</div>
<?php 
$script = "
		function printView()
		{
			window.print();
		
		}";
Yii::app()->clientScript->registerScript("print",$script,CClientScript::POS_HEAD);
?>