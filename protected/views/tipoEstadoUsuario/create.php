<?php
/* @var $this TipoEstadoUsuarioController */
/* @var $model TipoEstadoUsuario */

$this->breadcrumbs=array(
	'Tipo Estado Usuarios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TipoEstadoUsuario', 'url'=>array('index')),
	array('label'=>'Manage TipoEstadoUsuario', 'url'=>array('admin')),
);
?>

<h1>Create TipoEstadoUsuario</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>