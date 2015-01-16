<?php
/* @var $this VersusController */
/* @var $data Versus */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('versus_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->versus_id), array('view', 'id'=>$data->versus_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pais_id_a')); ?>:</b>
	<?php echo CHtml::encode($data->pais_id_a); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pais_id_b')); ?>:</b>
	<?php echo CHtml::encode($data->pais_id_b); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('goles_a')); ?>:</b>
	<?php echo CHtml::encode($data->goles_a); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('goles_b')); ?>:</b>
	<?php echo CHtml::encode($data->goles_b); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ganador')); ?>:</b>
	<?php echo CHtml::encode($data->ganador); ?>
	<br />


</div>