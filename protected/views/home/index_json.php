<?php
/* @var $this HomeController */
/* @var $versus Versus */
$this->pageTitle = Yii::app()->name;
?>

<div id="loadingBox" style="
     width: 110px;
     height: 20px;
     background-color: white;
     position: fixed;
     top: 0px;
     margin-left: 410px;
     font-family: Arial;
     font-size: 12px;
     padding: 10px;
     border-width: 1px;
     border-style: dashed;
     border-color: lightgray;
     font-weight: bold;
     display: none;
     z-index:99999;
     "><img src="images/ajax-loader.gif"> <span id="loadingMsg">Cargando</span></div>

<!--carrusel-->
<div class="rotator">
    <div class="slideshow" id="flavor_2"></div>
    <!--fin carrusel-->
</div>


<!--twitter-->
<div class="cont-tuit degrade">
    <h1>Twitter interno.</h1>
    <div class="caja" id="cajaTwitter"></div>
    <input name="Twitter[texto]" id="Twitter_texto" maxlength="140" value="" />
    <div class="btn-tuit"><a href="#;" id="btnTwitter">Twittear</a></div>
    <div class="ico"></div>
    <div class="clear"></div>
    <!--fin twitter-->
</div>

<div class="clear"></div>

<!--ranking-->

<div class="caja-rank degrade">
        
</div>
    
<!--partidos del dia-->
<div class="cont-pdd degrade"></div>

<!--fin contenedor central-->
<div class="clear"></div>
