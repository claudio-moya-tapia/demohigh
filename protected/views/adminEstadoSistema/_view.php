<?php
/* @var $this AdminEstadoSistemaController */
/* @var $data EstadoSistema */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado_sistema_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->estado_sistema_id), array('view', 'id'=>$data->estado_sistema_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado_id')); ?>:</b>
	<?php echo CHtml::encode($data->estado_id); ?>
	<br />


</div>