<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="es" />
        <meta property="og:image" content="<?php echo Yii::app()->params['baseUrl']; ?>/images/logo-mundialero-social.jpg"/>
        <meta property="og:image:width" content="245"/>
        <meta property="og:image:height" content="245"/>
        <meta property="og:title" content="Mundialero"/>
        <meta property="og:description" content="Juego de predicciones del Mundial."/>
        <meta property="og:url" content="http://www.mundialero.cl/"/>
        <meta property="og:site_name" content="Mundialero"/>
        <meta property="og:type" content="website"/>
        <meta name="twitter:card" content="summary_large_image"/>
        <meta name="twitter:site" content="@rayalab"/>
        <meta name="twitter:creator" content="@rayalab"/>
        <meta name="twitter:title" content="Mundialero"/>
        <meta name="twitter:description" content="Juego de predicciones del Mundial."/>
        <meta name="twitter:image:src" content="<?php echo Yii::app()->params['baseUrl']; ?>/images/logo-mundialero-socialjpg"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['baseUrl']; ?>/css/style.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['baseUrl']; ?>/css/style2.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['baseUrl']; ?>/css/slides.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['baseUrl']; ?>/css/idangerous.swiper.css"/>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <!--content-->
        <div class="contenedor">
            <!--header-->
            <div id="header" >

                <div class="logo">

                    <a href="http://www.mundialero.cl/"><img src="<?php echo Yii::app()->params['baseUrl']; ?>/images/logo-mundialero.jpg" width="122" height="106" alt="Mundialero" /></a>

                </div>

                <p class="tagline">Juego de <strong>predicciones del Mundial</strong>.</p>

                <ul>

                    <li><a class="select" href="#slideWrap">Home</a></li>

                    <li><a href="#que-es">&iquest;Qu&eacute; es?</a></li>

                    <li><a href="#clientess">Casos de &eacute;xito</a></li>

                    <li><a href="#footer">Contacto</a></li>

                    <div class="clear"></div>

                </ul>

                <!--fin header-->

                <div class="etiqueta-pro"><a href="http://www.prochile.gob.cl/importadores/seleccion-idiomas/" target="_blank"></a>

                </div>

                <div class="clear"></div>

            </div>

            <!--carrusel-->

            <div id="slideWrap">

                <div id="slide">

                    <div class="device">

                        <a class="arrow-left" href="#"></a> 

                        <a class="arrow-right" href="#"></a>

                        <div class="swiper-container">

                            <div class="swiper-wrapper">

                                <div id="slider1-1" class="swiper-slide"></div>

                                <div id="slider1-2" class="swiper-slide"></div>

                                <div id="slider1-3" class="swiper-slide"></div>

                                <div id="slider1-4" class="swiper-slide"></div>

                            </div>

                        </div>

                        <div class="pagination"></div>

                    </div>

                </div>

                <!--fin carrusel-->

            </div>

            <!--que es-->

            <div id="que-es">

                <div class="caja-ico">

                    <img src="<?php echo Yii::app()->params['baseUrl']; ?>/images/ico-interaccion.jpg" alt="interacción colectiva" /> 

                    <p>Entrégale a tus trabajadores una instancia virtual de <strong>interacción colectiva</strong> en torno a La Roja de todos.</p>

                </div>

                <div class="caja-ico">

                    <img src="<?php echo Yii::app()->params['baseUrl']; ?>/images/ico-ambiente-laboral.jpg" alt="clima laboral" /> 

                    <p>Fortalece el <strong>clima laboral</strong> y la unión entre tus trabajadores aprovechando algo tan transversal como el mundial Brasil 2014.</p>

                </div>

                <div class="caja-ico">

                    <img src="<?php echo Yii::app()->params['baseUrl']; ?>/images/ico-medicion.jpg" alt="resultados transparentes" /> 

                    <p>Premia a tus trabajadores en base a <strong>resultados transparentes</strong>, motivando la participación entre ellos.</p>

                </div>

                <div class="caja-ico">

                    <img src="<?php echo Yii::app()->params['baseUrl']; ?>/images/ico-chat.jpg" alt="chat, ranking por áreas, estadísticas, tabla de posiciones y noticias" /> 

                    <p>Mundialero cuenta con herramientas como <strong>chat, ranking por áreas, estadísticas, tabla de posiciones y noticias</strong> relacionadas con el torneo.</p>

                </div>

                <div class="caja-ico">

                    <img src="<?php echo Yii::app()->params['baseUrl']; ?>/images/ico-multimedia.jpg" alt="herramientas multimedia" /> 

                    <p>Integración con <strong>herramientas multimedia</strong>.</p>

                </div>

                <div class="caja-ico">

                    <img src="<?php echo Yii::app()->params['baseUrl']; ?>/images/ico-amigable.jpg" alt="plataforma amigable, simple y atractiva" /> 

                    <p>Fomenta la unión en tu empresa con una <strong>plataforma amigable, simple y atractiva</strong>.

                    </p>

                </div>

                <!--fin que es-->

                <div class="clear"></div>

            </div>

            <!--clientes-->

            <div id="clientess">

                <img src="<?php echo Yii::app()->params['baseUrl']; ?>/images/clientes-mundialero-2010.jpg" width="955" height="650" alt="Casos de éxito 2010" /> 

                <!--fin clientes-->

            </div>

            <!--prensa-->
            <div class="prensa">
                <div class="tit"></div>
                <div class="btn-ger"><a href="http://www.emb.cl/gerencia/noticia.mvc?nid=20131107w29&ni=empresa-chilena-desarrolla-plataforma-de-interaccion-basada-en-mundial-2014" target="_blank"></a></div>
                <div class="btn-ccl"><a href="http://www.canal-cl.com/19552-Desarrollan-plataforma-de-interaccion-basada-en-el-Mundial-Brasil-2014.html" target="_blank"></a></div>
                <div class="btn-pub"><a href="http://www.publimetrodigital.cl/papeldigital/visor.html?dr=publimetro&pag=20&edic=20131120&mp=52" target="_blank"></a></div>
                <div class="btn-mer"><a href="images/Mundialero-el-mercurio.pdf" target="_blank"></a></div>
                <div class="btn-terra"><a href="http://economia.terra.cl/noticias/noticia.aspx?idNoticia=201312010900_TRR_82851428" target="_blank"></a></div>
                <div class="clear"></div>
                <div class="btn-mostrador"><a href="http://www.elmostradormercados.cl/destacados/los-trabajadores-chilenos-podran-seguir-cada-minuto-del-mundial-de-brasil-2014-desde-la-silla-desde-su-oficina/" target="_blank"></a></div>
                <div class="clear"></div>
                <!--fin prensa-->  
            </div>

            <!--fin content-->    

        </div>

        <!--footer-->

        <div class="footer" id="footer">

            <div class="col980">

                <div id="left" class="fl">

                    <h3 style="margin-top:0">Encuéntranos</h3>

                    <p id="map-pin">Francisco Noguera 200 - Oficina 601<br>Providencia, Chile</p>

                    <span id="telefono">(56 2) 2 406 8600</span>

                    <a id="aCorreo" href="mailto:contacto@rayalab.cl">contacto@rayalab.cl</a>

                    <div id="redes">

                        <h3>Redes Sociales</h3>

                        <a target="blank_" href="https://www.facebook.com/Rayalab" id="fb">facebook</a>

                        <a target="blank_" href="https://twitter.com/RayaLabcl" id="tw">twitter</a>

                        <a target="blank_" href="http://instagram.com/rayalabcl" id="insta">instagram</a>

                    </div>

                </div>

                <p class="fl consulta">Consulta por <strong>precios especiales</strong> 2013.</p>

                <div id="right" class="fr">

                    <form action="#" method="post" id="commentForm">

                        <input id="Nombre" name="Nombre" type="text" class="nombre required" placeholder="¿Cuál es tu nombre?"/>

                        <input id="Apellido" name="Apellido" type="text" class="apellido required" placeholder="¿Cuál es tu apellido?" />

                        <input id="Mail" name="Mail" type="text" class="mail required" placeholder="¿Cuál es tu correo electrónico?" />

                        <input id="Telefono" name="Teléfono" type="text" class="fono required" placeholder="¿Cuál es tu número de teléfono?" />

                        <textarea rows="1" cols="1" class="comment commentGrande required" name="Mensaje" id="Mensaje" placeholder="Escríbenos un mensaje..."></textarea>

                        <input class="btnEnviar fr" name="send" id="send" type="submit" text="Enviar" onclick="Enviar.email(event);" />

                    </form>

                    <div class="confirm"></div>

                </div>

            </div>

            <div class="desa"><span>Desarrollado por</span> <a href="http://rayalab.cl/" target="_blank" title="RayaLab: Laboratorio Creativo"></a></div>

            <!--fin footer-->
            <div class="clearfix"></div>
    </div>

    <!-- JavaScript at the bottom for fast page loading -->

    <!-- scripts concatenated and minified via build script -->
    <script src="<?php echo Yii::app()->params['baseUrl']; ?>/js/static/libs/modernizr-2.5.3.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->params['baseUrl']; ?>/js/static/libs/jquery.scrollTo-1.4.3.1.js"></script>
    <script src="<?php echo Yii::app()->params['baseUrl']; ?>/js/static/libs/jquery.easing.1.3.js"></script>
    <script src="<?php echo Yii::app()->params['baseUrl']; ?>/js/static/libs/idangerous.swiper-2.0.min.js"></script>
    <script src="<?php echo Yii::app()->params['baseUrl']; ?>/js/static/script.js"></script>
    <script src="<?php echo Yii::app()->params['baseUrl']; ?>/js/static/plugins.js"></script>

    <!-- end scripts -->

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