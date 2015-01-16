<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->usuario_id=>array('view','id'=>$model->usuario_id),
	'Update',
);
?>

<?php 
$this->renderPartial('_form', array(
    'model'=>$model,
    'canEditNickname'=>$canEditNickname
)); 
?>