<?php
/* @var $this TipoEstadoUsuarioController */
/* @var $model TipoEstadoUsuario */

$this->breadcrumbs=array(
	'Tipo Estado Usuarios'=>array('index'),
	$model->tipo_estado_usuario_id,
);

$this->menu=array(
	array('label'=>'List TipoEstadoUsuario', 'url'=>array('index')),
	array('label'=>'Create TipoEstadoUsuario', 'url'=>array('create')),
	array('label'=>'Update TipoEstadoUsuario', 'url'=>array('update', 'id'=>$model->tipo_estado_usuario_id)),
	array('label'=>'Delete TipoEstadoUsuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->tipo_estado_usuario_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoEstadoUsuario', 'url'=>array('admin')),
);
?>

<h1>View TipoEstadoUsuario #<?php echo $model->tipo_estado_usuario_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'tipo_estado_usuario_id',
		'titulo',
	),
)); ?>
