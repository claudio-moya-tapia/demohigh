<?php
/* @var $this ArticuloController */
/* @var $model Articulo */

$this->breadcrumbs=array(
	'Articulos'=>array('index'),
	$model->articulo_id,
);

$this->menu=array(
	array('label'=>'List Articulo', 'url'=>array('index')),
	array('label'=>'Create Articulo', 'url'=>array('create')),
	array('label'=>'Update Articulo', 'url'=>array('update', 'id'=>$model->articulo_id)),
	array('label'=>'Delete Articulo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->articulo_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Articulo', 'url'=>array('admin')),
);
?>

<h1>View Articulo #<?php echo $model->articulo_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'articulo_id',
		'fecha_creacion',
		'fecha_actualizacion',
		'titulo',
		'texto',
		'imagen',
		'destacado',
                'estado_articulo',
	),
)); ?>
