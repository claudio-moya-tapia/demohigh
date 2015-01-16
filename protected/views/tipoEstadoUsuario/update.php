<?php
/* @var $this TipoEstadoUsuarioController */
/* @var $model TipoEstadoUsuario */

$this->breadcrumbs=array(
	'Tipo Estado Usuarios'=>array('index'),
	$model->tipo_estado_usuario_id=>array('view','id'=>$model->tipo_estado_usuario_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoEstadoUsuario', 'url'=>array('index')),
	array('label'=>'Create TipoEstadoUsuario', 'url'=>array('create')),
	array('label'=>'View TipoEstadoUsuario', 'url'=>array('view', 'id'=>$model->tipo_estado_usuario_id)),
	array('label'=>'Manage TipoEstadoUsuario', 'url'=>array('admin')),
);
?>

<h1>Update TipoEstadoUsuario <?php echo $model->tipo_estado_usuario_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>