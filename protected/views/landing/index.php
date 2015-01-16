<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
Yii::app()->clientScript->registerCssFile(Yii::app()->params['baseUrl'] . '/css/login.css');
?>

<div class="cont-landing">

    
    <input id="usuarioName" type="hidden" value="<?php echo $usuario->nickname; ?>">
	
    <div id="paso4" class="paso4" style="display:<?php echo $displayPaso4; ?>;">
        <p class="tit">Sube tu foto</p>
         <p class="p">
            <label class="label">Desde tu computador (tamaño máximo 1MB)</label>
                
        <div class="c-img">
            <div class="imagen">
               <div class="documentoImagen">
               <?php echo CHtml::image(Yii::app()->params['baseUrl'] . '/images/empty.gif', 'imagen', array('id' => 'Usuario_img')); ?>            
                </div>     
                <input name="Usuario[imagen]" id="Usuario_imagen" type="hidden" value="<?php echo $usuario->imagen; ?>" />
                <input class="imagen" id="imagen" type="text" value="" style="display:none;">
                <input type="hidden" id="isLocalAvatar" value="si" />
                <br />
                <div class="">      
               <input id="DocumentoUpload" name="DocumentoUpload" type="file" />
               </div>
           </div>
        </div>
        </p>
        <div class="clear"></div>
		
            <?php if(Yii::app()->session['project'] != 'gruposiglo'){ ?>
            <p class="p"><label class="label">Ó elige tu avatar</label></p>
            <div class="clear"></div>
            <div class="avatar">
                <img id="avatarImg1" src="images/avatar-1.jpg" width="81" height="80" alt="Elige tu avatar" style="cursor: pointer" /> 
                <input class="ml30" id="avatar1" type="radio" name="avatar" />
            </div>
            <div class="avatar">
                <img id="avatarImg2" src="images/avatar-2.jpg" width="81" height="80" alt="Elige tu avatar" style="cursor: pointer" /> 
                <input class="ml30" id="avatar2" type="radio" name="avatar" />
            </div>
            <div class="avatar">
                <img id="avatarImg3" src="images/avatar-3.jpg" width="81" height="80" alt="Elige tu avatar" style="cursor: pointer" /> 
                <input class="ml30" id="avatar3" type="radio" name="avatar" />
            </div> 
            <div class="avatar">
                <img id="avatarImg4" src="images/avatar-4.jpg" width="81" height="80" alt="Elige tu avatar" style="cursor: pointer" /> 
                <input class="ml30" id="avatar4" type="radio" name="avatar" />
            </div> 
            <div class="clear"></div>  
            <div class="avatar">
                <img id="avatarImg5" src="images/avatar-5.jpg" width="81" height="80" alt="Elige tu avatar" style="cursor: pointer" /> 
                <input class="ml30" id="avatar5" type="radio" name="avatar" />
            </div>
            <div class="avatar">
                <img id="avatarImg6" src="images/avatar-6.jpg" width="81" height="80" alt="Elige tu avatar" style="cursor: pointer" /> 
                <input class="ml30" id="avatar6" type="radio" name="avatar"/>
            </div>
            <div class="avatar">
                <img id="avatarImg7" src="images/avatar-7.jpg" width="81" height="80" alt="Elige tu avatar" style="cursor: pointer" /> 
                <input class="ml30" id="avatar7" type="radio" name="avatar"/>
            </div> 
            <div class="avatar">
                <img id="avatarImg8" src="images/avatar-8.jpg" width="81" height="80" alt="Elige tu avatar" style="cursor: pointer" /> 
                <input class="ml30" id="avatar8" type="radio" name="avatar"/>
            </div> 

            <?php } ?>
		
            <input type="hidden" id="ImgDB"  value="<?php echo $usuario->imagen; ?>"/>
    
        <div class="clear"></div>  
        <div class="botones">
            <a class="ant" id="anteriorPaso4" href="javascript:void(0)">Anterior</a>
            <a class="sig" id="siguientePaso4" href="javascript:void(0)">Siguiente</a>
        </div>
        <div class="clear"></div>
        <!--fin paso4-->
    </div>
    
    <!--paso5-->
    <div class="paso5"  id="paso5" style="display:<?php echo $displayPaso5; ?>;">
        <p class="tit">C&oacute;mo jugar</p>
        <div class="caja">
            <img src="images/Icono_Mundialero_01.gif" alt="Mundialero" />
            <p><?php echo $textoGif1; ?></p> 
            <div class="clear"></div>
        </div>
        <div class="caja">
            <img src="images/Icono_Mundialero_02.gif" alt="Mundialero" />
            <p><?php echo $textoGif2; ?></p> 
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="caja">
            <img src="images/Icono_Mundialero_03.gif" alt="Mundialero" />
            <p>Partido a partido ir&aacute;s acumulando puntos, los cuales te situar&aacute;n en el ranking de la empresa y de tu &aacute;rea. Adem&aacute;s podr&aacute;s armar un ranking con tus amigos m&aacute;s cercanos. Rev&iacute;salo en la secci&oacute;n RANKING.</p> 
            <div class="clear"></div>
        </div>
        <div class="caja">
            <img src="images/Icono_Mundialero_04.gif" alt="Mundialero" />
            <p><?php echo $textoGif4; ?></p> 
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="botones">
            <a class="ant" id="anteriorPaso5" href="javascript:void(0)" style="display:<?php echo $displayPaso4; ?>">Anterior</a>
            <a class="sig" id="siguientePaso5" href="javascript:void(0)">Siguiente</a>
        </div>
        <div class="clear"></div>
        <!--fin paso5-->
    </div>

    <!--paso6-->
    <div class="paso6"  id="paso6" style="display:none;">
        <div class="cb">
            <p class="tit">C&aacute;lculo de Puntajes</p>
            <div class="botones">
                <a class="bases" href="<?php echo 'http://storage.googleapis.com/mundialero2014/download/bases_mundialero_2014_'.Yii::app()->session['project'].'.pdf'; ?>" target="_blank">Descarga las Bases</a>
                <p class="txt-bases">del Mundialero , o rev&iacute;salas en la secci&oacute;n REGLAMENTO</p>
                
                <a class="comenzar" id="siguientePaso6" href="javascript:void(0)">&iexcl;COMENZAR A JUGAR!</a>
            </div>
        </div>
        <!--fin paso6-->
    </div>

</div>