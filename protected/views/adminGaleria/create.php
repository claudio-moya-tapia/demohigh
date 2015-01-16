<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > <?php echo CHtml::link('Galeria', array('/adminGaleria/admin')); ?> > Crear</p>
    <!--fin migas-->
</div>

<h1>Create Galeria</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>