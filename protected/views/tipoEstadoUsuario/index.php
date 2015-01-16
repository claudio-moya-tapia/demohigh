<?php
/* @var $this TipoEstadoUsuarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Estado Usuarios',
);

$this->menu=array(
	array('label'=>'Create TipoEstadoUsuario', 'url'=>array('create')),
	array('label'=>'Manage TipoEstadoUsuario', 'url'=>array('admin')),
);
?>

<h1>Tipo Estado Usuarios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
