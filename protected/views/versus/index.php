<?php
/* @var $this VersusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Versuses',
);

$this->menu=array(
	array('label'=>'Create Versus', 'url'=>array('create')),
	array('label'=>'Manage Versus', 'url'=>array('admin')),
);
?>

<h1>Versuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
