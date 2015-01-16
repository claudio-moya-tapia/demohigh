<?php
/* @var $this AdminPremioController */
/* @var $model Premio */

$this->breadcrumbs=array(
	'Premios'=>array('admin'),
	'Crear',
);
?>

<h1>Crear Premio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>