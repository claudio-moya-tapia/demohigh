<?php
/* @var $this AdminComentarioController */
/* @var $model Comentario */
?>
<!--migas-->
<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > <?php echo CHtml::link('Comentarios', array('/adminComentario/admin')); ?> > Actualizar</p>
    <!--fin migas-->
</div>

<h1>Actualizar Comentario</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>