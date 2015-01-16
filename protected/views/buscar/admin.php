<?php
/* @var $this BuscarController */
/* @var $model Usuario */
?>

<h1>Buscar Usuarios</h1>

<div class="search-form" style="display:block">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="clear"></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usuario-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(	
                array (
                    'name'=>'imagen',
                    'value'=>'CHtml::image(Yii::app()->params["baseUrlImg"].$data->imagen,"Perfil",array("class"=>"img"));',
                    'type'=>'raw',
                    'filter'=>false,
                ),
		array (
                    'name'=>'nombre',
                    'value'=>'ucwords(Yii::app()->aesManager->decrypt($data->nombre));',
                    'type'=>'raw',
                    'filter'=>false,
                ),           
                array (
                    'name'=>'apellido_paterno',
                    'value'=>'ucwords(Yii::app()->aesManager->decrypt($data->apellido_paterno));',
                    'type'=>'raw',
                    'filter'=>false,
                ), 
                array (
                    'name'=>'email',
                    'value'=>'Yii::app()->aesManager->decrypt($data->email);',
                    'type'=>'raw',
                    'filter'=>false,
                ), 
                array (
                    'name'=>'total_puntos',
                    'value'=>'$data->total_puntos',
                    'type'=>'raw',
                    'filter'=>false,
                ),
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{friend}{profile}',
                    'buttons'=>array
                    (
                        'friend' => array(
                            'label'=>'Agregar a mi Ranking',
                            'options' => array('class'=>'ranking-agregar'),                            
                            'imageUrl'=>Yii::app()->params["baseUrl"].'/images/ranking-agregar.png',
                            'url'=> 'CHtml::normalizeUrl(array("/usuario/ajaxAddFriend/".rawurlencode($data->usuario_id)))',
                            'options'=>array(  
                              'ajax'=>array(
                                'type'=>'GET',
                                'url'=>"js:$(this).attr('href')",
                                'success'=>'function(data, textStatus, jqXHR){
                                    alert(data);
                                }',
                              ),
                            ),
                        ),
                        'profile' => array (                            
                            'label'=>'Ver perfil',
                            'imageUrl'=>Yii::app()->params["baseUrl"].'/images/ranking-perfil.png',
                            'url'=>'CHtml::normalizeUrl(array("/usuario/".rawurlencode($data->usuario_id)))',                            
                        ),
                    )
		),
	),
)); ?>

