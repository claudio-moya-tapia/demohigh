<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */

$this->breadcrumbs=array(
	'Tipo Usuarios'=>array('index'),
	$model->tipo_usuario_id=>array('view','id'=>$model->tipo_usuario_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoUsuario', 'url'=>array('index')),
	array('label'=>'Create TipoUsuario', 'url'=>array('create')),
	array('label'=>'View TipoUsuario', 'url'=>array('view', 'id'=>$model->tipo_usuario_id)),
	array('label'=>'Manage TipoUsuario', 'url'=>array('admin')),
);
?>

<h1>Update TipoUsuario <?php echo $model->tipo_usuario_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>