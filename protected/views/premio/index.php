<?php /* @var $premio Premio */ ?>
<div class="cont-central">
    <!--migas-->
    <div class="migas">
        <p>Estás en: <?php echo CHtml::link('Home', array('/home')); ?> > Premios</p>
        <!--fin migas-->
    </div>
    <?php foreach ($listPremio as $premio) { ?>
        <!--caja premio-->
        <div class="caja-premios mr20">
            <h1><?php echo $premio->titulo; ?></h1>
            <div class="c-img">
                <?php echo CHtml::image(Yii::app()->params['baseUrlImg'] . $premio->imagen); ?>                  
            </div>
            <div>
                <?php echo $premio->texto; ?>
            </div>
            <!--fin caja premio-->
        </div>       
    <?php } ?>
        
     <div class="caja-premios-2">
        <div class="c1"></div>
        <div class="c2"></div>
        <div class="c3"></div>
    </div>
    <!--fin contenedor central-->
    <div class="clear"></div>
</div>