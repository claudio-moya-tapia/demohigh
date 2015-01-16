<?php
/* @var $this MobileController */
/* @var $versus Versus */
$this->pageTitle = Yii::app()->name;
?>
<!--partidos del dia-->
<div class="content">
    <!--ranking empresa-->
    <div class="cont-rank" style="height: 355px">
        <h1>Ranking empresa.</h1>
        <?php
        $i = 0;
        $showUserLocal = true;
        foreach ($listUsuario as $usuario) {
            $i++;

            if ($usuario->usuario_id == Yii::app()->user->id) {
                $miPosicion = 'tu';
                $showUserLocal = false;
            } else {
                $miPosicion = '';
            }
            ?>   
            <div class="pos">
                <div class="text">
                    <p><?php echo Yii::app()->aesManager->decrypt($usuario->nombre) . ' ' . Yii::app()->aesManager->decrypt($usuario->apellido_paterno); ?><br />
                        <span><?php echo $usuario->total_puntos ?>  puntos</span></p>
                </div>
                <div class="ci">
                    <?php echo CHtml::link(CHtml::image(Yii::app()->params["baseUrlImg"] . $usuario->imagen, 'Perfil'), array(), array('class' => $miPosicion)); ?> 
                </div>
                <div class="lugar"><?php echo $i; ?></div>
            </div>

            <div class="clear"></div>

        <?php } ?>
        <div class="separador"></div>
        <?php if ($showUserLocal) { ?>
            <div class="pos">
                <div class="text">
                    <p><?php echo Yii::app()->aesManager->decrypt($usuarioLocal->nombre) . ' ' . Yii::app()->aesManager->decrypt($usuarioLocal->apellido_paterno); ?><br />
                        <span><?php echo $usuarioLocal->total_puntos?> puntos</span></p>
                </div>
                <?php
                if ($usuarioLocal->usuario_id == Yii::app()->user->id) {
                    $miPosicion = 'tu';
                } else {
                    $miPosicion = '';
                }

                echo CHtml::link(CHtml::image(Yii::app()->params["baseUrlImg"] . $usuarioLocal->imagen, 'Perfil'), array(), array('class' => 'ci tu'));
                ?>                    
                <div class="lugar"><?php echo $usuarioRankingEmpresa; ?></div>
            </div>
            <div class="clear"></div>
        <?php } ?>
        <!--fin ranking-->
    </div>
    
        <!--ranking Area-->
    <div class="cont-rank" style="height: 355px">
        <h1>Ranking Area.</h1>
        <?php
        $i = 0;
        $showUserLocal = true;
        foreach ($listUsuarioArea as $usuario) {
            $i++;

            if ($usuario->usuario_id == Yii::app()->user->id) {
                $miPosicion = 'tu';
                $showUserLocal = false;
            } else {
                $miPosicion = '';
            }
            ?>   
            <div class="pos">
                <div class="text">
                    <p><?php echo Yii::app()->aesManager->decrypt($usuario->nombre) . ' ' . Yii::app()->aesManager->decrypt($usuario->apellido_paterno); ?><br />
                        <span><?php echo $usuario->total_puntos ?>  puntos</span></p>
                </div>
                <div class="ci">
                    <?php echo CHtml::link(CHtml::image(Yii::app()->params["baseUrlImg"] . $usuario->imagen, 'Perfil'), array(), array('class' => $miPosicion)); ?> 
                </div>
                <div class="lugar"><?php echo $i; ?></div>
            </div>

            <div class="clear"></div>

        <?php } ?>
        <div class="separador"></div>
        <?php if ($showUserLocal) { ?>
            <div class="pos">
                <div class="text">
                    <p><?php echo Yii::app()->aesManager->decrypt($usuarioLocal->nombre) . ' ' . Yii::app()->aesManager->decrypt($usuarioLocal->apellido_paterno); ?><br />
                        <span><?php echo $usuarioLocal->total_puntos ?>  puntos</span></p>
                </div>
                <?php
                if ($usuarioLocal->usuario_id == Yii::app()->user->id) {
                    $miPosicion = 'tu';
                } else {
                    $miPosicion = '';
                }

                echo CHtml::link(CHtml::image(Yii::app()->params["baseUrlImg"] . $usuarioLocal->imagen, 'Perfil'), array(), array('class' => 'ci tu'));
                ?>                    
                <div class="lugar"><?php echo $usuarioRankingArea; ?></div>
            </div>
            <div class="clear"></div>
        <?php } ?>
        <!--fin ranking-->
    </div>
</div>