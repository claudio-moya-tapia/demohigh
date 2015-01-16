<!--migas-->
<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > Galeria</p>
    <!--fin migas-->
</div>
<h1>Administrar Galeria</h1>

<div class="btn-crear">
    <?php
      echo CHtml::link('Crear', array('/adminGaleria/create')) . '</br>';
    ?>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'galeria-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
            		        array(
            'name' => 'imagen',
            'value' => 'CHtml::image(Yii::app()->params["baseUrlImg"].$data->imagen,"Perfil",array("class"=>"img"));',
            'type' => 'raw',
            'filter' => false,
        ),
//		'galeria_id',
		'fecha_creacion',
		'titulo',
	array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'deleteConfirmation' => '¿Seguro que desea eliminar el articulo?',
        ),
	),
)); ?>
