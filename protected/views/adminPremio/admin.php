<?php
/* @var $this AdminPremioController */
/* @var $model Premio */


?>
<!--migas-->
<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > Premios</p>
    <!--fin migas-->
</div>
<h1>Admin Premios</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'premio-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
            array(
                'name' => 'imagen',
                'value' => 'CHtml::image(Yii::app()->params["baseUrlImg"].$data->imagen,"Perfil");',
                'type' => 'raw',
                'filter' => false,
            ),          
            array(
                'name' => 'titulo',
                'value' => '$data->titulo',
                'type' => 'raw',
                'filter' => false,
            ),	
            array(
                'class'=>'CButtonColumn',
                'template' => '{update}{delete}',
            ),
	),
)); ?>
