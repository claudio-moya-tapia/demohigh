<?php
/* @var $this VersusController */
/* @var $model Versus */

$this->breadcrumbs=array(
	'Versuses'=>array('index'),
	$model->versus_id=>array('view','id'=>$model->versus_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Versus', 'url'=>array('index')),
	array('label'=>'Create Versus', 'url'=>array('create')),
	array('label'=>'View Versus', 'url'=>array('view', 'id'=>$model->versus_id)),
	array('label'=>'Manage Versus', 'url'=>array('admin')),
);
?>

<h1>Update Versus <?php echo $model->versus_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>