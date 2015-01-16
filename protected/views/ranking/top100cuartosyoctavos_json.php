<?php
/* @var $usuario Usuario */
?>

<div class="cont-central">
    <!--migas-->
    <div class="migas">
        <p>Estás en: <?php echo CHtml::link('Home', array('/home')); ?> > <?php echo CHtml::link('Ranking', array('/ranking'));?> > TOP 100</p>        
        <!--fin migas-->
    </div>

    <h1>TOP 100 Ranking Segunda Fase por UEN</h1>
    
    <div id="rankingContainer"></div>

    <!--fin contenedor central-->
    <div class="clear"></div>
</div>