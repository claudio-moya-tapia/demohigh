<?php
/* @var $this AdminPremioController */
/* @var $model Premio */

$this->breadcrumbs=array(
	'Premios'=>array('index'),
	$model->premio_id,
);

$this->menu=array(
	array('label'=>'List Premio', 'url'=>array('index')),
	array('label'=>'Create Premio', 'url'=>array('create')),
	array('label'=>'Update Premio', 'url'=>array('update', 'id'=>$model->premio_id)),
	array('label'=>'Delete Premio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->premio_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Premio', 'url'=>array('admin')),
);
?>

<h1>View Premio #<?php echo $model->premio_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'premio_id',
		'fecha_creacion',
		'titulo',
		'texto',
		'imagen',
	),
)); ?>
