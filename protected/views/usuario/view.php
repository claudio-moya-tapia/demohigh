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
    
    <!-- Rankings -->
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
            
            if($usuario->usuario_id == $model->usuario_id){
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
        
            if($usuario->usuario_id == $model->usuario_id){
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
        <h1><?php echo ucwords($tituloPais); ?></h1>
        
        <?php 
        $i=0;
        foreach($listUsuarioPais as $usuario){             
            $i++;
            
            if($usuario->usuario_id == $model->usuario_id){
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
        
            if($usuario->usuario_id == $model->usuario_id){
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
            
            if($usuario->usuario_id == $model->usuario_id){
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
        
            if($usuario->usuario_id == $model->usuario_id){
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
    if($showArea){
    ?>
      <!--ranking gerencia-->
    <div class="caja-ranking degrade">
        <h1><?php echo ucwords($tituloArea); ?></h1>
        <?php 
        $i=0;
        foreach($listUsuarioArea as $usuario){             
            $i++;
            
            if($usuario->usuario_id == $model->usuario_id){
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
        
            if($usuario->usuario_id == $model->usuario_id){
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
     <?php } ?>
     
</div>