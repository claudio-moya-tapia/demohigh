<?php
/* @var $this AdminUsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->usuario_id,
);

$this->menu=array(
	array('label'=>'List Usuario', 'url'=>array('index')),
	array('label'=>'Create Usuario', 'url'=>array('create')),
	array('label'=>'Update Usuario', 'url'=>array('update', 'id'=>$model->usuario_id)),
	array('label'=>'Delete Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->usuario_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Usuario', 'url'=>array('admin')),
);
?>

<h1>View Usuario #<?php echo $model->usuario_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'usuario_id',
		'fecha_nacimiento',
		'fecha_creacion',
		'last_login_time',
		'user',
		'pass',
		'rut',
		'nombre',
		'apellido_paterno',
		'apellido_materno',
		'nickname',
		'email',
		'empresa_id',
		'area_id',
		'imagen',
		'total_puntos',
		'total_plenos',
		'rank',
		'amigos_usuario_id',
                'usuario_pais_id',
                'tipo_estado_usuario_id',
                'tipo_usuario_id'
	),
)); ?>
