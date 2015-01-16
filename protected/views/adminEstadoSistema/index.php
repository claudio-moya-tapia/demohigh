<?php
/* @var $this AdminEstadoSistemaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Estado Sistemas',
);

$this->menu=array(
	array('label'=>'Create EstadoSistema', 'url'=>array('create')),
	array('label'=>'Manage EstadoSistema', 'url'=>array('admin')),
);
?>

<h1>Estado Sistemas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
