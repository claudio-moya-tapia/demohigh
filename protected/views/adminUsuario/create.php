<?php
/* @var $this AdminUsuarioController */
/* @var $model Usuario */
?>
<!--migas-->
<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > <?php echo CHtml::link('Usuarios', array('/adminUsuario/admin')); ?> > Crear</p>
    <!--fin migas-->
</div>

<h1>Crear Usuario</h1>

<?php $this->renderPartial('_form', 
        array(
            'model'=>$model,
            'listArea' => $listArea,
            'listTipoEstado' => $listTipoEstado,
            'listTipoUsuario' => $listTipoUsuario
        )); ?>