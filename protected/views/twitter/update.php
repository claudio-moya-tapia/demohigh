<?php
/* @var $this TwitterController */
/* @var $model Twitter */

$this->breadcrumbs=array(
	'Twitters'=>array('index'),
	$model->twitter_id=>array('view','id'=>$model->twitter_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Twitter', 'url'=>array('index')),
	array('label'=>'Create Twitter', 'url'=>array('create')),
	array('label'=>'View Twitter', 'url'=>array('view', 'id'=>$model->twitter_id)),
	array('label'=>'Manage Twitter', 'url'=>array('admin')),
);
?>

<h1>Update Twitter <?php echo $model->twitter_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>