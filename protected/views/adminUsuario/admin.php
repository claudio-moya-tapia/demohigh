<?php
/* @var $this AdminUsuarioController */
/* @var $model Usuario */
?>
<!--migas-->
<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > Usuarios</p>
    <!--fin migas-->
</div>
<h1>Administrador de Usuarios</h1>

<div class="btn-crear">
    <?php echo CHtml::link('Crear', array('/adminUsuario/create')); ?>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'usuario-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array (
            'name'=>'imagen',
            'value'=>'CHtml::image(Yii::app()->params["baseUrlImg"].$data->imagen,"Perfil",array("class"=>"img"));',
            'type'=>'raw',
            'filter'=>false,
        ),
         array(
            'name' => 'tipo_usuario_id',
            'value' => '$data->tipo_usuario->titulo',
            'type' => 'raw',
            'filter' => CHtml::activeDropDownList($model, 'tipo_usuario_id', array('1' => 'Usuario', '2' => 'Administrador'), array('prompt' => '(Todos)'))
        ),
        array(
            'name' => 'rut',
            'value' => 'Yii::app()->aesManager->decrypt($data->rut);',
            'type' => 'raw',
        ),
        array(
            'name' => 'user',
            'value' => 'Yii::app()->aesManager->decrypt($data->user);',
            'type' => 'raw',
        ),
        array(
            'name' => 'email',
            'value' => 'Yii::app()->aesManager->decrypt($data->email);',
            'type' => 'raw',
        ),
        array(
            'name' => 'area',
            'value' => '$data->area->nombre',
            'type' => 'raw',
            'filter'=>false,
        ),       
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));
?>
