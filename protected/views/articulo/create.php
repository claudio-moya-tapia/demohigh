<?php
/* @var $this ArticuloController */
/* @var $model Articulo */

$this->breadcrumbs=array(
	'Articulos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Articulo', 'url'=>array('index')),
	array('label'=>'Manage Articulo', 'url'=>array('admin')),
);
?>

<h1>Create Articulo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>