<?php
/* @var $this AdminTwitterController */
/* @var $model Twitter */
?>
<!--migas-->
<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > <?php echo CHtml::link('Twitter', array('/adminTwitter/admin')); ?> > Actualizar</p>
    <!--fin migas-->
</div>

<h1>Administrar Twitter</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>