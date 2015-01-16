<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > <?php echo CHtml::link('Galeria', array('/adminGaleria/admin')); ?> > Actualizar</p>
    <!--fin migas-->
</div>


<h1>Update Galeria <?php echo $model->galeria_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>