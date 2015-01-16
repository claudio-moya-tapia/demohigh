<?php
/* @var $this LikeGaleriaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Like Galerias',
);

$this->menu=array(
	array('label'=>'Create LikeGaleria', 'url'=>array('create')),
	array('label'=>'Manage LikeGaleria', 'url'=>array('admin')),
);
?>

<h1>Like Galerias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
