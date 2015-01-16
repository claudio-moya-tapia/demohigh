<?php
/* @var $this EstadoArticuloController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Estado Articulos',
);

$this->menu=array(
	array('label'=>'Create EstadoArticulo', 'url'=>array('create')),
	array('label'=>'Manage EstadoArticulo', 'url'=>array('admin')),
);
?>

<h1>Estado Articulos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
