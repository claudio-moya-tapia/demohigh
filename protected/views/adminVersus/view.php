<?php
/* @var $this AdminVersusController */
/* @var $model Versus */

$this->breadcrumbs=array(
	'Versuses'=>array('index'),
	$model->versus_id,
);

$this->menu=array(
	array('label'=>'List Versus', 'url'=>array('index')),
	array('label'=>'Create Versus', 'url'=>array('create')),
	array('label'=>'Update Versus', 'url'=>array('update', 'id'=>$model->versus_id)),
	array('label'=>'Delete Versus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->versus_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Versus', 'url'=>array('admin')),
);
?>

<h1>View Versus #<?php echo $model->versus_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'versus_id',
		'fecha',
		'pais_id_a',
		'pais_id_b',
		'goles_a',
		'goles_b',
		'ganador',
	),
)); ?>
