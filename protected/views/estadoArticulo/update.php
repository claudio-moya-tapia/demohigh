<?php
/* @var $this EstadoArticuloController */
/* @var $model EstadoArticulo */

$this->breadcrumbs=array(
	'Estado Articulos'=>array('index'),
	$model->estado_articulo_id=>array('view','id'=>$model->estado_articulo_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EstadoArticulo', 'url'=>array('index')),
	array('label'=>'Create EstadoArticulo', 'url'=>array('create')),
	array('label'=>'View EstadoArticulo', 'url'=>array('view', 'id'=>$model->estado_articulo_id)),
	array('label'=>'Manage EstadoArticulo', 'url'=>array('admin')),
);
?>

<h1>Update EstadoArticulo <?php echo $model->estado_articulo_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>