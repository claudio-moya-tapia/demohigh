<?php
/* @var $this UsuarioPaisController */
/* @var $model UsuarioPais */

$this->breadcrumbs=array(
	'Usuario Paises'=>array('index'),
	$model->usuario_pais=>array('view','id'=>$model->usuario_pais),
	'Update',
);

$this->menu=array(
	array('label'=>'List UsuarioPais', 'url'=>array('index')),
	array('label'=>'Create UsuarioPais', 'url'=>array('create')),
	array('label'=>'View UsuarioPais', 'url'=>array('view', 'id'=>$model->usuario_pais)),
	array('label'=>'Manage UsuarioPais', 'url'=>array('admin')),
);
?>

<h1>Update UsuarioPais <?php echo $model->usuario_pais; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>