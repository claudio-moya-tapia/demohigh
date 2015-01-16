<?php
/* @var $this VersusController */
/* @var $model Versus */

$this->breadcrumbs=array(
	'Versuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Versus', 'url'=>array('index')),
	array('label'=>'Manage Versus', 'url'=>array('admin')),
);
?>

<h1>Create Versus</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>