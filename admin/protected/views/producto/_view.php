<?php
/* @var $this ProductoController */
/* @var $data Producto */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::encode($data->codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('peso')); ?>:</b>
	<?php echo CHtml::encode($data->peso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idColor')); ?>:</b>
	<?php echo CHtml::encode($data->idColor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dimension')); ?>:</b>
	<?php echo CHtml::encode($data->dimension); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('procedencia')); ?>:</b>
	<?php echo CHtml::encode($data->procedencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('costoSF')); ?>:</b>
	<?php echo CHtml::encode($data->costoSF); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('costoSFUnidad')); ?>:</b>
	<?php echo CHtml::encode($data->costoSFUnidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('costoCF')); ?>:</b>
	<?php echo CHtml::encode($data->costoCF); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('costoCFUnidad')); ?>:</b>
	<?php echo CHtml::encode($data->costoCFUnidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idIndustria')); ?>:</b>
	<?php echo CHtml::encode($data->idIndustria); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('obs')); ?>:</b>
	<?php echo CHtml::encode($data->obs); ?>
	<br />

	*/ ?>

</div>