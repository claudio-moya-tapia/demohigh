<?php
/* @var $this AdminPremioController */
/* @var $data Premio */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('premio_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->premio_id), array('view', 'id'=>$data->premio_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('texto')); ?>:</b>
	<?php echo CHtml::encode($data->texto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imagen')); ?>:</b>
	<?php echo CHtml::encode($data->imagen); ?>
	<br />


</div>