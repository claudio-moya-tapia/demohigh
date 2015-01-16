<?php
/* @var $this UsuarioPaisController */
/* @var $model UsuarioPais */

$this->breadcrumbs=array(
	'Usuario Paises'=>array('index'),
	$model->usuario_pais,
);

$this->menu=array(
	array('label'=>'List UsuarioPais', 'url'=>array('index')),
	array('label'=>'Create UsuarioPais', 'url'=>array('create')),
	array('label'=>'Update UsuarioPais', 'url'=>array('update', 'id'=>$model->usuario_pais)),
	array('label'=>'Delete UsuarioPais', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->usuario_pais),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UsuarioPais', 'url'=>array('admin')),
);
?>

<h1>View UsuarioPais #<?php echo $model->usuario_pais; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'usuario_pais',
		'titulo',
	),
)); ?>
