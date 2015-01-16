<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="es" />        
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <!--header-->
        <div class="header">
            <?php echo CHtml::link('', array('/home'), array('class' => 'logo')); ?>          

            <?php
            $sesion = Yii::app()->user->getId();
            if ($sesion != '') {
                ?> 
                <ul class="secundario">               
                    <li class="perfil">
                        <?php echo CHtml::link('', array('/usuario/' . Yii::app()->user->id), array('title' => 'Perfil')); ?>
                    </li>
                    <li class="logout">
                        <?php echo CHtml::link('Cerrar sesión', array('/site/logout'), array('title' => 'Cerrar sesión')); ?>
                    </li>                           
                </ul>
            <?php } ?>

            <!--fin header-->
            <div class="clear"></div>
        </div>

        <!--navegación-->
        <?php if (!Yii::app()->user->isGuest) { ?>
            <div class="nav">


                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions' => array(
                        'class' => 'principal degrade',
                    ),
                    'items' => array(
                        array('label' => '', 'url' => array('/home'), 'itemOptions' => array('class' => 'home')),
                        array('label' => 'Jugar', 'url' => array('/jugar/final'), 'active' => Yii::app()->controller->id == 'jugar'),
                        array('label' => 'Ranking', 'url' => array('/ranking'), 'active' => Yii::app()->controller->id == 'ranking'),
                        array('label' => 'Galeria', 'url' => array('/galeria'), 'active' => Yii::app()->controller->id == 'galeria'),
                        array('label' => 'Noticias', 'url' => array('/noticia'), 'active' => Yii::app()->controller->id == 'noticia'),
                        array('label' => 'Premios', 'url' => array('/premio'), 'active' => Yii::app()->controller->id == 'premio'),
                        array('label' => 'Calendario', 'url' => array('/calendario'), 'active' => Yii::app()->controller->id == 'calendario'),
                        array('label' => 'Reglamento', 'url' => 'http://storage.googleapis.com/mundialero2014/download/bases_mundialero_2014_' . Yii::app()->session['project'] . '.pdf', 'linkOptions' => array('target' => '_blank'), 'itemOptions' => array('class' => 'regla'), 'active' => Yii::app()->controller->id == 'reglamento'),
                    ),
                ));
                ?>           
                <!--fin navegación-->
                <div class="clear"></div>
            </div>
        <?php } ?>    

        <div class="cont-central">
            <?php echo $content; ?>
        </div>

        <!--footer-->
        <div class="pie">
            <div class="galeria"></div>
            <div class="cajas">
                <div class="caja-marca-1">

                </div>
                <div class="caja-marca-2">

                </div>
                <div class="caja-marca-3">

                </div>

                <div class="clear"></div>
            </div>

            <div class="caja-rayalab">
                <a href="http://www.rayalab.cl" target="_blank">Desarrollado por</a>
            </div>


            <!--fin footer-->
        </div>

        <script type="text/javascript">
            var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
        </script>
        <script type="text/javascript">
            try {
                var pageTracker = _gat._getTracker("UA-44761358-1");
                pageTracker._trackPageview();
            } catch (err) {
            }
        </script>

    </body>
</html>