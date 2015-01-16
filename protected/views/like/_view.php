<?php
/* @var $this LikeController */
/* @var $data Like */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('like_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->like_id), array('view', 'id'=>$data->like_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('articulo_id')); ?>:</b>
	<?php echo CHtml::encode($data->articulo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_id')); ?>:</b>
	<?php echo CHtml::encode($data->usuario_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>