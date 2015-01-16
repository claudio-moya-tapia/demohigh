<?php
/* @var $this AdminTwitterController */
/* @var $model Twitter */

$this->breadcrumbs=array(
	'Twitters'=>array('index'),
	$model->twitter_id,
);

$this->menu=array(
	array('label'=>'List Twitter', 'url'=>array('index')),
	array('label'=>'Create Twitter', 'url'=>array('create')),
	array('label'=>'Update Twitter', 'url'=>array('update', 'id'=>$model->twitter_id)),
	array('label'=>'Delete Twitter', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->twitter_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Twitter', 'url'=>array('admin')),
);
?>

<h1>View Twitter #<?php echo $model->twitter_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'twitter_id',
		'fecha_creacion',
		'usuario_id',
		'texto',
	),
)); ?>
