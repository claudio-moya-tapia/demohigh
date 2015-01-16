<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="es" />        
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <style>
            .nav .principal li {
                width: 90px;
            }

        </style>
    </head>

    <body>

        <!--header-->
        <div class="header">
            <?php echo CHtml::link('', array('/home'), array('class' => 'logo')); ?>            
            <span class="tag"></span>
            <div class="logo-empresa"></div>
            <!--fin header-->
            <div class="clear"></div>
        </div>

        <!--navegación-->
        <?php if (!Yii::app()->user->isGuest) { ?>
            <div class="nav">

                <div class="clear"></div>
                <?php 
                if (Yii::app()->user->id == 1) {
                    $items = array(
                        array('label' => 'Home', 'url' => array('/adminPanel'), 'itemOptions' => array('class' => 'homeAdmin')),
                        array('label' => 'Analytics', 'url' => array('/adminAnalytics'), 'itemOptions' => array('class' => 'analyticsAdmin'), 'active' => Yii::app()->controller->id == 'adminAnalytics'),
                        array('label' => 'Noticias', 'url' => array('/adminArticulo/admin'), 'itemOptions' => array('class' => 'noticiasAdmin'), 'active' => Yii::app()->controller->id == 'adminArticulo'),
                        array('label' => 'Versus', 'url' => array('/adminVersus/admin'), 'itemOptions' => array('class' => 'versusAdmin'), 'active' => Yii::app()->controller->id == 'adminVersus'),
                        array('label' => 'Premios', 'url' => array('/adminPremio/admin'), 'itemOptions' => array('class' => 'premiosAdmin'), 'active' => Yii::app()->controller->id == 'adminPremio'),
                        array('label' => 'Usuarios', 'url' => array('/adminUsuario/admin'), 'itemOptions' => array('class' => 'usuariosAdmin'), 'active' => Yii::app()->controller->id == 'adminUsuario'),
                        array('label' => 'Twitter', 'url' => array('/adminTwitter/admin'), 'itemOptions' => array('class' => 'twitterAdmin'), 'active' => Yii::app()->controller->id == 'adminTwitter'),
                        array('label' => 'Comentarios', 'url' => array('/adminComentario/admin'), 'itemOptions' => array('class' => 'comentariosAdmin'), 'active' => Yii::app()->controller->id == 'adminComentario'),
                        array('label' => 'Ranking', 'url' => array('/adminRanking'), 'itemOptions' => array('class' => 'rankingAdmin'), 'active' => Yii::app()->controller->id == 'adminRanking'),
                        array('label' => 'Estado Sistema', 'url' => array('/adminEstadoSistema/update/1'), 'itemOptions' => array('class' => 'estadoAdmin'), 'active' => Yii::app()->controller->id == 'adminEstadoSistema'),
                    );
                } else {

                    if (Yii::app()->session['project'] == 'cristal') {

                        $items = array(
                            array('label' => '', 'url' => array('/adminPanel'), 'itemOptions' => array('class' => 'home')),
                            array('label' => 'Analytics', 'url' => array('/adminAnalytics'), 'itemOptions' => array('class' => 'analyticsAdmin'), 'active' => Yii::app()->controller->id == 'adminAnalytics'),
                            array('label' => 'Noticias', 'url' => array('/adminArticulo/admin'), 'active' => Yii::app()->controller->id == 'adminArticulo'),
                            array('label' => 'Premios', 'url' => array('/adminPremio/admin'), 'active' => Yii::app()->controller->id == 'adminPremio'),
                            array('label' => 'Usuarios', 'url' => array('/adminUsuario/admin'), 'active' => Yii::app()->controller->id == 'adminUsuario'),
                            array('label' => 'Comentarios', 'url' => array('/adminComentario/admin'), 'active' => Yii::app()->controller->id == 'adminComentario'),
                            array('label' => 'Ranking', 'url' => array('/adminRanking'), 'active' => Yii::app()->controller->id == 'adminRanking'),
                            array('label' => 'Estado Sistema', 'url' => array('/adminEstadoSistema/update/1'), 'active' => Yii::app()->controller->id == 'adminEstadoSistema'),
                        );
                    } else if (Yii::app()->session['project'] == 'bbva') {

                        $items = array(
                            array('label' => '', 'url' => array('/adminPanel'), 'itemOptions' => array('class' => 'home')),
                            array('label' => 'Analytics', 'url' => array('/adminAnalytics'), 'itemOptions' => array('class' => 'analyticsAdmin'), 'active' => Yii::app()->controller->id == 'adminAnalytics'),
                            array('label' => 'Noticias', 'url' => array('/adminArticulo/admin'), 'itemOptions' => array('class' => 'versusAdmin'), 'itemOptions' => array('class' => 'noticiasAdmin'), 'active' => Yii::app()->controller->id == 'adminArticulo'),
                            array('label' => 'Premios', 'url' => array('/adminPremio/admin'), 'itemOptions' => array('class' => 'premiosAdmin'), 'active' => Yii::app()->controller->id == 'adminPremio'),
                            array('label' => 'Usuarios', 'url' => array('/adminUsuario/admin'), 'itemOptions' => array('class' => 'usuariosAdmin'), 'active' => Yii::app()->controller->id == 'adminUsuario'),
                            array('label' => 'Twitter', 'url' => array('/adminTwitter/admin'), 'itemOptions' => array('class' => 'twitterAdmin'), 'active' => Yii::app()->controller->id == 'adminTwitter'),
                            array('label' => 'Comentarios', 'url' => array('/adminComentario/admin'), 'itemOptions' => array('class' => 'comentariosAdmin'), 'active' => Yii::app()->controller->id == 'adminComentario'),
                            array('label' => 'Ranking', 'url' => array('/adminRanking'), 'itemOptions' => array('class' => 'rankingAdmin'), 'active' => Yii::app()->controller->id == 'adminRanking'),
                            array('label' => 'Estado Sistema', 'url' => array('/adminGaleria/admin'), 'itemOptions' => array('class' => 'galeriaAdmin'), 'active' => Yii::app()->controller->id == 'adminGaleria'),
                            array('label' => 'Galeria', 'url' => array('/adminEstadoSistema/admin'), 'itemOptions' => array('class' => 'estadoAdmin'), 'active' => Yii::app()->controller->id == 'adminEstadoSistema'),
                            );
                    }else {

                        $items = array(
                            array('label' => '', 'url' => array('/adminPanel'), 'itemOptions' => array('class' => 'home')),
                            array('label' => 'Analytics', 'url' => array('/adminAnalytics'), 'itemOptions' => array('class' => 'analyticsAdmin'), 'active' => Yii::app()->controller->id == 'adminAnalytics'),
                            array('label' => 'Noticias', 'url' => array('/adminArticulo/admin'), 'itemOptions' => array('class' => 'versusAdmin'), 'itemOptions' => array('class' => 'noticiasAdmin'), 'active' => Yii::app()->controller->id == 'adminArticulo'),
                            array('label' => 'Premios', 'url' => array('/adminPremio/admin'), 'itemOptions' => array('class' => 'premiosAdmin'), 'active' => Yii::app()->controller->id == 'adminPremio'),
                            array('label' => 'Usuarios', 'url' => array('/adminUsuario/admin'), 'itemOptions' => array('class' => 'usuariosAdmin'), 'active' => Yii::app()->controller->id == 'adminUsuario'),
                            array('label' => 'Twitter', 'url' => array('/adminTwitter/admin'), 'itemOptions' => array('class' => 'twitterAdmin'), 'active' => Yii::app()->controller->id == 'adminTwitter'),
                            array('label' => 'Comentarios', 'url' => array('/adminComentario/admin'), 'itemOptions' => array('class' => 'comentariosAdmin'), 'active' => Yii::app()->controller->id == 'adminComentario'),
                            array('label' => 'Ranking', 'url' => array('/adminRanking'), 'itemOptions' => array('class' => 'rankingAdmin'), 'active' => Yii::app()->controller->id == 'adminRanking'),
                            array('label' => 'Estado Sistema', 'url' => array('/adminEstadoSistema/update/1'), 'itemOptions' => array('class' => 'estadoAdmin'), 'active' => Yii::app()->controller->id == 'adminEstadoSistema'),
                        );
                    }
                }

                $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions' => array(
                        'class' => 'principal degrade',
                    ),
                    'items' => $items
                ));
                ?>           
                <!--fin navegación-->
                <div class="clear"></div>
            </div>
        <?php } ?>    

        <div class="cont-central">

            <!--migas-->               
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- migas -->
            <?php endif ?>

            <?php echo $content; ?>
        </div>

        <!--footer-->
        <div class="pie">
            <div class="galeria"></div>
            <div class="cajas">
                <div class="caja-marca">
                    <?php echo CHtml::image(Yii::app()->params['baseUrl'] . '/images/rayalab/logo-empresa-footer.png', 'Rayalab'); ?>                    
                </div>
                <div class="caja-marca">
                    <?php echo CHtml::image(Yii::app()->params['baseUrl'] . '/images/rayalab/logo-empresa-footer.png', 'Rayalab'); ?>                    
                </div>
                <div class="caja-rayalab">
                    <a href="http://www.rayalab.cl" target="_blank">Desarrollado por</a>
                </div>
                <div class="clear"></div>
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