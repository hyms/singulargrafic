<div class="row">
  	<div class="nav-stacked col-md-2">
		<?php $this->widget('zii.widgets.CMenu',
				array(
				'htmlOptions' => array( 'class' => 'nav nav-pills nav-stacked' ),
				'activeCssClass'	=> 'active',
				'items'=>array(
				array('label'=>'Siderbar', 'url'=>array('#')),
				array('label'=>'Paginas', 'url'=>array('#')),
			),
		)); ?>
	</div>	
  	<div class="col-md-10">
		contenido de botones
	</div>
</div>