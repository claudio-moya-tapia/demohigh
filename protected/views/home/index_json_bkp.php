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
<div class="cont-pdd degrade">
    <h1>Próximos partidos</h1>

    <div class="par partidos-dia" id="versus_id_1" style="display: none">
        <input type="hidden" value="2014-06-12 16:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Brasil vs. Croacia</p>
        <p class="hr">
            12 de Junio a las 16:00horas                </p>
        <img class="img1" src="images/rayalab/ban-brasil-big.jpg" alt="Brasil">        

        <span>0</span> 
        <span>-</span>
        <span>0</span>         
        <img class="img2" src="images/rayalab/ban-croacia-big.jpg" alt="Croacia">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_2" style="display: none">
        <input type="hidden" value="2014-06-13 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">México vs. Camerún</p>
        <p class="hr">
            13 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-mexico-big.jpg" alt="México">        

        <span>1</span> 
        <span>-</span>
        <span>2</span>         
        <img class="img2" src="images/rayalab/ban-camerun-big.jpg" alt="Camerún">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_3" style="display: none">
        <input type="hidden" value="2014-06-13 15:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">España vs. Holanda</p>
        <p class="hr">
            13 de Junio a las 15:00horas                </p>
        <img class="img1" src="images/rayalab/ban-espana-big.jpg" alt="España">        

        <span>1</span> 
        <span>-</span>
        <span>0</span>         
        <img class="img2" src="images/rayalab/ban-holanda-big.jpg" alt="Holanda">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_4" style="display: none">
        <input type="hidden" value="2014-06-13 18:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Chile vs. Australia</p>
        <p class="hr">
            13 de Junio a las 18:00horas                </p>
        <img class="img1" src="images/rayalab/ban-chile-big.jpg" alt="Chile">        

        <span>2</span> 
        <span>-</span>
        <span>0</span>         
        <img class="img2" src="images/rayalab/ban-australia-big.jpg" alt="Australia">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_5" style="display: none">
        <input type="hidden" value="2014-06-14 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Colombia vs. Grecia</p>
        <p class="hr">
            14 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-colombia-big.jpg" alt="Colombia">        

        <span>2</span> 
        <span>-</span>
        <span>1</span>         
        <img class="img2" src="images/rayalab/ban-grecia-big.jpg" alt="Grecia">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_7" style="display: none">
        <input type="hidden" value="2014-06-14 15:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Uruguay vs. Costa Rica</p>
        <p class="hr">
            14 de Junio a las 15:00horas                </p>
        <img class="img1" src="images/rayalab/ban-uruguay-big.jpg" alt="Uruguay">        

        <input id="PrediccionA_7" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_7" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-costa-rica-big.jpg" alt="Costa Rica">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_8" style="display: none">
        <input type="hidden" value="2014-06-14 18:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Inglaterra vs. Italia</p>
        <p class="hr">
            14 de Junio a las 18:00horas                </p>
        <img class="img1" src="images/rayalab/ban-inglaterra-big.jpg" alt="Inglaterra">        

        <input id="PrediccionA_8" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_8" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-italia-big.jpg" alt="Italia">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_6" style="display: none">
        <input type="hidden" value="2014-06-14 21:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Costa de Marfil vs. Japón</p>
        <p class="hr">
            14 de Junio a las 21:00horas                </p>
        <img class="img1" src="images/rayalab/ban-costa-de-marfil-big.jpg" alt="Costa de Marfil">        

        <span>8</span> 
        <span>-</span>
        <span>5</span>         
        <img class="img2" src="images/rayalab/ban-japon-big.jpg" alt="Japón">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_9" style="display: none">
        <input type="hidden" value="2014-06-15 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Suiza vs. Ecuador</p>
        <p class="hr">
            15 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-suiza-big.jpg" alt="Suiza">        

        <input id="PrediccionA_9" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_9" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-ecuador-big.jpg" alt="Ecuador">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_10" style="display: none">
        <input type="hidden" value="2014-06-15 15:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Francia vs. Honduras</p>
        <p class="hr">
            15 de Junio a las 15:00horas                </p>
        <img class="img1" src="images/rayalab/ban-francia-big.jpg" alt="Francia">        

        <input id="PrediccionA_10" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_10" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-honduras-big.jpg" alt="Honduras">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_11" style="display: none">
        <input type="hidden" value="2014-06-15 18:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Argentina vs. Bosnia Herzegovina</p>
        <p class="hr">
            15 de Junio a las 18:00horas                </p>
        <img class="img1" src="images/rayalab/ban-argentina-big.jpg" alt="Argentina">        

        <input id="PrediccionA_11" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_11" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-bosnia-big.jpg" alt="Bosnia Herzegovina">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_13" style="display: none">
        <input type="hidden" value="2014-06-16 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Alemania vs. Portugal</p>
        <p class="hr">
            16 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-alemania-big.jpg" alt="Alemania">        

        <input id="PrediccionA_13" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_13" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-portugal-big.jpg" alt="Portugal">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_12" style="display: none">
        <input type="hidden" value="2014-06-16 15:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Irán vs. Nigeria</p>
        <p class="hr">
            16 de Junio a las 15:00horas                </p>
        <img class="img1" src="images/rayalab/ban-iran-big.jpg" alt="Irán">        

        <input id="PrediccionA_12" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_12" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-nigeria-big.jpg" alt="Nigeria">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_14" style="display: none">
        <input type="hidden" value="2014-06-16 18:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Ghana vs. Estados Unidos</p>
        <p class="hr">
            16 de Junio a las 18:00horas                </p>
        <img class="img1" src="images/rayalab/ban-ghana-big.jpg" alt="Ghana">        

        <input id="PrediccionA_14" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_14" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-usa-big.jpg" alt="Estados Unidos">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_15" style="display: none">
        <input type="hidden" value="2014-06-17 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Bélgica vs. Argelia</p>
        <p class="hr">
            17 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-belgica-big.jpg" alt="Bélgica">        

        <input id="PrediccionA_15" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_15" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-argelia-big.jpg" alt="Argelia">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_17" style="display: none">
        <input type="hidden" value="2014-06-17 15:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Brasil vs. México</p>
        <p class="hr">
            17 de Junio a las 15:00horas                </p>
        <img class="img1" src="images/rayalab/ban-brasil-big.jpg" alt="Brasil">        

        <input id="PrediccionA_17" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_17" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-mexico-big.jpg" alt="México">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_16" style="display: none">
        <input type="hidden" value="2014-06-17 18:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Rusia vs. Corea del Sur</p>
        <p class="hr">
            17 de Junio a las 18:00horas                </p>
        <img class="img1" src="images/rayalab/ban-rusia-big.jpg" alt="Rusia">        

        <input id="PrediccionA_16" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_16" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-korea-big.jpg" alt="Corea del Sur">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_20" style="display: none">
        <input type="hidden" value="2014-06-18 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Australia vs. Holanda</p>
        <p class="hr">
            18 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-australia-big.jpg" alt="Australia">        

        <input id="PrediccionA_20" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_20" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-holanda-big.jpg" alt="Holanda">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_19" style="display: none">
        <input type="hidden" value="2014-06-18 15:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">España vs. Chile</p>
        <p class="hr">
            18 de Junio a las 15:00horas                </p>
        <img class="img1" src="images/rayalab/ban-espana-big.jpg" alt="España">        

        <input id="PrediccionA_19" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_19" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-chile-big.jpg" alt="Chile">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_18" style="display: none">
        <input type="hidden" value="2014-06-18 18:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Camerún vs. Croacia</p>
        <p class="hr">
            18 de Junio a las 18:00horas                </p>
        <img class="img1" src="images/rayalab/ban-camerun-big.jpg" alt="Camerún">        

        <input id="PrediccionA_18" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_18" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-croacia-big.jpg" alt="Croacia">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_21" style="display: none">
        <input type="hidden" value="2014-06-19 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Colombia vs. Costa de Marfil</p>
        <p class="hr">
            19 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-colombia-big.jpg" alt="Colombia">        

        <input id="PrediccionA_21" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_21" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-costa-de-marfil-big.jpg" alt="Costa de Marfil">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_23" style="display: none">
        <input type="hidden" value="2014-06-19 15:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Uruguay vs. Inglaterra</p>
        <p class="hr">
            19 de Junio a las 15:00horas                </p>
        <img class="img1" src="images/rayalab/ban-uruguay-big.jpg" alt="Uruguay">        

        <input id="PrediccionA_23" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_23" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-inglaterra-big.jpg" alt="Inglaterra">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_22" style="display: none">
        <input type="hidden" value="2014-06-19 18:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Japón vs. Grecia</p>
        <p class="hr">
            19 de Junio a las 18:00horas                </p>
        <img class="img1" src="images/rayalab/ban-japon-big.jpg" alt="Japón">        

        <input id="PrediccionA_22" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_22" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-grecia-big.jpg" alt="Grecia">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_24" style="display: none">
        <input type="hidden" value="2014-06-20 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Italia vs. Costa Rica</p>
        <p class="hr">
            20 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-italia-big.jpg" alt="Italia">        

        <input id="PrediccionA_24" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_24" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-costa-rica-big.jpg" alt="Costa Rica">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_25" style="display: none">
        <input type="hidden" value="2014-06-20 15:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Suiza vs. Francia</p>
        <p class="hr">
            20 de Junio a las 15:00horas                </p>
        <img class="img1" src="images/rayalab/ban-suiza-big.jpg" alt="Suiza">        

        <input id="PrediccionA_25" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_25" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-francia-big.jpg" alt="Francia">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_26" style="display: none">
        <input type="hidden" value="2014-06-20 18:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Honduras vs. Ecuador</p>
        <p class="hr">
            20 de Junio a las 18:00horas                </p>
        <img class="img1" src="images/rayalab/ban-honduras-big.jpg" alt="Honduras">        

        <input id="PrediccionA_26" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_26" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-ecuador-big.jpg" alt="Ecuador">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_27" style="display: none">
        <input type="hidden" value="2014-06-21 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Argentina vs. Irán</p>
        <p class="hr">
            21 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-argentina-big.jpg" alt="Argentina">        

        <input id="PrediccionA_27" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_27" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-iran-big.jpg" alt="Irán">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_29" style="display: none">
        <input type="hidden" value="2014-06-21 15:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Alemania vs. Ghana</p>
        <p class="hr">
            21 de Junio a las 15:00horas                </p>
        <img class="img1" src="images/rayalab/ban-alemania-big.jpg" alt="Alemania">        

        <input id="PrediccionA_29" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_29" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-ghana-big.jpg" alt="Ghana">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_28" style="display: none">
        <input type="hidden" value="2014-06-21 18:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Nigeria vs. Bosnia Herzegovina</p>
        <p class="hr">
            21 de Junio a las 18:00horas                </p>
        <img class="img1" src="images/rayalab/ban-nigeria-big.jpg" alt="Nigeria">        

        <input id="PrediccionA_28" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_28" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-bosnia-big.jpg" alt="Bosnia Herzegovina">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_31" style="display: none">
        <input type="hidden" value="2014-06-22 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Bélgica vs. Rusia</p>
        <p class="hr">
            22 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-belgica-big.jpg" alt="Bélgica">        

        <input id="PrediccionA_31" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_31" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-rusia-big.jpg" alt="Rusia">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_32" style="display: none">
        <input type="hidden" value="2014-06-22 15:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Corea del Sur vs. Argelia</p>
        <p class="hr">
            22 de Junio a las 15:00horas                </p>
        <img class="img1" src="images/rayalab/ban-korea-big.jpg" alt="Corea del Sur">        

        <input id="PrediccionA_32" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_32" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-argelia-big.jpg" alt="Argelia">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_30" style="display: none">
        <input type="hidden" value="2014-06-22 18:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Estados Unidos vs. Portugal</p>
        <p class="hr">
            22 de Junio a las 18:00horas                </p>
        <img class="img1" src="images/rayalab/ban-usa-big.jpg" alt="Estados Unidos">        

        <input id="PrediccionA_30" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_30" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-portugal-big.jpg" alt="Portugal">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_36" style="display: none">
        <input type="hidden" value="2014-06-23 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Holanda vs. Chile</p>
        <p class="hr">
            23 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-holanda-big.jpg" alt="Holanda">        

        <input id="PrediccionA_36" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_36" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-chile-big.jpg" alt="Chile">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_35" style="display: none">
        <input type="hidden" value="2014-06-23 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Australia vs. España</p>
        <p class="hr">
            23 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-australia-big.jpg" alt="Australia">        

        <input id="PrediccionA_35" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_35" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-espana-big.jpg" alt="España">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_34" style="display: none">
        <input type="hidden" value="2014-06-23 16:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Croacia vs. México</p>
        <p class="hr">
            23 de Junio a las 16:00horas                </p>
        <img class="img1" src="images/rayalab/ban-croacia-big.jpg" alt="Croacia">        

        <input id="PrediccionA_34" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_34" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-mexico-big.jpg" alt="México">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_33" style="display: none">
        <input type="hidden" value="2014-06-23 16:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Camerún vs. Brasil</p>
        <p class="hr">
            23 de Junio a las 16:00horas                </p>
        <img class="img1" src="images/rayalab/ban-camerun-big.jpg" alt="Camerún">        

        <input id="PrediccionA_33" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_33" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-brasil-big.jpg" alt="Brasil">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_39" style="display: none">
        <input type="hidden" value="2014-06-24 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Italia vs. Uruguay</p>
        <p class="hr">
            24 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-italia-big.jpg" alt="Italia">        

        <input id="PrediccionA_39" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_39" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-uruguay-big.jpg" alt="Uruguay">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_40" style="display: none">
        <input type="hidden" value="2014-06-24 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Costa Rica vs. Inglaterra</p>
        <p class="hr">
            24 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-costa-rica-big.jpg" alt="Costa Rica">        

        <input id="PrediccionA_40" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_40" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-inglaterra-big.jpg" alt="Inglaterra">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_37" style="display: none">
        <input type="hidden" value="2014-06-24 16:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Japón vs. Colombia</p>
        <p class="hr">
            24 de Junio a las 16:00horas                </p>
        <img class="img1" src="images/rayalab/ban-japon-big.jpg" alt="Japón">        

        <input id="PrediccionA_37" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_37" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-colombia-big.jpg" alt="Colombia">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_38" style="display: none">
        <input type="hidden" value="2014-06-24 16:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Grecia vs. Costa de Marfil</p>
        <p class="hr">
            24 de Junio a las 16:00horas                </p>
        <img class="img1" src="images/rayalab/ban-grecia-big.jpg" alt="Grecia">        

        <input id="PrediccionA_38" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_38" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-costa-de-marfil-big.jpg" alt="Costa de Marfil">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_44" style="display: none">
        <input type="hidden" value="2014-06-25 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Bosnia Herzegovina vs. Irán</p>
        <p class="hr">
            25 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-bosnia-big.jpg" alt="Bosnia Herzegovina">        

        <input id="PrediccionA_44" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_44" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-iran-big.jpg" alt="Irán">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_43" style="display: none">
        <input type="hidden" value="2014-06-25 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Nigeria vs. Argentina</p>
        <p class="hr">
            25 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-nigeria-big.jpg" alt="Nigeria">        

        <input id="PrediccionA_43" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_43" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-argentina-big.jpg" alt="Argentina">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_42" style="display: none">
        <input type="hidden" value="2014-06-25 16:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Ecuador vs. Francia</p>
        <p class="hr">
            25 de Junio a las 16:00horas                </p>
        <img class="img1" src="images/rayalab/ban-ecuador-big.jpg" alt="Ecuador">        

        <input id="PrediccionA_42" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_42" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-francia-big.jpg" alt="Francia">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_41" style="display: none">
        <input type="hidden" value="2014-06-25 16:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Honduras vs. Suiza</p>
        <p class="hr">
            25 de Junio a las 16:00horas                </p>
        <img class="img1" src="images/rayalab/ban-honduras-big.jpg" alt="Honduras">        

        <input id="PrediccionA_41" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_41" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-suiza-big.jpg" alt="Suiza">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_45" style="display: none">
        <input type="hidden" value="2014-06-26 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Estados Unidos vs. Alemania</p>
        <p class="hr">
            26 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-usa-big.jpg" alt="Estados Unidos">        

        <input id="PrediccionA_45" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_45" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-alemania-big.jpg" alt="Alemania">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_46" style="display: none">
        <input type="hidden" value="2014-06-26 12:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Portugal vs. Ghana</p>
        <p class="hr">
            26 de Junio a las 12:00horas                </p>
        <img class="img1" src="images/rayalab/ban-portugal-big.jpg" alt="Portugal">        

        <input id="PrediccionA_46" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_46" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-ghana-big.jpg" alt="Ghana">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_47" style="display: none">
        <input type="hidden" value="2014-06-26 16:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Corea del Sur vs. Bélgica</p>
        <p class="hr">
            26 de Junio a las 16:00horas                </p>
        <img class="img1" src="images/rayalab/ban-korea-big.jpg" alt="Corea del Sur">        

        <input id="PrediccionA_47" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_47" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-belgica-big.jpg" alt="Bélgica">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>
    <div class="par partidos-dia" id="versus_id_48" style="display: none">
        <input type="hidden" value="2014-06-26 16:00:00" name="versus_fecha" id="versus_fecha">                <p class="tit">Argelia vs. Rusia</p>
        <p class="hr">
            26 de Junio a las 16:00horas                </p>
        <img class="img1" src="images/rayalab/ban-argelia-big.jpg" alt="Argelia">        

        <input id="PrediccionA_48" maxlength="2" type="text" value="" name="PrediccionA[]"> 
        <span>-</span>
        <input id="PrediccionB_48" maxlength="2" type="text" value="" name="PrediccionB[]">         
        <img class="img2" src="images/rayalab/ban-rusia-big.jpg" alt="Rusia">        
        <div class="clear"></div>
        <table cellpadding="0" cellspacing="0" style="display:none">
            <tbody><tr>
                    <th>0%</th>
                    <th>0%</th>
                    <th>0%</th>
                </tr>
                <tr>
                    <td class="td1" width="5%"></td>
                    <td class="td2" width="0%"></td>
                    <td class="td3" width="5%"></td>
                </tr>
            </tbody></table>
    </div>

    <?php echo CHtml::link('Ir a Calendario', array('/calendario')); ?>    
    <div class="ico"></div>
    <!--fin partidos del dia-->
    <div class="clear"></div>
</div>

<!--fin contenedor central-->
<div class="clear"></div>
