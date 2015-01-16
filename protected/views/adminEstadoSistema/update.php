<?php
/* @var $this AdminEstadoSistemaController */
/* @var $model EstadoSistema */
?>
<!--migas-->
<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > Estado de Sistema</p>
    <!--fin migas-->
</div>

<h1>Actualizar</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>