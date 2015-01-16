<?php
/* @var $this TipoEstadoUsuarioController */
/* @var $data TipoEstadoUsuario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_estado_usuario_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->tipo_estado_usuario_id), array('view', 'id'=>$data->tipo_estado_usuario_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
	<br />


</div>