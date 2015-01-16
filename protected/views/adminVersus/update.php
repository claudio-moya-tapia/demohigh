<?php
/* @var $this AdminVersusController */
/* @var $model Versus */
?>

<!--migas-->
<div class="migas">
    <p>
        <?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > 
        <?php echo CHtml::link('Versus', array('/adminVersus/admin')); ?> > 
        <?php echo $model->pais_a->nombre.' vs '.$model->pais_b->nombre; ?> >
        Actualizar
    </p>
    <!--fin migas-->
</div>
<h1>Actualizar Versus</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>