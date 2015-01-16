<!--migas-->
<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > Noticias</p>
    <!--fin migas-->
</div>

<h1>Administrar Artículos</h1>


<div class="btn-crear">
    <?php
    if ($usuario->tipo_usuario_id == 3) {
        echo CHtml::link('Crear', array('/adminArticulo/create')) . '</br>';
        echo CHtml::link('Crear General', array('/adminArticulo/createGeneral'));
    } else {
        echo CHtml::link('Crear', array('/adminArticulo/create'));
    }
    ?>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'articulo-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'imagen',
            'value' => 'CHtml::image(Yii::app()->params["baseUrlImg"].$data->imagen,"Perfil",array("class"=>"img"));',
            'type' => 'raw',
            'filter' => false,
        ),
        array(
            'name' => 'fecha_creacion',
            'value' => '$data->fecha_creacion',
            'type' => 'raw',
            'filter' => false,
        ),
        'titulo',
        array(
            'name' => 'tipo_destacado',
            'value' => '$data->tipo_destacado->titulo',
            'type' => 'raw',
            'filter' => CHtml::activeDropDownList($model, 'tipo_destacado_id', array('1' => 'Destacado', '2' => 'No destacado'), array('prompt' => '(Todos)'))
        ),
        array(
            'name' => 'estado_articulo',
            'value' => '$data->estado_articulo->titulo',
            'type' => 'raw',
            'filter' => CHtml::activeDropDownList($model, 'estado_articulo_id', array('1' => 'Publicado', '2' => 'No Publicado', '3' => 'Eliminado'), array('prompt' => '(Todos)'))
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'deleteConfirmation' => '¿Seguro que desea eliminar el articulo?',
        ),
    ),
));
?>