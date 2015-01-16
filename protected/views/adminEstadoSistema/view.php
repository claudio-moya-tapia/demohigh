<?php
/* @var $this AdminEstadoSistemaController */
/* @var $model EstadoSistema */

$this->breadcrumbs=array(
	'Estado Sistemas'=>array('index'),
	$model->estado_sistema_id,
);

$this->menu=array(
	array('label'=>'List EstadoSistema', 'url'=>array('index')),
	array('label'=>'Create EstadoSistema', 'url'=>array('create')),
	array('label'=>'Update EstadoSistema', 'url'=>array('update', 'id'=>$model->estado_sistema_id)),
	array('label'=>'Delete EstadoSistema', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->estado_sistema_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EstadoSistema', 'url'=>array('admin')),
);
?>

<h1>View EstadoSistema #<?php echo $model->estado_sistema_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'estado_sistema_id',
		'estado_id',
	),
)); ?>
