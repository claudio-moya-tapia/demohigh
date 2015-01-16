<?php
/* @var $Galeria galeria */
?>

<div id="page">
    <div id="container">
        <div class="row3">
            <div class="btn-like"><input type="button" id="ajaxMegusta" value="" ></div>
            <div id="titulo"></div>
        </div>
        <div id="gallery" class="content">
            <div id="controls" class="controls"></div>
            <div class="slideshow-container">
                <div id="loading" class="loader"></div>
                <div id="slideshow" class="slideshow">
                    
                </div>
            </div>
            <div id="caption" class="caption-container"></div>
        </div>
        <div id="thumbs" class="navigation">
            <ul class="thumbs noscript">
                <?php 
                foreach($listGaleria as $Galeria){                    
                    $urlImg = Yii::app()->params['baseUrlImg'].$Galeria->imagen;
                ?> 
                <li>
                    <a class="thumb" name="<?php echo $Galeria->galeria_id?>" href="<?php echo $urlImg ?>" title="<?php echo $Galeria->titulo?>">
                        <?php echo CHtml::image(Yii::app()->params['baseUrlImg'].$Galeria->imagen); ?>
                    </a>
                </li>
                <?php 
                     }
                    ?> 
            </ul>
        </div>
        <div style="clear: both;"></div>
    </div>
</div>
