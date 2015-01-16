<?php
/* @var $this LikeGaleriaController */
/* @var $model LikeGaleria */

$this->breadcrumbs=array(
	'Like Galerias'=>array('index'),
	$model->like_galeria_id,
);

$this->menu=array(
	array('label'=>'List LikeGaleria', 'url'=>array('index')),
	array('label'=>'Create LikeGaleria', 'url'=>array('create')),
	array('label'=>'Update LikeGaleria', 'url'=>array('update', 'id'=>$model->like_galeria_id)),
	array('label'=>'Delete LikeGaleria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->like_galeria_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LikeGaleria', 'url'=>array('admin')),
);
?>

<h1>View LikeGaleria #<?php echo $model->like_galeria_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'like_galeria_id',
		'galeria_id',
		'usuario_id',
		'fecha_creacion',
	),
)); ?>
