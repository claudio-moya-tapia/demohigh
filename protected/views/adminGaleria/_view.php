<?php
/* @var $this AdminGaleriaController */
/* @var $data Galeria */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('galeria_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->galeria_id), array('view', 'id'=>$data->galeria_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imagen')); ?>:</b>
	<?php echo CHtml::encode($data->imagen); ?>
	<br />


</div>