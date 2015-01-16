<?php
/* @var $this AdminRankingController */
/* @var $dataProvider CActiveDataProvider */

?>
<div class="cont-central">
    <!--migas-->
    <div class="migas">
        <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > Ranking</p>
        <!--fin migas-->
    </div>

    <!--ranking empresa-->
    <div class="caja-ranking degrade">
        <h1>Ranking empresa.</h1>
        
        <?php 
        $i=1;
        foreach($listUsuarioEmpresa as $usuario){             

        ?>        
            <div class="pos2">
                <p class="tit"><?php echo Yii::app()->aesManager->decrypt($usuario->nombre).' '.Yii::app()->aesManager->decrypt($usuario->apellido_paterno); ?></p>
                <p class="pts"><?php echo $usuario->total_puntos ?> puntos</p>
                <?php echo CHtml::link(CHtml::image(Yii::app()->params['baseUrlImg'].$usuario->imagen,'Perfil'), array('usuario/'.$usuario->usuario_id),array('class'=>$miPosicion)); ?>                    
                <div class="lugar"><?php echo $i++; ?></div>
            </div>
        
        <?php } ?>    
        <div class="clear"></div>
    </div>
    
    <!--ranking por area-->
    
            <?php 
       $k = 0;
        foreach($listUsuarioArea as $Areas){
            
            $i=1;
           ?>
        <div class="caja-ranking degrade">
        <h1>Ranking Area <?php echo $Areas->nombre ?></h1>
        <?php
        
        foreach($listUsuarioAreaComplete[$k] as $usuarioArea){             

        ?>  
                    
                        <div class="pos2">
                            <p class="tit"><?php echo Yii::app()->aesManager->decrypt($usuarioArea->nombre).' '.Yii::app()->aesManager->decrypt($usuarioArea->apellido_paterno); ?></p>
                            <p class="pts"><?php echo $usuarioArea->total_puntos ?> puntos</p>
                            <?php echo CHtml::link(CHtml::image(Yii::app()->params['baseUrlImg'].$usuarioArea->imagen,'Perfil'), array('usuario/'.$usuarioArea->usuario_id),array('class'=>$miPosicion)); ?>                    
                            <div class="lugar"><?php echo $i++; ?></div>
                        </div>              
        <?php }
        $k++;
       
        ?>
        <div class="clear"></div>          
        </div>  
        <?php }?>
        
      
</div>