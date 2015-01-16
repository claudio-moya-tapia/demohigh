<?php
/* @var $this AdminGaleriaController */
/* @var $model Galeria */

$this->breadcrumbs=array(
	'Galerias'=>array('index'),
	$model->galeria_id,
);

$this->menu=array(
	array('label'=>'List Galeria', 'url'=>array('index')),
	array('label'=>'Create Galeria', 'url'=>array('create')),
	array('label'=>'Update Galeria', 'url'=>array('update', 'id'=>$model->galeria_id)),
	array('label'=>'Delete Galeria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->galeria_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Galeria', 'url'=>array('admin')),
);
?>

<h1>View Galeria #<?php echo $model->galeria_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'galeria_id',
		'fecha_creacion',
		'titulo',
		'imagen',
	),
)); ?>
