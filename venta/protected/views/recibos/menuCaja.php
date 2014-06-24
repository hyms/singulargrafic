<div class="row">
<?php
	$this->widget('zii.widgets.CMenu',array(
		'htmlOptions' => array('class' => 'nav nav-tabs hidden-print'),
		'activeCssClass'	=> 'active',
		'encodeLabel' => false,
		'items'=>array(
			//array('label'=>'Ventas Dia','url'=>array('caja/index','vd'=>date('d'))),
				array('label'=>'Registro Diario', 'url'=>array('caja/index','ld'=>date('d'))),
				array('label'=>'Arqueo', 'url'=>array('caja/arqueo')),
				array('label'=>'Caja Chica', 'url'=>array('caja/chica')),
			//array('label'=>'Recibos Dia', 'url'=>array('caja/index','rd'=>date('d'))),
		),
	));
?>
	
</div>