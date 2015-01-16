<?php
/* @var $this LikeGaleriaController */
/* @var $model LikeGaleria */

$this->breadcrumbs=array(
	'Like Galerias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LikeGaleria', 'url'=>array('index')),
	array('label'=>'Manage LikeGaleria', 'url'=>array('admin')),
);
?>

<h1>Create LikeGaleria</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>