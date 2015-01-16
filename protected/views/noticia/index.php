<?php
/* @var $Articulo Articulo */
?>

<div class="cont-central">
    <!--migas-->
    <div class="migas">
        <p>Estás en: <?php echo CHtml::link('Home', array('/home')); ?> > Noticias</p>
        <!--fin migas-->
    </div>

    <!--<div class="caja-filtros degrade">
    <p>
    <span><strong>Filtrar por:</strong></span><span><input id="empresa" type="radio" /><label for="empresa">Empresa</label></span><span><input id="admin" type="radio" /><label for="admin">Admin</label></span>
    </p>
    </div>-->
    <?php 
    $i=0;
    foreach($listArticulo as $Articulo){
        
        if($i%2 == 0){
            $mr = 'mr';
        }else{
            $mr = '';
        }
        
        $i++;
    ?>  
        <div class="caja-notis <?php echo $mr; ?>">
            <h1><?php echo $Articulo->titulo; ?></h1>
            <p><?php echo $Articulo->bajada; ?></p>
            <div class="c-img">
                <?php echo CHtml::image(Yii::app()->params['baseUrlImg'].$Articulo->imagen); ?>                
            </div>
            <div class="clear"></div>
            <?php echo CHtml::link('ver noticia completa',array('/noticia/'.$Articulo->articulo_id.'?'.$Articulo->titulo),array('class'=>'a')) ?>
            
        </div>
    
    <?php  
    }    
    ?>

    <!--fin contenedor central-->
    <div class="clear"></div>
</div>