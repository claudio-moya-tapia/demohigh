<?php
/* @var $this EstadoArticuloController */
/* @var $data EstadoArticulo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado_articulo_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->estado_articulo_id), array('view', 'id'=>$data->estado_articulo_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
	<br />


</div>