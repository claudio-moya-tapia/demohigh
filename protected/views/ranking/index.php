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
    <div class="btn-crear">
        <?php echo CHtml::link('Ver TOP 100', array('top100')); ?>
    </div>
    <br>

    <?php 
    if($showGrupos){
    ?>
        <div class="caja-ranking degrade">
            <h1><?php echo $tituloEmpresa; ?></h1>

            <?php 
            $i=0;
            foreach($listUsuarioGrupos as $usuario){
                $i++;

                if($usuario->usuario_id == $usuario_id_grupo){
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
                </div>

            <?php } ?>

            <div class="separador"></div>

            <?php 
            foreach($listUsuarioRankingGrupos as $usuario){ 

                if($usuario->usuario_id == $usuario_id_grupo){
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
            </div>
            <?php } ?>

            <!--fin ranking empresa-->
            <div class="clear"></div>
        </div>
    <?php } ?>

    <?php 
    if($showTodos){
    ?>
        <div class="caja-ranking degrade">
            <h1><?php echo $tituloEmpresa; ?></h1>

            <?php 
            $i=0;
            foreach($listUsuarioTodos as $usuario){
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
                </div>

            <?php } ?>

            <div class="separador"></div>

            <?php 
            foreach($listUsuarioRankingTodos as $usuario){ 

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
            </div>
            <?php } ?>

            <!--fin ranking empresa-->
            <div class="clear"></div>
        </div>
    <?php } ?>
    
    <?php 
    if($showEmpresa){
    ?>
        <!--ranking empresa-->
        <div class="caja-ranking degrade">
            <h1><?php echo $tituloEmpresa; ?></h1>

            <?php 
            $i=0;
            foreach($listUsuario as $usuario){             
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
                </div>

            <?php } ?>

            <div class="separador"></div>

            <?php 
            foreach($listUsuarioRanking as $usuario){ 

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
            </div>
            <?php } ?>

            <!--fin ranking empresa-->
            <div class="clear"></div>
        </div>
    <?php } ?>

    <?php 
    if($showPais){
    ?>
    
     <div class="caja-ranking degrade">
        <h1><?php echo $tituloPais; ?></h1>
        
        <?php 
        $i=0;
        foreach($listUsuarioPais as $usuario){             
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
            </div>
        
        <?php } ?>

        <div class="separador"></div>

        <?php 
        foreach($listUsuarioRankingPais as $usuario){ 
        
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
        </div>
        <?php } ?>
       
        <div class="clear"></div>
    </div>

    <?php
    }
    ?>
	
    <?php 
    if($showArea){
    ?>
    
    <!--ranking gerencia-->
    <div class="caja-ranking degrade">
        <h1><?php echo ucwords($tituloArea); ?></h1>
        <?php 
        $i=0;
        foreach($listUsuarioArea as $usuario){             
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
            </div>
        
        <?php } ?>

        <div class="separador"></div>

        <?php 
        foreach($listUsuarioRankingArea as $usuario){ 
        
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
        </div>
        <?php } ?>

        <!--fin ranking gerencia-->
        <div class="clear"></div>
    </div>
	
	<?php
    }
    ?>
    
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