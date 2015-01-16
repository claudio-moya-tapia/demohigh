<?php
/* @var $this UsuarioPaisController */
/* @var $data UsuarioPais */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_pais')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->usuario_pais), array('view', 'id'=>$data->usuario_pais)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
	<br />


</div>