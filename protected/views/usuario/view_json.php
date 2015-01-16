<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
?>

<div class="cont-central">
    <!--migas-->
    <div class="migas">
        <p>Estás en: <?php echo CHtml::link('Home', array('/home')); ?> > Perfil</p>
        <!--fin migas-->
    </div>

    <!--caja perfil-->
    <div class="caja-perfil">
        <div class="name">
            <span><?php echo Yii::app()->aesManager->decrypt($model->nombre); ?></span>
            <span><?php echo Yii::app()->aesManager->decrypt($model->apellido_paterno); ?></span>
            <span><?php echo Yii::app()->aesManager->decrypt($model->apellido_materno); ?></span>
        </div>

        <div class="c-img">
            <?php echo CHtml::image(Yii::app()->params['baseUrlImg'].$model->imagen,'Perfil',array('width'=>145)); ?>            
        </div>

        <div class="c-datos">                                    
            
            <p><span>Empresa nombre:</span> <?php echo $model->empresa->nombre; ?></p>
            <p><span>Área nombre:</span> <?php echo $model->area->nombre; ?></p>            
            <p><span>Puntos:</span> <?php echo $model->total_puntos; ?></p>
            <p><span>Plenos:</span> <?php echo $model->total_plenos; ?></p>
            <?php 
            if ($showEdit) 
            {?> 
            <div class="btn-editar">
               <?php  
                     echo CHtml::link('Editar perfil',array('/usuario/update/'.Yii::app()->user->id));
               ?> 
            </div>
            <?php } ?> 
        </div>
             <?php 
            if ($showAddFriend) 
            {
            ?> 
                <div class="btn-agregar">
                      <?php  
                             echo CHtml::link('Agregar a mi ranking de amigos',array('/usuario/addFriend/'.$model->usuario_id));
                       ?> 
                </div>
            <?php } ?> 
        <!--fin caja perfil-->
        <div class="clear"></div>
    </div>

    <!--fin contenedor central-->
    <div class="clear"></div>
    
    <div id="rankingContainer"></div>
     
</div>