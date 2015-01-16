<?php
/* @var $this UsuarioPaisController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usuario Paises',
);

$this->menu=array(
	array('label'=>'Create UsuarioPais', 'url'=>array('create')),
	array('label'=>'Manage UsuarioPais', 'url'=>array('admin')),
);
?>

<h1>Usuario Paises</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
