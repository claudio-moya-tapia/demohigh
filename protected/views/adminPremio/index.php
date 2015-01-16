<?php
/* @var $this AdminPremioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Premios',
);

$this->menu=array(
	array('label'=>'Create Premio', 'url'=>array('create')),
	array('label'=>'Manage Premio', 'url'=>array('admin')),
);
?>

<h1>Premios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
