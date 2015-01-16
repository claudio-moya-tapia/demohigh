<?php
/* @var $this EstadoArticuloController */
/* @var $model EstadoArticulo */

$this->breadcrumbs=array(
	'Estado Articulos'=>array('index'),
	$model->estado_articulo_id,
);

$this->menu=array(
	array('label'=>'List EstadoArticulo', 'url'=>array('index')),
	array('label'=>'Create EstadoArticulo', 'url'=>array('create')),
	array('label'=>'Update EstadoArticulo', 'url'=>array('update', 'id'=>$model->estado_articulo_id)),
	array('label'=>'Delete EstadoArticulo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->estado_articulo_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EstadoArticulo', 'url'=>array('admin')),
);
?>

<h1>View EstadoArticulo #<?php echo $model->estado_articulo_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'estado_articulo_id',
		'titulo',
	),
)); ?>
