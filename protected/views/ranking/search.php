<?php /* @var $usuario Usuario */ ?>
<div id="resultadoBuscador">

    <?php
    foreach ($listUsuario as $usuario) {
        ?>
        <div>
            <p><?php echo $usuario->nombre.' '.$usuario->apellido_paterno; ?></p>   
            <p><?php echo $usuario->total_puntos; ?>puntos</p>   
            <?php echo CHtml::link(CHtml::image(Yii::app()->params['baseUrlImg'].$usuario->imagen,'Perfil'), array('usuario/'.$usuario->usuario_id)); ?>            
            <?php echo CHtml::link('Agregar a mi ranking', array('ranking/AddFriend/'.$usuario->usuario_id)); ?>            
            <?php echo CHtml::link('Ver perfil', array('usuario/'.$usuario->usuario_id)); ?>                        
        </div>
        <?php
    }
    ?>

</div>