<!--migas-->
<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > <?php echo CHtml::link('Noticias', array('/adminArticulo/admin')); ?> > Actualizar</p>
    <!--fin migas-->
</div>

<h1>Actualizar Articulo</h1>

<div class="btn-crear">
<?php 
if($usuario->tipo_usuario_id == 3){
    echo CHtml::link('Actualización  Global', array('/adminArticulo/updateGeneral/'.$model->articulo_id)).'</br>';
} ?>
</div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>