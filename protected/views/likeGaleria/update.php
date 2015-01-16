<?php
/* @var $this LikeGaleriaController */
/* @var $model LikeGaleria */

$this->breadcrumbs=array(
	'Like Galerias'=>array('index'),
	$model->like_galeria_id=>array('view','id'=>$model->like_galeria_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LikeGaleria', 'url'=>array('index')),
	array('label'=>'Create LikeGaleria', 'url'=>array('create')),
	array('label'=>'View LikeGaleria', 'url'=>array('view', 'id'=>$model->like_galeria_id)),
	array('label'=>'Manage LikeGaleria', 'url'=>array('admin')),
);
?>

<h1>Update LikeGaleria <?php echo $model->like_galeria_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>