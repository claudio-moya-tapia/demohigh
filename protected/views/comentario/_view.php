<?php
/* @var $this ComentarioController */
/* @var $data Comentario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('comentario_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->comentario_id), array('view', 'id'=>$data->comentario_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('articulo_id')); ?>:</b>
	<?php echo CHtml::encode($data->articulo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_id')); ?>:</b>
	<?php echo CHtml::encode($data->usuario_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('texto')); ?>:</b>
	<?php echo CHtml::encode($data->texto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>