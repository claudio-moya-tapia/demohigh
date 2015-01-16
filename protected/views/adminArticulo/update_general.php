<?php
/* @var $this AdminArticuloController */
/* @var $model Articulo */
?>
<!--migas-->
<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > <?php echo CHtml::link('Noticias', array('/adminArticulo/admin')); ?> > Actualizar</p>
    <!--fin migas-->
</div>

<h1>Crear Articulo General</h1>

<?php $this->renderPartial('_form', 
        array(
            'model'=>$model
        )); ?>