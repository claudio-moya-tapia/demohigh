<?php
/* @var $this MobileController */
/* @var $versus Versus */
$this->pageTitle = Yii::app()->name;
?>
<!--partidos del dia-->
<div class="content">
   
    
    <div class="cont-pdd"></div>
    <!--ranking empresa-->
    <div id="rankingContainer"></div>
    
    <div class="cont-noti">
        <h1>Noticias.</h1>
        <?php
        foreach ($listArticulo as $Articulo) {
            ?> 
            <div class="c-noti">
                <div class="ci">
                    <a class="tit" href="mobile/articulo/<?php echo $Articulo->articulo_id; ?>"><?php echo CHtml::image(Yii::app()->params['baseUrlImg'] . $Articulo->imagen); ?> </a>
                </div>
                <div class="ctexto">
                    <a class="tit" href="mobile/articulo/<?php echo $Articulo->articulo_id; ?>"><?php echo $Articulo->titulo; ?></a><br />
                </div>
            <div class="clear"></div>
            </div>
          
            <div class="separador"></div>
          
            <?php
        }
        ?>

        <!--fin contenedor central-->
        <div class="clear"></div>
    </div>
</div>