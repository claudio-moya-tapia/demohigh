<?php
/* @var $usuario Usuario */
?>

<div class="cont-central">
    <!--migas-->
    <div class="migas">
        <p>Estás en: <?php echo CHtml::link('Home', array('/home')); ?> > <?php echo CHtml::link('Ranking', array('/ranking'));?> > TOP 100</p>        
        <!--fin migas-->
    </div>

    <h1>TOP 100</h1>
    <div class="caja-ranking degrade">
        <h1><?php echo $tituloEmpresa; ?></h1>

        <?php
        $i = 0;
        foreach ($listUsuarioTodos as $usuario) {
            $i++;

            if ($usuario->usuario_id == Yii::app()->user->id) {
                $miPosicion = 'tu';
            } else {
                $miPosicion = '';
            }
            ?>        
            <div class="pos">
                <p class="tit"><?php echo ucwords(Yii::app()->aesManager->decrypt($usuario->nombre)) . ' ' . ucwords(Yii::app()->aesManager->decrypt($usuario->apellido_paterno)); ?></p>
                <p class="pts"><?php echo $usuario->total_puntos ?> puntos</p>
                <?php echo CHtml::link(CHtml::image(Yii::app()->params['baseUrlImg'] . $usuario->imagen, 'Perfil'), array('usuario/' . $usuario->usuario_id), array('class' => $miPosicion)); ?>                    
                <div class="lugar"><?php echo $i; ?></div>
            </div>

        <?php } ?>


        <!--fin ranking empresa-->
        <div class="clear"></div>
    </div>

    <!--fin contenedor central-->
    <div class="clear"></div>
</div>