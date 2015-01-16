<?php
/* @var $this AdminEstadoSistemaController */
/* @var $model EstadoSistema */

$this->breadcrumbs=array(
	'Estado Sistemas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EstadoSistema', 'url'=>array('index')),
	array('label'=>'Manage EstadoSistema', 'url'=>array('admin')),
);
?>

<h1>Create EstadoSistema</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>