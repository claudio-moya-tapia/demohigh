<?php
/* @var $this LikeController */
/* @var $model Like */

$this->breadcrumbs=array(
	'Likes'=>array('index'),
	$model->like_id,
);

$this->menu=array(
	array('label'=>'List Like', 'url'=>array('index')),
	array('label'=>'Create Like', 'url'=>array('create')),
	array('label'=>'Update Like', 'url'=>array('update', 'id'=>$model->like_id)),
	array('label'=>'Delete Like', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->like_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Like', 'url'=>array('admin')),
);
?>

<h1>View Like #<?php echo $model->like_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'like_id',
		'articulo_id',
		'usuario_id',
		'fecha_creacion',
	),
)); ?>
