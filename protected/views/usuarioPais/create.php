<?php
/* @var $this UsuarioPaisController */
/* @var $model UsuarioPais */

$this->breadcrumbs=array(
	'Usuario Paises'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UsuarioPais', 'url'=>array('index')),
	array('label'=>'Manage UsuarioPais', 'url'=>array('admin')),
);
?>

<h1>Create UsuarioPais</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>