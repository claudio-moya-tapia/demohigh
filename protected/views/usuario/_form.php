<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

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
            <div class="imagen">
               <div class="documentoImagen">
               <?php echo CHtml::image(Yii::app()->params['baseUrl'] . '/images/empty.gif', 'imagen', array('id' => 'Usuario_img')); ?>            
               </div>                
              
               <br />
                <div class="c-subir">      
                <div id="queue"></div>
               <input id="DocumentoUpload" name="DocumentoUpload" type="file" />
               </div>
           </div>
        </div>
 
        <?php echo $form->hiddenField($model, 'imagen', array('size' => 60, 'maxlength' => 255)); ?>

        <div class="c-datos">            
            <p><span>Usuario:</span> <?php echo $model->user; ?></p>
            <p><span>Contraseña:</span>  <?php echo $form->passwordField($model,'pass',array('size'=>45,'maxlength'=>45)); ?></p>       
            <?php
            if($canEditNickname){
            ?>
                <p><span>Nickname:</span> <?php echo $form->textField($model,'nickname',array('size'=>45,'maxlength'=>45)); ?></p>                        
            <?php
            }
            ?>
            <div class="btn-guardar"><?php echo CHtml::submitButton('Guardar'); ?></div>
        </div>

        <!--fin caja perfil-->
        <div class="clear"></div>
    </div>

    <!--fin contenedor central-->
    <div class="clear"></div>
</div>

<?php $this->endWidget(); ?>