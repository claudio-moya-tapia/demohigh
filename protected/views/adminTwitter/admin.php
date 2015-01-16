<?php
/* @var $this AdminTwitterController */
/* @var $model Twitter */
?>

<h1>Administrar Twitter</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'twitter-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'fecha_creacion',
        array(
            'name' => 'Email',
            'value' => 'Yii::app()->aesManager->decrypt($data->usuario->email)',
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
            'name' => 'Texto',
            'value' => '$data->texto',
            'type' => 'raw',
            'filter' => false,
        ),        
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'deleteConfirmation' => '¿Seguro que desea eliminar el tweet?',
        ),
    ),
));
?>
