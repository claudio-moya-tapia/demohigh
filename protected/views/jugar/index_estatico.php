<?php
/* @var $this JugarController */
/* @var $versus Versus */
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
    "><img src="images/ajax-loader.gif"> <span id="loadingMsg">Cargando</span></div>

<!--migas-->
<div class="migas">
    <p>Estás en: <a href="home">Home</a> > Jugar</p>
    <!--fin migas-->
</div>

<h1>Las predicciones quedan grabadas automáticamente al ser ingresadas.</h1>
<div class="btn-crear">
    <?php 
    if(Yii::app()->session['project'] == 'bancochile'){
        echo CHtml::link('Guardar', array('#'), array('id'=>'botonGuardarPredicciones')); 
    }    
    ?>
</div>


<ul class="tabs">
    <li class="degrade select"><?php echo CHtml::link('Fase de grupos', array('/jugar'), array('class' => 'degrade', 'select' => Yii::app()->controller->action->id == 'index')); ?> </li>
    <li class="degrade"><?php echo CHtml::link('4tos y 8vos de final', array('/jugar/cuartosOctavos'), array('class' => 'degrade', 'select' => Yii::app()->controller->action->id == 'cuartosoctavos')); ?> </li>
    <li class="degrade "><?php echo CHtml::link('Fase final', array('/jugar/final'), array('class' => 'degrade', 'select' => Yii::app()->controller->action->id == 'final')); ?> </li></li>
<!--fin tabs-->
</ul>



<!--
<ul class="tabs">
        <li class="degrade select"><?php echo CHtml::link('Fase de grupos', array('/jugar'),array('class'=>'degrade','select'=>Yii::app()->controller->action->id=='index')); ?> </li>
        <li class="degrade"><?php echo CHtml::link('4tos y 8vos de final', array('/jugar/cuartosoctavos'),array('class'=>'degrade','select'=>Yii::app()->controller->action->id=='cuartosoctavos')); ?> </li>
        <li class="degrade"><?php echo CHtml::link('Fase final', array('/jugar/final'),array('class'=>'degrade','select'=>Yii::app()->controller->action->id=='final')); ?> </li>    
    </ul>
-->

<div class="clear"></div>

<div class="cont-grupos degrade">

    
        <!--tabla grupos-->
        <table class="tabla-grupos" cellpadding="0" cellspacing="0">           
            <tbody><tr>
                <th><p>Grupo A</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="1" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-brasil-grupos.jpg" alt="Brasil">                            
                            <p class="left">Brasil</p>
                            <input id="PrediccionA_1" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_1" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Croacia</p>
                            <img src="images/rayalab/ban-croacia-grupos.jpg" alt="Croacia"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_1"></span>
                        <input id="VersusGanador_1" type="hidden" value="0" name="VersusGanador[]">
                        <input id="ResultadoA_1" type="hidden" value="0" name="ResultadoA[]">
                        <input id="ResultadoB_1" type="hidden" value="0" name="ResultadoB[]">                    
                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_1">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_1"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="2" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-mexico-grupos.jpg" alt="México">                            
                            <p class="left">México</p>
                            <input id="PrediccionA_2" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_2" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Camerún</p>
                            <img src="images/rayalab/ban-camerun-grupos.jpg" alt="Camerún"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_2"></span>
                        <input id="VersusGanador_2" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_2" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_2" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_2">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_2"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="17" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-brasil-grupos.jpg" alt="Brasil">                            
                            <p class="left">Brasil</p>
                            <input id="PrediccionA_17" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_17" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">México</p>
                            <img src="images/rayalab/ban-mexico-grupos.jpg" alt="México"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_17"></span>
                        <input id="VersusGanador_17" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_17" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_17" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_17">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_17"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="18" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-camerun-grupos.jpg" alt="Camerún">                            
                            <p class="left">Camerún</p>
                            <input id="PrediccionA_18" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_18" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Croacia</p>
                            <img src="images/rayalab/ban-croacia-grupos.jpg" alt="Croacia"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_18"></span>
                        <input id="VersusGanador_18" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_18" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_18" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_18">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_18"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="34" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-croacia-grupos.jpg" alt="Croacia">                            
                            <p class="left">Croacia</p>
                            <input id="PrediccionA_34" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_34" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">México</p>
                            <img src="images/rayalab/ban-mexico-grupos.jpg" alt="México"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_34"></span>
                        <input id="VersusGanador_34" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_34" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_34" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_34">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_34"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="33" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-camerun-grupos.jpg" alt="Camerún">                            
                            <p class="left">Camerún</p>
                            <input id="PrediccionA_33" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_33" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Brasil</p>
                            <img src="images/rayalab/ban-brasil-grupos.jpg" alt="Brasil"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_33"></span>
                        <input id="VersusGanador_33" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_33" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_33" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_33">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_33"></div>

                    </td>
                </tr>
                        
            <!--fin tabla grupos-->
        </tbody></table>

        <!--tabla posiciones-->
        <table class="tabla-posiciones" id="tablaPosicionGrupo_1" cellpadding="0" cellspacing="0">
            <tbody><tr>
                <th><p>Tabla de posiciones</p></th>
            <th><p><span>PJ</span></p></th>
            <th><p><span>PG</span></p></th>
            <th><p><span>PE</span></p></th>
            <th><p><span>PP</span></p></th>
            <th><p><span>GF</span></p></th>
            <th><p><span>GC</span></p></th>
            <th><p><span>DIF</span></p></th>
            <th><p><span>PTS</span></p></th>
            </tr>
                            
                            
                            
                            
                        <!--fin tabla posiciones-->
        <tr id="tablaPosicion_3" class="tablaGrupo_1">
                    <td>
                        <img src="images/rayalab/ban-mexico-grupos.jpg" alt="México">                    
                        <p>México</p>
                    </td>
                    <td id="PJ_3">3</td>
                    <td id="PG_3">2</td>
                    <td id="PE_3">1</td>
                    <td id="PP_3">0</td>
                    <td id="GF_3">10</td>
                    <td id="GC_3">5</td>
                    <td id="DIF_3">5</td>
                    <td id="PTS_3">7</td>
                </tr><tr id="tablaPosicion_2" class="tablaGrupo_1">
                    <td>
                        <img src="images/rayalab/ban-croacia-grupos.jpg" alt="Croacia">                    
                        <p>Croacia</p>
                    </td>
                    <td id="PJ_2">3</td>
                    <td id="PG_2">0</td>
                    <td id="PE_2">3</td>
                    <td id="PP_2">0</td>
                    <td id="GF_2">4</td>
                    <td id="GC_2">4</td>
                    <td id="DIF_2">0</td>
                    <td id="PTS_2">3</td>
                </tr><tr id="tablaPosicion_4" class="tablaGrupo_1">
                    <td>
                        <img src="images/rayalab/ban-camerun-grupos.jpg" alt="Camerún">                    
                        <p>Camerún</p>
                    </td>
                    <td id="PJ_4">3</td>
                    <td id="PG_4">0</td>
                    <td id="PE_4">2</td>
                    <td id="PP_4">1</td>
                    <td id="GF_4">6</td>
                    <td id="GC_4">8</td>
                    <td id="DIF_4">-2</td>
                    <td id="PTS_4">2</td>
                </tr><tr id="tablaPosicion_1" class="tablaGrupo_1">
                    <td>
                        <img src="images/rayalab/ban-brasil-grupos.jpg" alt="Brasil">                    
                        <p>Brasil</p>
                    </td>
                    <td id="PJ_1">3</td>
                    <td id="PG_1">0</td>
                    <td id="PE_1">2</td>
                    <td id="PP_1">1</td>
                    <td id="GF_1">5</td>
                    <td id="GC_1">8</td>
                    <td id="DIF_1">-3</td>
                    <td id="PTS_1">2</td>
                </tr></tbody></table>
        <div class="clear"></div>
        <div class="input-total"><input id="grupoPuntosTotal_1" value="Total"></div>
        <!--tabla grupos fin -->
    
        <!--tabla grupos-->
        <table class="tabla-grupos" cellpadding="0" cellspacing="0">           
            <tbody><tr>
                <th><p>Grupo B</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="3" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-espana-grupos.jpg" alt="España">                            
                            <p class="left">España</p>
                            <input id="PrediccionA_3" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_3" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Holanda</p>
                            <img src="images/rayalab/ban-holanda-grupos.jpg" alt="Holanda"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_3"></span>
                        <input id="VersusGanador_3" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_3" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_3" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_3">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_3"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="4" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-chile-grupos.jpg" alt="Chile">                            
                            <p class="left">Chile</p>
                            <input id="PrediccionA_4" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_4" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Australia</p>
                            <img src="images/rayalab/ban-australia-grupos.jpg" alt="Australia"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_4"></span>
                        <input id="VersusGanador_4" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_4" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_4" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_4">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_4"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="20" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-australia-grupos.jpg" alt="Australia">                            
                            <p class="left">Australia</p>
                            <input id="PrediccionA_20" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_20" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Holanda</p>
                            <img src="images/rayalab/ban-holanda-grupos.jpg" alt="Holanda"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_20"></span>
                        <input id="VersusGanador_20" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_20" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_20" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_20">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_20"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="19" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-espana-grupos.jpg" alt="España">                            
                            <p class="left">España</p>
                            <input id="PrediccionA_19" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_19" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Chile</p>
                            <img src="images/rayalab/ban-chile-grupos.jpg" alt="Chile"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_19"></span>
                        <input id="VersusGanador_19" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_19" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_19" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_19">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_19"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="36" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-holanda-grupos.jpg" alt="Holanda">                            
                            <p class="left">Holanda</p>
                            <input id="PrediccionA_36" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_36" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Chile</p>
                            <img src="images/rayalab/ban-chile-grupos.jpg" alt="Chile"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_36"></span>
                        <input id="VersusGanador_36" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_36" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_36" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_36">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_36"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="35" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-australia-grupos.jpg" alt="Australia">                            
                            <p class="left">Australia</p>
                            <input id="PrediccionA_35" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_35" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">España</p>
                            <img src="images/rayalab/ban-espana-grupos.jpg" alt="España"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_35"></span>
                        <input id="VersusGanador_35" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_35" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_35" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_35">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_35"></div>

                    </td>
                </tr>
                        
            <!--fin tabla grupos-->
        </tbody></table>

        <!--tabla posiciones-->
        <table class="tabla-posiciones" id="tablaPosicionGrupo_2" cellpadding="0" cellspacing="0">
            <tbody><tr>
                <th><p>Tabla de posiciones</p></th>
            <th><p><span>PJ</span></p></th>
            <th><p><span>PG</span></p></th>
            <th><p><span>PE</span></p></th>
            <th><p><span>PP</span></p></th>
            <th><p><span>GF</span></p></th>
            <th><p><span>GC</span></p></th>
            <th><p><span>DIF</span></p></th>
            <th><p><span>PTS</span></p></th>
            </tr>
                            
                            
                            
                            
                        <!--fin tabla posiciones-->
        <tr id="tablaPosicion_7" class="tablaGrupo_2">
                    <td>
                        <img src="images/rayalab/ban-chile-grupos.jpg" alt="Chile">                    
                        <p>Chile</p>
                    </td>
                    <td id="PJ_7">3</td>
                    <td id="PG_7">2</td>
                    <td id="PE_7">0</td>
                    <td id="PP_7">1</td>
                    <td id="GF_7">13</td>
                    <td id="GC_7">4</td>
                    <td id="DIF_7">9</td>
                    <td id="PTS_7">6</td>
                </tr><tr id="tablaPosicion_6" class="tablaGrupo_2">
                    <td>
                        <img src="images/rayalab/ban-holanda-grupos.jpg" alt="Holanda">                    
                        <p>Holanda</p>
                    </td>
                    <td id="PJ_6">3</td>
                    <td id="PG_6">2</td>
                    <td id="PE_6">0</td>
                    <td id="PP_6">1</td>
                    <td id="GF_6">12</td>
                    <td id="GC_6">7</td>
                    <td id="DIF_6">5</td>
                    <td id="PTS_6">6</td>
                </tr><tr id="tablaPosicion_5" class="tablaGrupo_2">
                    <td>
                        <img src="images/rayalab/ban-espana-grupos.jpg" alt="España">                    
                        <p>España</p>
                    </td>
                    <td id="PJ_5">3</td>
                    <td id="PG_5">2</td>
                    <td id="PE_5">0</td>
                    <td id="PP_5">1</td>
                    <td id="GF_5">11</td>
                    <td id="GC_5">9</td>
                    <td id="DIF_5">2</td>
                    <td id="PTS_5">6</td>
                </tr><tr id="tablaPosicion_8" class="tablaGrupo_2">
                    <td>
                        <img src="images/rayalab/ban-australia-grupos.jpg" alt="Australia">                    
                        <p>Australia</p>
                    </td>
                    <td id="PJ_8">3</td>
                    <td id="PG_8">0</td>
                    <td id="PE_8">0</td>
                    <td id="PP_8">3</td>
                    <td id="GF_8">2</td>
                    <td id="GC_8">18</td>
                    <td id="DIF_8">-16</td>
                    <td id="PTS_8">0</td>
                </tr></tbody></table>
        <div class="clear"></div>
        <div class="input-total"><input id="grupoPuntosTotal_2" value="Total"></div>
        <!--tabla grupos fin -->
    
        <!--tabla grupos-->
        <table class="tabla-grupos" cellpadding="0" cellspacing="0">           
            <tbody><tr>
                <th><p>Grupo C</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="5" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-colombia-grupos.jpg" alt="Colombia">                            
                            <p class="left">Colombia</p>
                            <input id="PrediccionA_5" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_5" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Grecia</p>
                            <img src="images/rayalab/ban-grecia-grupos.jpg" alt="Grecia"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_5"></span>
                        <input id="VersusGanador_5" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_5" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_5" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_5">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_5"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="6" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-costa-de-marfil-grupos.jpg" alt="Costa de Marfil">                            
                            <p class="left">Costa de Marfil</p>
                            <input id="PrediccionA_6" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_6" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Japón</p>
                            <img src="images/rayalab/ban-japon-grupos.jpg" alt="Japón"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_6"></span>
                        <input id="VersusGanador_6" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_6" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_6" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_6">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_6"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="21" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-colombia-grupos.jpg" alt="Colombia">                            
                            <p class="left">Colombia</p>
                            <input id="PrediccionA_21" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_21" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Costa de Marfil</p>
                            <img src="images/rayalab/ban-costa-de-marfil-grupos.jpg" alt="Costa de Marfil"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_21"></span>
                        <input id="VersusGanador_21" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_21" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_21" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_21">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_21"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="22" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-japon-grupos.jpg" alt="Japón">                            
                            <p class="left">Japón</p>
                            <input id="PrediccionA_22" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_22" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Grecia</p>
                            <img src="images/rayalab/ban-grecia-grupos.jpg" alt="Grecia"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_22"></span>
                        <input id="VersusGanador_22" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_22" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_22" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_22">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_22"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="37" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-japon-grupos.jpg" alt="Japón">                            
                            <p class="left">Japón</p>
                            <input id="PrediccionA_37" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_37" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Colombia</p>
                            <img src="images/rayalab/ban-colombia-grupos.jpg" alt="Colombia"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_37"></span>
                        <input id="VersusGanador_37" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_37" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_37" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_37">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_37"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="38" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-grecia-grupos.jpg" alt="Grecia">                            
                            <p class="left">Grecia</p>
                            <input id="PrediccionA_38" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_38" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Costa de Marfil</p>
                            <img src="images/rayalab/ban-costa-de-marfil-grupos.jpg" alt="Costa de Marfil"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_38"></span>
                        <input id="VersusGanador_38" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_38" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_38" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_38">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_38"></div>

                    </td>
                </tr>
                        
            <!--fin tabla grupos-->
        </tbody></table>

        <!--tabla posiciones-->
        <table class="tabla-posiciones" id="tablaPosicionGrupo_3" cellpadding="0" cellspacing="0">
            <tbody><tr>
                <th><p>Tabla de posiciones</p></th>
            <th><p><span>PJ</span></p></th>
            <th><p><span>PG</span></p></th>
            <th><p><span>PE</span></p></th>
            <th><p><span>PP</span></p></th>
            <th><p><span>GF</span></p></th>
            <th><p><span>GC</span></p></th>
            <th><p><span>DIF</span></p></th>
            <th><p><span>PTS</span></p></th>
            </tr>
                            
                            
                            
                            
                        <!--fin tabla posiciones-->
        <tr id="tablaPosicion_11" class="tablaGrupo_3">
                    <td>
                        <img src="images/rayalab/ban-costa-de-marfil-grupos.jpg" alt="Costa de Marfil">                    
                        <p>Costa de Marfil</p>
                    </td>
                    <td id="PJ_11">1</td>
                    <td id="PG_11">1</td>
                    <td id="PE_11">0</td>
                    <td id="PP_11">0</td>
                    <td id="GF_11">2</td>
                    <td id="GC_11">0</td>
                    <td id="DIF_11">2</td>
                    <td id="PTS_11">3</td>
                </tr><tr id="tablaPosicion_9" class="tablaGrupo_3">
                    <td>
                        <img src="images/rayalab/ban-colombia-grupos.jpg" alt="Colombia">                    
                        <p>Colombia</p>
                    </td>
                    <td id="PJ_9">0</td>
                    <td id="PG_9">0</td>
                    <td id="PE_9">0</td>
                    <td id="PP_9">0</td>
                    <td id="GF_9">0</td>
                    <td id="GC_9">0</td>
                    <td id="DIF_9">0</td>
                    <td id="PTS_9">0</td>
                </tr><tr id="tablaPosicion_10" class="tablaGrupo_3">
                    <td>
                        <img src="images/rayalab/ban-grecia-grupos.jpg" alt="Grecia">                    
                        <p>Grecia</p>
                    </td>
                    <td id="PJ_10">0</td>
                    <td id="PG_10">0</td>
                    <td id="PE_10">0</td>
                    <td id="PP_10">0</td>
                    <td id="GF_10">0</td>
                    <td id="GC_10">0</td>
                    <td id="DIF_10">0</td>
                    <td id="PTS_10">0</td>
                </tr><tr id="tablaPosicion_12" class="tablaGrupo_3">
                    <td>
                        <img src="images/rayalab/ban-japon-grupos.jpg" alt="Japón">                    
                        <p>Japón</p>
                    </td>
                    <td id="PJ_12">1</td>
                    <td id="PG_12">0</td>
                    <td id="PE_12">0</td>
                    <td id="PP_12">1</td>
                    <td id="GF_12">0</td>
                    <td id="GC_12">2</td>
                    <td id="DIF_12">-2</td>
                    <td id="PTS_12">0</td>
                </tr></tbody></table>
        <div class="clear"></div>
        <div class="input-total"><input id="grupoPuntosTotal_3" value="Total"></div>
        <!--tabla grupos fin -->
    
        <!--tabla grupos-->
        <table class="tabla-grupos" cellpadding="0" cellspacing="0">           
            <tbody><tr>
                <th><p>Grupo D</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="7" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-uruguay-grupos.jpg" alt="Uruguay">                            
                            <p class="left">Uruguay</p>
                            <input id="PrediccionA_7" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_7" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Costa Rica</p>
                            <img src="images/rayalab/ban-costa-rica-grupos.jpg" alt="Costa Rica"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_7"></span>
                        <input id="VersusGanador_7" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_7" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_7" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_7">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_7"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="8" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-inglaterra-grupos.jpg" alt="Inglaterra">                            
                            <p class="left">Inglaterra</p>
                            <input id="PrediccionA_8" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_8" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Italia</p>
                            <img src="images/rayalab/ban-italia-grupos.jpg" alt="Italia"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_8"></span>
                        <input id="VersusGanador_8" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_8" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_8" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_8">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_8"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="23" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-uruguay-grupos.jpg" alt="Uruguay">                            
                            <p class="left">Uruguay</p>
                            <input id="PrediccionA_23" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_23" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Inglaterra</p>
                            <img src="images/rayalab/ban-inglaterra-grupos.jpg" alt="Inglaterra"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_23"></span>
                        <input id="VersusGanador_23" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_23" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_23" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_23">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_23"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="24" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-italia-grupos.jpg" alt="Italia">                            
                            <p class="left">Italia</p>
                            <input id="PrediccionA_24" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_24" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Costa Rica</p>
                            <img src="images/rayalab/ban-costa-rica-grupos.jpg" alt="Costa Rica"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_24"></span>
                        <input id="VersusGanador_24" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_24" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_24" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_24">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_24"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="39" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-italia-grupos.jpg" alt="Italia">                            
                            <p class="left">Italia</p>
                            <input id="PrediccionA_39" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_39" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Uruguay</p>
                            <img src="images/rayalab/ban-uruguay-grupos.jpg" alt="Uruguay"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_39"></span>
                        <input id="VersusGanador_39" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_39" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_39" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_39">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_39"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="40" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-costa-rica-grupos.jpg" alt="Costa Rica">                            
                            <p class="left">Costa Rica</p>
                            <input id="PrediccionA_40" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_40" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Inglaterra</p>
                            <img src="images/rayalab/ban-inglaterra-grupos.jpg" alt="Inglaterra"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_40"></span>
                        <input id="VersusGanador_40" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_40" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_40" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_40">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_40"></div>

                    </td>
                </tr>
                        
            <!--fin tabla grupos-->
        </tbody></table>

        <!--tabla posiciones-->
        <table class="tabla-posiciones" id="tablaPosicionGrupo_4" cellpadding="0" cellspacing="0">
            <tbody><tr>
                <th><p>Tabla de posiciones</p></th>
            <th><p><span>PJ</span></p></th>
            <th><p><span>PG</span></p></th>
            <th><p><span>PE</span></p></th>
            <th><p><span>PP</span></p></th>
            <th><p><span>GF</span></p></th>
            <th><p><span>GC</span></p></th>
            <th><p><span>DIF</span></p></th>
            <th><p><span>PTS</span></p></th>
            </tr>
                            
                            
                            
                            
                        <!--fin tabla posiciones-->
        <tr id="tablaPosicion_13" class="tablaGrupo_4">
                    <td>
                        <img src="images/rayalab/ban-uruguay-grupos.jpg" alt="Uruguay">                    
                        <p>Uruguay</p>
                    </td>
                    <td id="PJ_13">0</td>
                    <td id="PG_13">0</td>
                    <td id="PE_13">0</td>
                    <td id="PP_13">0</td>
                    <td id="GF_13">0</td>
                    <td id="GC_13">0</td>
                    <td id="DIF_13">0</td>
                    <td id="PTS_13">0</td>
                </tr><tr id="tablaPosicion_14" class="tablaGrupo_4">
                    <td>
                        <img src="images/rayalab/ban-costa-rica-grupos.jpg" alt="Costa Rica">                    
                        <p>Costa Rica</p>
                    </td>
                    <td id="PJ_14">0</td>
                    <td id="PG_14">0</td>
                    <td id="PE_14">0</td>
                    <td id="PP_14">0</td>
                    <td id="GF_14">0</td>
                    <td id="GC_14">0</td>
                    <td id="DIF_14">0</td>
                    <td id="PTS_14">0</td>
                </tr><tr id="tablaPosicion_15" class="tablaGrupo_4">
                    <td>
                        <img src="images/rayalab/ban-inglaterra-grupos.jpg" alt="Inglaterra">                    
                        <p>Inglaterra</p>
                    </td>
                    <td id="PJ_15">0</td>
                    <td id="PG_15">0</td>
                    <td id="PE_15">0</td>
                    <td id="PP_15">0</td>
                    <td id="GF_15">0</td>
                    <td id="GC_15">0</td>
                    <td id="DIF_15">0</td>
                    <td id="PTS_15">0</td>
                </tr><tr id="tablaPosicion_16" class="tablaGrupo_4">
                    <td>
                        <img src="images/rayalab/ban-italia-grupos.jpg" alt="Italia">                    
                        <p>Italia</p>
                    </td>
                    <td id="PJ_16">0</td>
                    <td id="PG_16">0</td>
                    <td id="PE_16">0</td>
                    <td id="PP_16">0</td>
                    <td id="GF_16">0</td>
                    <td id="GC_16">0</td>
                    <td id="DIF_16">0</td>
                    <td id="PTS_16">0</td>
                </tr></tbody></table>
        <div class="clear"></div>
        <div class="input-total"><input id="grupoPuntosTotal_4" value="Total"></div>
        <!--tabla grupos fin -->
    
        <!--tabla grupos-->
        <table class="tabla-grupos" cellpadding="0" cellspacing="0">           
            <tbody><tr>
                <th><p>Grupo E</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="9" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-suiza-grupos.jpg" alt="Suiza">                            
                            <p class="left">Suiza</p>
                            <input id="PrediccionA_9" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_9" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Ecuador</p>
                            <img src="images/rayalab/ban-ecuador-grupos.jpg" alt="Ecuador"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_9"></span>
                        <input id="VersusGanador_9" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_9" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_9" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_9">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_9"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="10" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-francia-grupos.jpg" alt="Francia">                            
                            <p class="left">Francia</p>
                            <input id="PrediccionA_10" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_10" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Honduras</p>
                            <img src="images/rayalab/ban-honduras-grupos.jpg" alt="Honduras"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_10"></span>
                        <input id="VersusGanador_10" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_10" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_10" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_10">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_10"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="25" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-suiza-grupos.jpg" alt="Suiza">                            
                            <p class="left">Suiza</p>
                            <input id="PrediccionA_25" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_25" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Francia</p>
                            <img src="images/rayalab/ban-francia-grupos.jpg" alt="Francia"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_25"></span>
                        <input id="VersusGanador_25" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_25" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_25" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_25">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_25"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="26" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-honduras-grupos.jpg" alt="Honduras">                            
                            <p class="left">Honduras</p>
                            <input id="PrediccionA_26" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_26" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Ecuador</p>
                            <img src="images/rayalab/ban-ecuador-grupos.jpg" alt="Ecuador"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_26"></span>
                        <input id="VersusGanador_26" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_26" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_26" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_26">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_26"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="41" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-honduras-grupos.jpg" alt="Honduras">                            
                            <p class="left">Honduras</p>
                            <input id="PrediccionA_41" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_41" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Suiza</p>
                            <img src="images/rayalab/ban-suiza-grupos.jpg" alt="Suiza"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_41"></span>
                        <input id="VersusGanador_41" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_41" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_41" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_41">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_41"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="42" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-ecuador-grupos.jpg" alt="Ecuador">                            
                            <p class="left">Ecuador</p>
                            <input id="PrediccionA_42" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_42" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Francia</p>
                            <img src="images/rayalab/ban-francia-grupos.jpg" alt="Francia"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_42"></span>
                        <input id="VersusGanador_42" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_42" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_42" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_42">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_42"></div>

                    </td>
                </tr>
                        
            <!--fin tabla grupos-->
        </tbody></table>

        <!--tabla posiciones-->
        <table class="tabla-posiciones" id="tablaPosicionGrupo_5" cellpadding="0" cellspacing="0">
            <tbody><tr>
                <th><p>Tabla de posiciones</p></th>
            <th><p><span>PJ</span></p></th>
            <th><p><span>PG</span></p></th>
            <th><p><span>PE</span></p></th>
            <th><p><span>PP</span></p></th>
            <th><p><span>GF</span></p></th>
            <th><p><span>GC</span></p></th>
            <th><p><span>DIF</span></p></th>
            <th><p><span>PTS</span></p></th>
            </tr>
                            
                            
                            
                            
                        <!--fin tabla posiciones-->
        <tr id="tablaPosicion_17" class="tablaGrupo_5">
                    <td>
                        <img src="images/rayalab/ban-suiza-grupos.jpg" alt="Suiza">                    
                        <p>Suiza</p>
                    </td>
                    <td id="PJ_17">0</td>
                    <td id="PG_17">0</td>
                    <td id="PE_17">0</td>
                    <td id="PP_17">0</td>
                    <td id="GF_17">0</td>
                    <td id="GC_17">0</td>
                    <td id="DIF_17">0</td>
                    <td id="PTS_17">0</td>
                </tr><tr id="tablaPosicion_18" class="tablaGrupo_5">
                    <td>
                        <img src="images/rayalab/ban-ecuador-grupos.jpg" alt="Ecuador">                    
                        <p>Ecuador</p>
                    </td>
                    <td id="PJ_18">0</td>
                    <td id="PG_18">0</td>
                    <td id="PE_18">0</td>
                    <td id="PP_18">0</td>
                    <td id="GF_18">0</td>
                    <td id="GC_18">0</td>
                    <td id="DIF_18">0</td>
                    <td id="PTS_18">0</td>
                </tr><tr id="tablaPosicion_19" class="tablaGrupo_5">
                    <td>
                        <img src="images/rayalab/ban-francia-grupos.jpg" alt="Francia">                    
                        <p>Francia</p>
                    </td>
                    <td id="PJ_19">0</td>
                    <td id="PG_19">0</td>
                    <td id="PE_19">0</td>
                    <td id="PP_19">0</td>
                    <td id="GF_19">0</td>
                    <td id="GC_19">0</td>
                    <td id="DIF_19">0</td>
                    <td id="PTS_19">0</td>
                </tr><tr id="tablaPosicion_20" class="tablaGrupo_5">
                    <td>
                        <img src="images/rayalab/ban-honduras-grupos.jpg" alt="Honduras">                    
                        <p>Honduras</p>
                    </td>
                    <td id="PJ_20">0</td>
                    <td id="PG_20">0</td>
                    <td id="PE_20">0</td>
                    <td id="PP_20">0</td>
                    <td id="GF_20">0</td>
                    <td id="GC_20">0</td>
                    <td id="DIF_20">0</td>
                    <td id="PTS_20">0</td>
                </tr></tbody></table>
        <div class="clear"></div>
        <div class="input-total"><input id="grupoPuntosTotal_5" value="Total"></div>
        <!--tabla grupos fin -->
    
        <!--tabla grupos-->
        <table class="tabla-grupos" cellpadding="0" cellspacing="0">           
            <tbody><tr>
                <th><p>Grupo F</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="11" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-argentina-grupos.jpg" alt="Argentina">                            
                            <p class="left">Argentina</p>
                            <input id="PrediccionA_11" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_11" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Bosnia Herzegovina</p>
                            <img src="images/rayalab/ban-bosnia-grupos.jpg" alt="Bosnia Herzegovina"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_11"></span>
                        <input id="VersusGanador_11" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_11" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_11" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_11">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_11"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="12" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-iran-grupos.jpg" alt="Irán">                            
                            <p class="left">Irán</p>
                            <input id="PrediccionA_12" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_12" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Nigeria</p>
                            <img src="images/rayalab/ban-nigeria-grupos.jpg" alt="Nigeria"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_12"></span>
                        <input id="VersusGanador_12" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_12" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_12" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_12">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_12"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="27" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-argentina-grupos.jpg" alt="Argentina">                            
                            <p class="left">Argentina</p>
                            <input id="PrediccionA_27" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_27" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Irán</p>
                            <img src="images/rayalab/ban-iran-grupos.jpg" alt="Irán"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_27"></span>
                        <input id="VersusGanador_27" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_27" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_27" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_27">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_27"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="28" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-nigeria-grupos.jpg" alt="Nigeria">                            
                            <p class="left">Nigeria</p>
                            <input id="PrediccionA_28" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_28" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Bosnia Herzegovina</p>
                            <img src="images/rayalab/ban-bosnia-grupos.jpg" alt="Bosnia Herzegovina"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_28"></span>
                        <input id="VersusGanador_28" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_28" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_28" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_28">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_28"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="43" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-nigeria-grupos.jpg" alt="Nigeria">                            
                            <p class="left">Nigeria</p>
                            <input id="PrediccionA_43" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_43" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Argentina</p>
                            <img src="images/rayalab/ban-argentina-grupos.jpg" alt="Argentina"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_43"></span>
                        <input id="VersusGanador_43" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_43" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_43" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_43">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_43"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="44" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-bosnia-grupos.jpg" alt="Bosnia Herzegovina">                            
                            <p class="left">Bosnia Herzegovina</p>
                            <input id="PrediccionA_44" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_44" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Irán</p>
                            <img src="images/rayalab/ban-iran-grupos.jpg" alt="Irán"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_44"></span>
                        <input id="VersusGanador_44" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_44" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_44" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_44">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_44"></div>

                    </td>
                </tr>
                        
            <!--fin tabla grupos-->
        </tbody></table>

        <!--tabla posiciones-->
        <table class="tabla-posiciones" id="tablaPosicionGrupo_6" cellpadding="0" cellspacing="0">
            <tbody><tr>
                <th><p>Tabla de posiciones</p></th>
            <th><p><span>PJ</span></p></th>
            <th><p><span>PG</span></p></th>
            <th><p><span>PE</span></p></th>
            <th><p><span>PP</span></p></th>
            <th><p><span>GF</span></p></th>
            <th><p><span>GC</span></p></th>
            <th><p><span>DIF</span></p></th>
            <th><p><span>PTS</span></p></th>
            </tr>
                            
                            
                            
                            
                        <!--fin tabla posiciones-->
        <tr id="tablaPosicion_21" class="tablaGrupo_6">
                    <td>
                        <img src="images/rayalab/ban-argentina-grupos.jpg" alt="Argentina">                    
                        <p>Argentina</p>
                    </td>
                    <td id="PJ_21">0</td>
                    <td id="PG_21">0</td>
                    <td id="PE_21">0</td>
                    <td id="PP_21">0</td>
                    <td id="GF_21">0</td>
                    <td id="GC_21">0</td>
                    <td id="DIF_21">0</td>
                    <td id="PTS_21">0</td>
                </tr><tr id="tablaPosicion_22" class="tablaGrupo_6">
                    <td>
                        <img src="images/rayalab/ban-bosnia-grupos.jpg" alt="Bosnia Herzegovina">                    
                        <p>Bosnia Herzegovina</p>
                    </td>
                    <td id="PJ_22">0</td>
                    <td id="PG_22">0</td>
                    <td id="PE_22">0</td>
                    <td id="PP_22">0</td>
                    <td id="GF_22">0</td>
                    <td id="GC_22">0</td>
                    <td id="DIF_22">0</td>
                    <td id="PTS_22">0</td>
                </tr><tr id="tablaPosicion_23" class="tablaGrupo_6">
                    <td>
                        <img src="images/rayalab/ban-iran-grupos.jpg" alt="Irán">                    
                        <p>Irán</p>
                    </td>
                    <td id="PJ_23">0</td>
                    <td id="PG_23">0</td>
                    <td id="PE_23">0</td>
                    <td id="PP_23">0</td>
                    <td id="GF_23">0</td>
                    <td id="GC_23">0</td>
                    <td id="DIF_23">0</td>
                    <td id="PTS_23">0</td>
                </tr><tr id="tablaPosicion_24" class="tablaGrupo_6">
                    <td>
                        <img src="images/rayalab/ban-nigeria-grupos.jpg" alt="Nigeria">                    
                        <p>Nigeria</p>
                    </td>
                    <td id="PJ_24">0</td>
                    <td id="PG_24">0</td>
                    <td id="PE_24">0</td>
                    <td id="PP_24">0</td>
                    <td id="GF_24">0</td>
                    <td id="GC_24">0</td>
                    <td id="DIF_24">0</td>
                    <td id="PTS_24">0</td>
                </tr></tbody></table>
        <div class="clear"></div>
        <div class="input-total"><input id="grupoPuntosTotal_6" value="Total"></div>
        <!--tabla grupos fin -->
    
        <!--tabla grupos-->
        <table class="tabla-grupos" cellpadding="0" cellspacing="0">           
            <tbody><tr>
                <th><p>Grupo G</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="13" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-alemania-grupos.jpg" alt="Alemania">                            
                            <p class="left">Alemania</p>
                            <input id="PrediccionA_13" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_13" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Portugal</p>
                            <img src="images/rayalab/ban-portugal-grupos.jpg" alt="Portugal"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_13"></span>
                        <input id="VersusGanador_13" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_13" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_13" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_13">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_13"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="14" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-ghana-grupos.jpg" alt="Ghana">                            
                            <p class="left">Ghana</p>
                            <input id="PrediccionA_14" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_14" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Estados Unidos</p>
                            <img src="images/rayalab/ban-usa-grupos.jpg" alt="Estados Unidos"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_14"></span>
                        <input id="VersusGanador_14" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_14" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_14" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_14">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_14"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="29" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-alemania-grupos.jpg" alt="Alemania">                            
                            <p class="left">Alemania</p>
                            <input id="PrediccionA_29" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_29" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Ghana</p>
                            <img src="images/rayalab/ban-ghana-grupos.jpg" alt="Ghana"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_29"></span>
                        <input id="VersusGanador_29" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_29" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_29" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_29">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_29"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="30" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-usa-grupos.jpg" alt="Estados Unidos">                            
                            <p class="left">Estados Unidos</p>
                            <input id="PrediccionA_30" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_30" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Portugal</p>
                            <img src="images/rayalab/ban-portugal-grupos.jpg" alt="Portugal"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_30"></span>
                        <input id="VersusGanador_30" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_30" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_30" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_30">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_30"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="46" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-portugal-grupos.jpg" alt="Portugal">                            
                            <p class="left">Portugal</p>
                            <input id="PrediccionA_46" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_46" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Ghana</p>
                            <img src="images/rayalab/ban-ghana-grupos.jpg" alt="Ghana"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_46"></span>
                        <input id="VersusGanador_46" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_46" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_46" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_46">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_46"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="45" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-usa-grupos.jpg" alt="Estados Unidos">                            
                            <p class="left">Estados Unidos</p>
                            <input id="PrediccionA_45" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_45" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Alemania</p>
                            <img src="images/rayalab/ban-alemania-grupos.jpg" alt="Alemania"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_45"></span>
                        <input id="VersusGanador_45" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_45" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_45" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_45">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_45"></div>

                    </td>
                </tr>
                        
            <!--fin tabla grupos-->
        </tbody></table>

        <!--tabla posiciones-->
        <table class="tabla-posiciones" id="tablaPosicionGrupo_7" cellpadding="0" cellspacing="0">
            <tbody><tr>
                <th><p>Tabla de posiciones</p></th>
            <th><p><span>PJ</span></p></th>
            <th><p><span>PG</span></p></th>
            <th><p><span>PE</span></p></th>
            <th><p><span>PP</span></p></th>
            <th><p><span>GF</span></p></th>
            <th><p><span>GC</span></p></th>
            <th><p><span>DIF</span></p></th>
            <th><p><span>PTS</span></p></th>
            </tr>
                            
                            
                            
                            
                        <!--fin tabla posiciones-->
        <tr id="tablaPosicion_25" class="tablaGrupo_7">
                    <td>
                        <img src="images/rayalab/ban-alemania-grupos.jpg" alt="Alemania">                    
                        <p>Alemania</p>
                    </td>
                    <td id="PJ_25">0</td>
                    <td id="PG_25">0</td>
                    <td id="PE_25">0</td>
                    <td id="PP_25">0</td>
                    <td id="GF_25">0</td>
                    <td id="GC_25">0</td>
                    <td id="DIF_25">0</td>
                    <td id="PTS_25">0</td>
                </tr><tr id="tablaPosicion_26" class="tablaGrupo_7">
                    <td>
                        <img src="images/rayalab/ban-portugal-grupos.jpg" alt="Portugal">                    
                        <p>Portugal</p>
                    </td>
                    <td id="PJ_26">0</td>
                    <td id="PG_26">0</td>
                    <td id="PE_26">0</td>
                    <td id="PP_26">0</td>
                    <td id="GF_26">0</td>
                    <td id="GC_26">0</td>
                    <td id="DIF_26">0</td>
                    <td id="PTS_26">0</td>
                </tr><tr id="tablaPosicion_27" class="tablaGrupo_7">
                    <td>
                        <img src="images/rayalab/ban-ghana-grupos.jpg" alt="Ghana">                    
                        <p>Ghana</p>
                    </td>
                    <td id="PJ_27">0</td>
                    <td id="PG_27">0</td>
                    <td id="PE_27">0</td>
                    <td id="PP_27">0</td>
                    <td id="GF_27">0</td>
                    <td id="GC_27">0</td>
                    <td id="DIF_27">0</td>
                    <td id="PTS_27">0</td>
                </tr><tr id="tablaPosicion_28" class="tablaGrupo_7">
                    <td>
                        <img src="images/rayalab/ban-usa-grupos.jpg" alt="Estados Unidos">                    
                        <p>Estados Unidos</p>
                    </td>
                    <td id="PJ_28">0</td>
                    <td id="PG_28">0</td>
                    <td id="PE_28">0</td>
                    <td id="PP_28">0</td>
                    <td id="GF_28">0</td>
                    <td id="GC_28">0</td>
                    <td id="DIF_28">0</td>
                    <td id="PTS_28">0</td>
                </tr></tbody></table>
        <div class="clear"></div>
        <div class="input-total"><input id="grupoPuntosTotal_7" value="Total"></div>
        <!--tabla grupos fin -->
    
        <!--tabla grupos-->
        <table class="tabla-grupos" cellpadding="0" cellspacing="0">           
            <tbody><tr>
                <th><p>Grupo H</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="15" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-belgica-grupos.jpg" alt="Bélgica">                            
                            <p class="left">Bélgica</p>
                            <input id="PrediccionA_15" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_15" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Argelia</p>
                            <img src="images/rayalab/ban-argelia-grupos.jpg" alt="Argelia"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_15"></span>
                        <input id="VersusGanador_15" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_15" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_15" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_15">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_15"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="16" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-rusia-grupos.jpg" alt="Rusia">                            
                            <p class="left">Rusia</p>
                            <input id="PrediccionA_16" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_16" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Corea del Sur</p>
                            <img src="images/rayalab/ban-korea-grupos.jpg" alt="Corea del Sur"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_16"></span>
                        <input id="VersusGanador_16" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_16" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_16" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_16">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_16"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="31" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-belgica-grupos.jpg" alt="Bélgica">                            
                            <p class="left">Bélgica</p>
                            <input id="PrediccionA_31" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_31" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Rusia</p>
                            <img src="images/rayalab/ban-rusia-grupos.jpg" alt="Rusia"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_31"></span>
                        <input id="VersusGanador_31" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_31" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_31" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_31">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_31"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="32" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-korea-grupos.jpg" alt="Corea del Sur">                            
                            <p class="left">Corea del Sur</p>
                            <input id="PrediccionA_32" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_32" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Argelia</p>
                            <img src="images/rayalab/ban-argelia-grupos.jpg" alt="Argelia"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_32"></span>
                        <input id="VersusGanador_32" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_32" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_32" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_32">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_32"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="47" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-korea-grupos.jpg" alt="Corea del Sur">                            
                            <p class="left">Corea del Sur</p>
                            <input id="PrediccionA_47" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_47" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Bélgica</p>
                            <img src="images/rayalab/ban-belgica-grupos.jpg" alt="Bélgica"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_47"></span>
                        <input id="VersusGanador_47" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_47" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_47" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_47">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_47"></div>

                    </td>
                </tr>
                            <tr>
                    <td>
                        <input type="hidden" value="48" name="Versus[]" id="Versus">                        <label>
                            <img class="margin-right5" src="images/rayalab/ban-argelia-grupos.jpg" alt="Argelia">                            
                            <p class="left">Argelia</p>
                            <input id="PrediccionA_48" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                            
                        </label>
                        <label>
                            <input id="PrediccionB_48" maxlength="2" type="text" value="" name="PrediccionB[]">                            
                            <p class="right margin-right5">Rusia</p>
                            <img src="images/rayalab/ban-rusia-grupos.jpg" alt="Rusia"> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_48"></span>
                        <input id="VersusGanador_48" type="hidden" value="0" name="VersusGanador[]"><input id="ResultadoA_48" type="hidden" value="0" name="ResultadoA[]"><input id="ResultadoB_48" type="hidden" value="0" name="ResultadoB[]">                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_48">     
                            Detalle de puntos<br>
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_48"></div>

                    </td>
                </tr>
                        
            <!--fin tabla grupos-->
        </tbody></table>

        <!--tabla posiciones-->
        <table class="tabla-posiciones" id="tablaPosicionGrupo_8" cellpadding="0" cellspacing="0">
            <tbody><tr>
                <th><p>Tabla de posiciones</p></th>
            <th><p><span>PJ</span></p></th>
            <th><p><span>PG</span></p></th>
            <th><p><span>PE</span></p></th>
            <th><p><span>PP</span></p></th>
            <th><p><span>GF</span></p></th>
            <th><p><span>GC</span></p></th>
            <th><p><span>DIF</span></p></th>
            <th><p><span>PTS</span></p></th>
            </tr>
                            
                            
                            
                            
                        <!--fin tabla posiciones-->
        <tr id="tablaPosicion_29" class="tablaGrupo_8">
                    <td>
                        <img src="images/rayalab/ban-belgica-grupos.jpg" alt="Bélgica">                    
                        <p>Bélgica</p>
                    </td>
                    <td id="PJ_29">0</td>
                    <td id="PG_29">0</td>
                    <td id="PE_29">0</td>
                    <td id="PP_29">0</td>
                    <td id="GF_29">0</td>
                    <td id="GC_29">0</td>
                    <td id="DIF_29">0</td>
                    <td id="PTS_29">0</td>
                </tr><tr id="tablaPosicion_30" class="tablaGrupo_8">
                    <td>
                        <img src="images/rayalab/ban-argelia-grupos.jpg" alt="Argelia">                    
                        <p>Argelia</p>
                    </td>
                    <td id="PJ_30">0</td>
                    <td id="PG_30">0</td>
                    <td id="PE_30">0</td>
                    <td id="PP_30">0</td>
                    <td id="GF_30">0</td>
                    <td id="GC_30">0</td>
                    <td id="DIF_30">0</td>
                    <td id="PTS_30">0</td>
                </tr><tr id="tablaPosicion_31" class="tablaGrupo_8">
                    <td>
                        <img src="images/rayalab/ban-rusia-grupos.jpg" alt="Rusia">                    
                        <p>Rusia</p>
                    </td>
                    <td id="PJ_31">0</td>
                    <td id="PG_31">0</td>
                    <td id="PE_31">0</td>
                    <td id="PP_31">0</td>
                    <td id="GF_31">0</td>
                    <td id="GC_31">0</td>
                    <td id="DIF_31">0</td>
                    <td id="PTS_31">0</td>
                </tr><tr id="tablaPosicion_32" class="tablaGrupo_8">
                    <td>
                        <img src="images/rayalab/ban-korea-grupos.jpg" alt="Corea del Sur">                    
                        <p>Corea del Sur</p>
                    </td>
                    <td id="PJ_32">0</td>
                    <td id="PG_32">0</td>
                    <td id="PE_32">0</td>
                    <td id="PP_32">0</td>
                    <td id="GF_32">0</td>
                    <td id="GC_32">0</td>
                    <td id="DIF_32">0</td>
                    <td id="PTS_32">0</td>
                </tr></tbody></table>
        <div class="clear"></div>
        <div class="input-total"><input id="grupoPuntosTotal_8" value="Total"></div>
        <!--tabla grupos fin -->
    

    <!--fin grupos-->
    <div class="clear"></div>
</div>


<!--fin contenedor central-->
<div class="clear"></div>