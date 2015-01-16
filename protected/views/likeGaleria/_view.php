<?php
/* @var $this LikeGaleriaController */
/* @var $data LikeGaleria */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('like_galeria_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->like_galeria_id), array('view', 'id'=>$data->like_galeria_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('galeria_id')); ?>:</b>
	<?php echo CHtml::encode($data->galeria_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_id')); ?>:</b>
	<?php echo CHtml::encode($data->usuario_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>