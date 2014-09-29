<div class="well well-sm">
<?php
$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('class' => 'nav nav-pills nav-stacked hidden-print'),
				'activeCssClass'	=> 'active',
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'encodeLabel' => false,
				'items'=>array(
							array('label'=>'Cliente', 'url'=>array('orden/cliente')),
							array('label'=>'Interna', 'url'=>array('orden/interna')),
							array('label'=>'Buscar Orden', 'url'=>array('orden/buscar')),
							array('label'=>'Repeticion', 'url'=>array('orden/rep')),
							array('label'=>'Buscar Repeticion', 'url'=>array('orden/buscarR')),
							
				)));
?>
</div>