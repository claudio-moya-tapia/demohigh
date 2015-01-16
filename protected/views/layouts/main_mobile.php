<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="es" />        
        <title>MOBILE <?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        
      <!--header-->
        <div class="header">
            <div class="logo"></div>
            <?php 
            $sesion = Yii::app()->user->getId();
            if ($sesion != '')
            {                
                 $this->widget('zii.widgets.CMenu', array(        
                    'htmlOptions' => array(
                        'class'=>'',
                    ),
                    'items' => array(
                        array('label' => '', 'url' => array('/mobile'), 'itemOptions' => array('class' => 'home'),'active'=>Yii::app()->controller->action->id=='index'),                        
                        array('label' => '', 'url' => array('/mobile/ranking'),'itemOptions' => array('class' => 'ranking'),'active'=>Yii::app()->controller->action->id=='ranking'),
                        array('label' => '', 'url' => array('/mobile/noticia'),'itemOptions' => array('class' => 'news'),'active'=>Yii::app()->controller->action->id=='noticia'),                        
                    ),
                ));
            ?> 
            <!--
            <ul>
                <li class="home"><?php echo CHtml::link('', array('/mobile/index'),array('class'=>'home','select'=>Yii::app()->controller->action->id=='index')); ?> </li>
                <li class="ranking"><?php echo CHtml::link('', array('/mobile/ranking'),array('class'=>'ranking','select'=>Yii::app()->controller->action->id=='ranking')); ?> </li>
                <li class="news"><?php echo CHtml::link('', array('/mobile/noticia'),array('class'=>'news','select'=>Yii::app()->controller->action->id=='noticias')); ?> </li>
            </ul>
            -->
            <div class="clear"></div>

                <div class="btn-salir"> <?php echo CHtml::link('Cerrar sesión', array('/site/logout'),array('title'=>'Cerrar sesión')); ?></div>
             <?php } ?>
        <!--fin header-->
        </div>

        <div class="cont-central">
            <?php echo $content; ?>
        </div>
        
     
        <!--footer-->
        <div class="footer">
		<div class="caja"></div>
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
            } catch (err) {}
        </script>

    </body>
</html>