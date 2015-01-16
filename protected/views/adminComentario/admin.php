<!--migas-->
<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > Comentarios</p>
    <!--fin migas-->
</div>

<h1>Administrador de  Comentarios</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'comentario-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'fecha_creacion',
            'value' => '$data->fecha_creacion',
            'type' => 'raw',            
        ),
        array(
            'name' => 'Noticia',
            'value' => '$data->articulo->titulo',
            'type' => 'raw',    
            'filter' => false,
        ),
        array(
            'name' => 'Usuario',
            'value' => 'Yii::app()->aesManager->decrypt($data->usuario->nombre)." ".Yii::app()->aesManager->decrypt($data->usuario->apellido_paterno)',
            'type' => 'raw',
            'filter' => false,
        ),        
        array(
            'name' => 'texto',
            'value' => '$data->texto',
            'type' => 'raw',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));
?>
