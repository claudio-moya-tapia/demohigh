<?php 
/* @var $articulo Articulo */
?>

<div class="cont-central">
    <!--migas-->
    <div class="migas">
        <p>Estás en: <?php echo CHtml::link('Home', array('/home')); ?> > <?php echo CHtml::link('Noticias', array('/noticia')); ?> > <?php echo $articulo->titulo; ?></p>
        <!--fin migas-->
    </div>

    <!--caja noticia-->
    <div class="caja-d-noti">
        <h1><?php echo $articulo->titulo; ?></h1>
        <div class="text">
            <?php echo $articulo->texto; ?>
        </div>            
        <div class="c-img">
            <?php echo CHtml::image(Yii::app()->params['baseUrlImg'].$articulo->imagen); ?>    
        </div>
        <div class="clear"></div>
        
        <!--fin caja noticia-->
    </div>
    <!--fin contenedor central-->
    <div class="clear"></div>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'comentario-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>
        <div class="row-comnent">
            <?php echo CHtml::hiddenField($articulo->articulo_id, $articulo->articulo_id); ?>
            <?php echo CHtml::label('Comentario', 'texto'); ?>
            <div class="coment">   
            <?php echo $form->textArea($comentario, 'texto', array('rows' => 6, 'cols' => 120)); ?>
            </div>
            <br />   
            <div class="row3 buttons4">
                <?php echo CHtml::submitButton('Enviar'); ?>
            </div>
            <div class="clear"></div>
        </div>
    <?php $this->endWidget(); ?>
    
            <?php foreach ($listComentarios as $item){ ?>
          <div class="caja-com-noti">
              <div class="c-img">
            <?php echo CHtml::image(Yii::app()->params['baseUrlImg'].$item->usuario->imagen,'Perfil',array('class'=>'tu2')); ?>            
        </div>
        <div class="c-name">
        <h3><?php echo ucwords(Yii::app()->aesManager->decrypt($item->usuario->nombre)).' '.ucwords(Yii::app()->aesManager->decrypt($item->usuario->apellido_paterno)); ?></h3><br />
             
            <p><?php echo 'Area '.ucwords($item->usuario->area->nombre); ?></p>
            </div> 
            <div class="clear"></div>
             <div class="text">
                  <p class="fecha"><?php echo $item->fecha_creacion; ?></p>
                  <p class="cuerpo"><?php echo $item->texto; ?></p>
              </div>            
          </div>
          <!--fin contenedor central-->
          <div class="clear"></div>
            <?php } ?>
</div>