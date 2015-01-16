<?php
/* @var $this EstadoArticuloController */
/* @var $model EstadoArticulo */

$this->breadcrumbs=array(
	'Estado Articulos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EstadoArticulo', 'url'=>array('index')),
	array('label'=>'Manage EstadoArticulo', 'url'=>array('admin')),
);
?>

<h1>Create EstadoArticulo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>