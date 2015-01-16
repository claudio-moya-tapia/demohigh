<style>
/*calendario*/
.calendario { width:984px; height:5500px; margin:0 auto;}
</style>
<div class="cont-central">
    <!--migas-->
    <div class="migas">
        <p>Estás en: <?php echo CHtml::link('Home', array('/home')); ?> > Calendario</p>
        <!--fin migas-->
    </div>

    <h1>* Horarios Zona horaria Chile.</h1>
<div class="calendario">
  <img src="<?php echo Yii::app()->params['baseUrl']?>/images/mundialero-calendar.jpg" alt="Calendario Mundialero" /> 
</div>

 <!--fin contenedor central-->
    <div class="clear"></div>
</div>