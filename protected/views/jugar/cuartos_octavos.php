
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
    "><img src="../images/ajax-loader.gif"> <span id="loadingMsg">Cargando</span></div>

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
    <li class="degrade "><?php echo CHtml::link('Fase de grupos', array('/jugar'), array('class' => 'degrade', 'select' => Yii::app()->controller->action->id == 'index')); ?> </li>
    <li class="degrade select"><?php echo CHtml::link('4tos y 8vos de final', array('/jugar/cuartosOctavos'), array('class' => 'degrade', 'select' => Yii::app()->controller->action->id == 'cuartosoctavos')); ?> </li>
    <li class="degrade "><?php echo CHtml::link('Fase final', array('/jugar/final'), array('class' => 'degrade', 'select' => Yii::app()->controller->action->id == 'final')); ?> </li></li>
<!--fin tabs-->
</ul>



<div class="clear"></div>
<br>
<h1>El resultado final es a los 90' o 120', no toma en cuenta los penales.</h1>
<!--duelos-->
<div class="cont-duelos">
        
    <div class="fila1">

        <table class="tabla-grupos" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>Partidos Sábado, 28 de Junio</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-brasil-grupos.jpg"/>
                        <p class="left">Brasil</p>
                        <input id="PrediccionA_49" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_49" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">Chile</p>
                        <img src="../images/rayalab/ban-chile-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_49"></span>
                    <input id="VersusGanador_49" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_49" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_49" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_49">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_49"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-colombia-grupos.jpg"/>
                        <p class="left">Colombia</p>
                        <input id="PrediccionA_50" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_50" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">Uruguay</p>
                        <img src="../images/rayalab/ban-uruguay-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_50"></span>
                    <input id="VersusGanador_50" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_50" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_50" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_50">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_50"></div>
                </td>
            </tr>
        </table>

        

        <table class="tabla-grupos" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>Partidos Lunes, 30 de Junio</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-francia-grupos.jpg"/>
                        <p class="left">Francia</p>
                        <input id="PrediccionA_53" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_53" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">Nigeria</p>
                        <img src="../images/rayalab/ban-nigeria-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_53"></span>
                    <input id="VersusGanador_53" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_53" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_53" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_53">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_53"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-alemania-grupos.jpg"/>
                        <p class="left">Alemania</p>
                        <input id="PrediccionA_54" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_54" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">Argelia</p>
                        <img src="../images/rayalab/ban-argelia-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_54"></span>
                    <input id="VersusGanador_54" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_54" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_54" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_54">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_54"></div>
                </td>
            </tr>
        </table>
        
        <table class="tabla-grupos" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>Partidos Domingo, 29 de Junio</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-holanda-grupos.jpg"/>
                        <p class="left">Holanda</p>
                        <input id="PrediccionA_51" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_51" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">México</p>
                        <img src="../images/rayalab/ban-mexico-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_51"></span>
                    <input id="VersusGanador_51" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_51" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_51" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_51">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_51"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-costa-rica-grupos.jpg"/>
                        <p class="left">Costa Rica</p>
                        <input id="PrediccionA_52" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_52" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">Grecia</p>
                        <img src="../images/rayalab/ban-grecia-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_52"></span>
                    <input id="VersusGanador_52" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_52" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_52" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_52">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_52"></div>
                </td>
            </tr>
        </table>
        

        <table class="tabla-grupos" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>Partidos Martes, 1 de Julio</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-argentina-grupos.jpg"/>
                        <p class="left">Argentina</p>
                        <input id="PrediccionA_55" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_55" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">Suiza</p>
                        <img src="../images/rayalab/ban-suiza-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_55"></span>
                    <input id="VersusGanador_55" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_55" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_55" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_55">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_55"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-belgica-grupos.jpg"/>
                        <p class="left">Bélgica</p>
                        <input id="PrediccionA_56" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_56" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">Estados Unidos</p>
                        <img src="../images/rayalab/ban-usa-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_56"></span>
                    <input id="VersusGanador_56" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_56" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_56" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_56">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_56"></div>
                </td>
            </tr>
        </table>

    </div>



    <div class="fila2">

        <table class="tabla-grupos mt1" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>Partidos Viernes, 04 de Julio</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-francia-grupos.jpg"/>
                        <p class="left">Francia</p>
                        <input id="PrediccionA_58" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_58" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">Alemania</p>
                        <img src="../images/rayalab/ban-alemania-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_58"></span>
                    <input id="VersusGanador_58" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_58" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_58" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_58">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_58"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-brasil-grupos.jpg"/>
                        <p class="left">Brasil</p>
                        <input id="PrediccionA_57" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_57" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">Colombia</p>
                        <img src="../images/rayalab/ban-colombia-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_57"></span>
                    <input id="VersusGanador_57" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_57" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_57" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_57">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_57"></div>
                </td>
            </tr>
        </table>

        <table class="tabla-grupos mt2" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>Partidos Sábado, 05 de Julio</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-holanda-grupos.jpg"/>
                        <p class="left">Holanda</p>
                        <input id="PrediccionA_59" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_59" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">Costa Rica</p>
                        <img src="../images/rayalab/ban-costa-rica-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_59"></span>
                    <input id="VersusGanador_59" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_59" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_59" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_59">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_59"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-argentina-grupos.jpg"/>
                        <p class="left">Argentina</p>
                        <input id="PrediccionA_60" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_60" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">Bélgica</p>
                        <img src="../images/rayalab/ban-belgica-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_60"></span>
                    <input id="VersusGanador_60" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_60" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_60" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_60">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_60"></div>
                </td>
            </tr>
        </table>

    </div>









    <!--fin duelos-->
    <div class="clear"></div>
</div>



<!--fin contenedor central-->
<div class="clear"></div>