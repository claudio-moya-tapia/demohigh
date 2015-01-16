<?php
/* @var $this HomeController */
/* @var $versus Versus */
$this->pageTitle = Yii::app()->name;
?>

<div id="loadingBox" style="
    width: 110px;
    height: 20px;
    background-color: white;
    position: fixed;
    top: 0px;
    margin-left: 410px;
    font-family: Arial;
    font-size: 12px;
    padding: 10px;
    border-width: 1px;
    border-style: dashed;
    border-color: lightgray;
    font-weight: bold;
    display: none;
    z-index:99999;
    "><img src="images/ajax-loader.gif"> <span id="loadingMsg">Cargando</span></div>

<!--carrusel-->
<div class="rotator">
    <div class="slideshow" id="flavor_2"></div>
    <!--fin carrusel-->
</div>

<?php if ($showTwitter) { ?>
    <!--twitter-->
    <div class="cont-tuit degrade">
        <h1>Twitter interno.</h1>
        <div class="caja" id="cajaTwitter"></div>
        <input name="Twitter[texto]" id="Twitter_texto" maxlength="140" value="" />
        <div class="btn-tuit"><a href="#;" id="btnTwitter">Twittear</a></div>
        <div class="ico"></div>
        <div class="clear"></div>
        <!--fin twitter-->
    </div>
<?php } ?>
<div class="clear"></div>

<!--ranking-->
<div class="caja-rank degrade">
    
    <?php if ($showGrupos) { ?>
        <h1><?php echo ucwords($tituloEmpresa); ?></h1>
        <?php
        $i = 0;
        $showUserLocal = true;
        foreach ($listUsuarioGrupos as $usuario) {
            $i++;

            if ($usuario->usuario_id == $usuario_id_grupo) {
                $miPosicion = 'tu';
                $showUserLocal = false;
            } else {
                $miPosicion = '';
            }
            ?>   
            <div class="pos">
                <p class="tit"><?php echo ucwords(Yii::app()->aesManager->decrypt($usuario->nombre)) . ' ' . ucwords(Yii::app()->aesManager->decrypt($usuario->apellido_paterno)); ?></p>
                <p class="pts"><?php echo $usuario->total_puntos ?> puntos</p>
                <?php echo CHtml::link(CHtml::image(Yii::app()->params["baseUrlImg"] . $usuario->imagen, 'Perfil'), array('usuario/' . $usuario->usuario_id), array('class' => $miPosicion)); ?>                    
                <div class="lugar"><?php echo $i; ?></div>
            </div>    
        <?php } ?>
        <?php if ($showUserLocal) { ?>
            <div class="pos">
                <p class="tit">Tú</p>
                <p class="pts"><?php echo $usuarioLocal->total_puntos ?> puntos</p>
                <?php
                if ($usuarioLocal->usuario_id == $usuario_id_grupo) {
                    $miPosicion = 'tu';
                } else {
                    $miPosicion = '';
                }

                echo CHtml::link(CHtml::image(Yii::app()->params["baseUrlImg"] . $usuarioLocal->imagen, 'Perfil'), array('usuario/' . $usuarioLocal->usuario_id), array('class' => $miPosicion));
                ?>                    
                <div class="lugar"><?php echo $usuarioRankingGrupos; ?></div>
            </div>
        <?php } ?>
    <?php } ?>
    <div class="clear"></div>
    
    <?php if ($showTodos) { ?>
        <h1><?php echo ucwords($tituloEmpresa); ?></h1>
        <?php
        $i = 0;
        $showUserLocal = true;
        foreach ($listUsuarioTodos as $usuario) {
            $i++;

            if ($usuario->usuario_id == Yii::app()->user->id) {
                $miPosicion = 'tu';
                $showUserLocal = false;
            } else {
                $miPosicion = '';
            }
            ?>   
            <div class="pos">
                <p class="tit"><?php echo ucwords(Yii::app()->aesManager->decrypt($usuario->nombre)) . ' ' . ucwords(Yii::app()->aesManager->decrypt($usuario->apellido_paterno)); ?></p>
                <p class="pts"><?php echo $usuario->total_puntos ?> puntos</p>
                <?php echo CHtml::link(CHtml::image(Yii::app()->params["baseUrlImg"] . $usuario->imagen, 'Perfil'), array('usuario/' . $usuario->usuario_id), array('class' => $miPosicion)); ?>                    
                <div class="lugar"><?php echo $i; ?></div>
            </div>    
        <?php } ?>
        <?php if ($showUserLocal) { ?>
            <div class="pos">
                <p class="tit">Tú</p>
                <p class="pts"><?php echo $usuarioLocal->total_puntos ?> puntos</p>
                <?php
                if ($usuarioLocal->usuario_id == Yii::app()->user->id) {
                    $miPosicion = 'tu';
                } else {
                    $miPosicion = '';
                }

                echo CHtml::link(CHtml::image(Yii::app()->params["baseUrlImg"] . $usuarioLocal->imagen, 'Perfil'), array('usuario/' . $usuarioLocal->usuario_id), array('class' => $miPosicion));
                ?>                    
                <div class="lugar"><?php echo $usuarioRankingTodos; ?></div>
            </div>
        <?php } ?>
    <?php } ?>
    <div class="clear"></div>
    
    <?php if ($showEmpresa) { ?>
        <h1><?php echo ucwords($tituloEmpresa); ?></h1>
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
                <p class="tit"><?php echo ucwords(Yii::app()->aesManager->decrypt($usuario->nombre)) . ' ' . ucwords(Yii::app()->aesManager->decrypt($usuario->apellido_paterno)); ?></p>
                <p class="pts"><?php echo $usuario->total_puntos ?> puntos</p>
                <?php echo CHtml::link(CHtml::image(Yii::app()->params["baseUrlImg"] . $usuario->imagen, 'Perfil'), array('usuario/' . $usuario->usuario_id), array('class' => $miPosicion)); ?>                    
                <div class="lugar"><?php echo $i; ?></div>
            </div>    
        <?php } ?>
        <?php if ($showUserLocal) { ?>
            <div class="pos">
                <p class="tit">Tú</p>
                <p class="pts"><?php echo $usuarioLocal->total_puntos ?> puntos</p>
                <?php
                if ($usuarioLocal->usuario_id == Yii::app()->user->id) {
                    $miPosicion = 'tu';
                } else {
                    $miPosicion = '';
                }

                echo CHtml::link(CHtml::image(Yii::app()->params["baseUrlImg"] . $usuarioLocal->imagen, 'Perfil'), array('usuario/' . $usuarioLocal->usuario_id), array('class' => $miPosicion));
                ?>                    
                <div class="lugar"><?php echo $usuarioRanking; ?></div>
            </div>
        <?php } ?>
    <?php } ?>
    <div class="clear"></div>

    <?php if ($showArea) { ?>
        <h1><?php echo ucwords($tituloArea); ?></h1>
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
                <p class="tit"><?php echo ucwords(Yii::app()->aesManager->decrypt($usuario->nombre)) . ' ' . ucwords(Yii::app()->aesManager->decrypt($usuario->apellido_paterno)); ?></p>
                <p class="pts"><?php echo $usuario->total_puntos ?> puntos</p>
                <?php echo CHtml::link(CHtml::image(Yii::app()->params["baseUrlImg"] . $usuario->imagen, 'Perfil'), array('usuario/' . $usuario->usuario_id), array('class' => $miPosicion)); ?>                    
                <div class="lugar"><?php echo $i; ?></div>
            </div>    
        <?php } ?>
        <?php if ($showUserLocal) { ?>
            <div class="pos">
                <p class="tit">Tú</p>
                <p class="pts"><?php echo $usuarioLocal->total_puntos ?> puntos</p>
                <?php
                if ($usuarioLocal->usuario_id == Yii::app()->user->id) {
                    $miPosicion = 'tu';
                } else {
                    $miPosicion = '';
                }

                echo CHtml::link(CHtml::image(Yii::app()->params["baseUrlImg"] . $usuarioLocal->imagen, 'Perfil'), array('usuario/' . $usuarioLocal->usuario_id), array('class' => $miPosicion));
                ?>                    
                <div class="lugar"><?php echo $usuarioRankingArea; ?></div>
            </div>
        <?php } ?>
    <?php } ?>
    <div class="clear"></div>
        
    <?php if ($showPais) { ?>
        <h1><?php echo ucwords($tituloPais); ?></h1>
        <?php
        $i = 0;
        $showUserLocal = true;
        foreach ($listUsuarioPais as $usuario) {
            $i++;

            if ($usuario->usuario_id == Yii::app()->user->id) {
                $miPosicion = 'tu';
                $showUserLocal = false;
            } else {
                $miPosicion = '';
            }
            ?>   
            <div class="pos">
                <p class="tit"><?php echo ucwords(Yii::app()->aesManager->decrypt($usuario->nombre)) . ' ' . ucwords(Yii::app()->aesManager->decrypt($usuario->apellido_paterno)); ?></p>
                <p class="pts"><?php echo $usuario->total_puntos ?> puntos</p>
                <?php echo CHtml::link(CHtml::image(Yii::app()->params["baseUrlImg"] . $usuario->imagen, 'Perfil'), array('usuario/' . $usuario->usuario_id), array('class' => $miPosicion)); ?>                    
                <div class="lugar"><?php echo $i; ?></div>
            </div>    
        <?php } ?>
        <?php if ($showUserLocal) { ?>
            <div class="pos">
                <p class="tit">Tú</p>
                <p class="pts"><?php echo $usuarioLocal->total_puntos ?> puntos</p>
                <?php
                if ($usuarioLocal->usuario_id == Yii::app()->user->id) {
                    $miPosicion = 'tu';
                } else {
                    $miPosicion = '';
                }

                echo CHtml::link(CHtml::image(Yii::app()->params["baseUrlImg"] . $usuarioLocal->imagen, 'Perfil'), array('usuario/' . $usuarioLocal->usuario_id), array('class' => $miPosicion));
                ?>                    
                <div class="lugar"><?php echo $usuarioRankingArea; ?></div>
            </div>
        <?php } ?>
    <?php } ?>
        
    <?php echo CHtml::link('Ir a Ranking', array('/ranking'), array('class' => 'a')); ?>
    <div class="ico"></div>
    <!--fin ranking-->
    <div class="clear"></div>
</div>

<!--partidos del dia-->
<div class="cont-pdd degrade">
    <h1>Próximos partidos</h1>

    <?php
    foreach ($listVersus as $versus) {

        if ($versus->pais_id_a != 0) {
            ?>
            <div class="par partidos-dia" id="<?php echo 'versus_id_' . $versus->versus_id ?>" style="display: none">
                <?php echo CHtml::hiddenField('versus_fecha', $versus->fecha); ?>
                <p class="tit"><?php echo $versus->pais_a->nombre ?> vs. <?php echo $versus->pais_b->nombre ?></p>
                <p class="hr">
                    <?php
                    $fecha = new DateTime($versus->fecha);

                    $fechaPartido = $fecha->format('d');
                    if ($fecha->format('m') == '06') {
                        $fechaPartido .= ' de Junio';
                    }

                    if ($fecha->format('m') == '07') {
                        $fechaPartido .= ' de Julio';
                    }

                    echo $fechaPartido . ' a las ' . $fecha->format('H:i') . 'horas';
                    ?>
                </p>
                <?php echo CHtml::image('images/rayalab/' . $versus->pais_a->imagen_big, $versus->pais_a->nombre, array('class' => 'img1')); ?>        

                <?php echo CHtml::textField('PrediccionA[]', '', array('id' => 'PrediccionA_' . $versus->versus_id, 'maxlength' => 2)); ?> 
                <span>-</span>
                <?php echo CHtml::textField('PrediccionB[]', '', array('id' => 'PrediccionB_' . $versus->versus_id, 'maxlength' => 2)); ?>         
                <?php echo CHtml::image('images/rayalab/' . $versus->pais_b->imagen_big, $versus->pais_b->nombre, array('class' => 'img2')); ?>        
                <div class="clear"></div>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th>0%</th>
                        <th>0%</th>
                        <th>0%</th>
                    </tr>
                    <tr>
                        <td class="td1" width="5%"></td>
                        <td class="td2" width="0%"></td>
                        <td class="td3" width="5%"></td>
                    </tr>
                </table>
            </div>
            <?php
        }
    }
    ?>

    <?php echo CHtml::link('Ir a Calendario', array('/calendario')); ?>    
    <div class="ico"></div>
    <!--fin partidos del dia-->
    <div class="clear"></div>
</div>




<!--fin contenedor central-->
<div class="clear"></div>
