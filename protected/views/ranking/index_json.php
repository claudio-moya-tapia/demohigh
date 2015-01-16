<?php
/* @var $usuario Usuario */
?>

<div class="cont-central">
    <!--migas-->
    <div class="migas">
        <p>Estás en: <?php echo CHtml::link('Home', array('/home')); ?> > Ranking</p>        
        <!--fin migas-->
    </div>

    <h1>Revisa el ranking de los TOP 100</h1>
    
    <br>
    <?php 
    if(Yii::app()->session['project'] == 'cristal'){        
        ?>
        <div class="btn-crear" style="width: 160px;">
            <?php echo CHtml::link('Ver TOP 100 TOTAL CCU', array('top100'),array('style'=>'width: 160px;')); ?>        
        </div>
        <div class="btn-crear" style="float: left;margin-top: -30px;margin-left: 175px;">        
            <?php echo CHtml::link('Ranking Segunda Fase UEN', array('top100cuartosyoctavos'),array('style'=>'width: 200px;')); ?>
        </div>
        <?php
    }else{
    ?>
        <div class="btn-crear">
            <?php echo CHtml::link('Ver TOP 100', array('top100')); ?>        
        </div>
    <?php
    }
    ?>    
    <br>
    
    <div id="rankingContainer"></div>
   
    
    <!--ranking mis amigos-->
   <?php 
    if($showAmigos){
    ?>   
        <div class="caja-ranking degrade">
            <div class="btn-agregar"><?php echo CHtml::link('Agregar amigos', array('/buscar')); ?></div>
            <h1 id="rankingAmigos"><?php echo $tituloMisAmigos; ?></h1>
            
            <?php 
            if(count($listUsuarioAmigos) > 0){
            
                $i=0;
                foreach($listUsuarioAmigos as $usuario){             
                    $i++;
                    if($usuario->usuario_id == Yii::app()->user->id){
                        $miPosicion = 'tu';
                    }else{
                        $miPosicion = '';
                    }
                ?>        
                <div class="pos"> 
                   
                    <p class="tit"><?php echo ucwords(Yii::app()->aesManager->decrypt($usuario->nombre)).' '.ucwords(Yii::app()->aesManager->decrypt($usuario->apellido_paterno)); ?></p>
                    <p class="pts"><?php echo $usuario->total_puntos ?> puntos</p>
                    <?php echo CHtml::link(CHtml::image(Yii::app()->params['baseUrlImg'].$usuario->imagen,'Perfil'), array('usuario/'.$usuario->usuario_id),array('class'=>$miPosicion)); ?>                    
                    <div class="lugar"><?php echo $i; ?></div>
                     <div class="btn-borrar"><?php echo CHtml::button('Borrar', array('class'=>'ranking-amigos','id'=>'usuario_id_'.$usuario->usuario_id,'alt'=>$usuario->nombre.' '.$usuario->apellido_paterno)); ?></div>
                </div>

                <?php } ?>

                <div class="separador"></div>

                <?php 
                foreach($listUsuarioRankingAmigos as $usuario){ 

                    if($usuario->usuario_id == Yii::app()->user->id){
                        $miPosicion = 'tu2';
                    }else{
                        $miPosicion = '';
                    }

                ?>
                <div class="pos2">
                    <p class="tit"><?php echo ucwords(Yii::app()->aesManager->decrypt($usuario->nombre)).' '.ucwords(Yii::app()->aesManager->decrypt($usuario->apellido_paterno)); ?></p>
                    <p class="pts"><?php echo $usuario->total_puntos; ?> puntos</p>
                    <?php echo CHtml::link(CHtml::image(Yii::app()->params['baseUrlImg'].$usuario->imagen,'Perfil'), array('usuario/'.$usuario->usuario_id),array('class'=>$miPosicion)); ?>                
                    <div class="lugar"><?php echo $usuario->rank; ?></div>
                    <div class="btn-borrar"><?php echo CHtml::button('Borrar', array('class'=>'ranking-amigos','id'=>'usuario_id_'.$usuario->usuario_id,'alt'=>ucwords(Yii::app()->aesManager->decrypt($usuario->nombre)).' '.ucwords(Yii::app()->aesManager->decrypt($usuario->apellido_paterno)))); ?></div>
                </div>
                <?php } ?>
                <!--fin ranking mis amigos-->
                <div class="clear"></div>
             <?php } ?>
        </div>
    	<?php
    }
    ?>
    
    <!--fin contenedor central-->
    <div class="clear"></div>
</div>