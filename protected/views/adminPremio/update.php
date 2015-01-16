<?php
/* @var $this AdminPremioController */
/* @var $model Premio */
?>
<!--migas-->
<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > <?php echo CHtml::link('Premios', array('/adminPremio/admin')); ?> > Actualizar</p>
    <!--fin migas-->
</div>

<h1>Actualizar Premio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>