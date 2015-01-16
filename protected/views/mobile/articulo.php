<?php
/* @var $this MobileController */
/* @var $articulo Articulo */
$this->pageTitle = Yii::app()->name;
?>
<!--partidos del dia-->
<div class="content">
   
    <div class="cont-noti">
        <h1>Noticias.</h1>
        <div class="c-noti">
            <div class="ci">
                <?php echo CHtml::image(Yii::app()->params['baseUrlImg'].$articulo->imagen); ?> 
            </div>
            <div class="texto">
                <span class="tit" ><?php echo $articulo->titulo; ?></span><br />
                <span class="text" ><?php echo $articulo->bajada; ?></span><br />
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>