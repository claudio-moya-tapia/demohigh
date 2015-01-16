
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
    <li class="degrade"><?php echo CHtml::link('Fase de grupos', array('/jugar'), array('class' => 'degrade', 'select' => Yii::app()->controller->action->id == 'index')); ?> </li>
    <li class="degrade"><?php echo CHtml::link('4tos y 8vos de final', array('/jugar/cuartosOctavos'), array('class' => 'degrade', 'select' => Yii::app()->controller->action->id == 'cuartosoctavos')); ?> </li>
    <li class="degrade select"><?php echo CHtml::link('Fase final', array('/jugar/final'), array('class' => 'degrade', 'select' => Yii::app()->controller->action->id == 'final')); ?> </li></li>
<!--fin tabs-->
</ul>



<div class="clear"></div>

<!--duelos-->
<div class="cont-duelos bgfinal">

    <div class="fila1">

        <table class="tabla-grupos" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>Semifinal 1, Martes 08 de Julio</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>

            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-alemania-grupos.jpg"/>
                        <p class="left">Alemania</p>
                        <input id="PrediccionA_61" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_61" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">Brasil</p>
                        <img src="../images/rayalab/ban-brasil-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_61"></span>
                    <input id="VersusGanador_61" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_61" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_61" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_61">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_61"></div>
                </td>
            </tr>
        </table>

        <table class="tabla-grupos" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>Semifinal 2, Miercoles 09 de Julio</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>

            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-holanda-grupos.jpg"/>
                        <p class="left">Holanda</p>
                        <input id="PrediccionA_62" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_62" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">Argentina</p>
                        <img src="../images/rayalab/ban-argentina-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_62"></span>
                    <input id="VersusGanador_62" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_62" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_62" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_62">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_62"></div>
                </td>
            </tr>
        </table>

    </div>



    <div class="fila2">

        <table class="tabla-grupos mt3 bordefinal" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>Final, Domingo 13 de Julio</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>

            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-alemania-grupos.jpg"/>
                        <p class="left">Alemania</p>
                        <input id="PrediccionA_64" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_64" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">Argentina</p>
                        <img src="../images/rayalab/ban-argentina-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_64"></span>
                    <input id="VersusGanador_64" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_64" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_64" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_64">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_64"></div>
                </td>
            </tr>
        </table>

        <table class="tabla-grupos mt3" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>3ro y 4to, Sábado 12 de Julio</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>

            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-brasil-grupos.jpg"/>
                        <p class="left">Brasil</p>
                        <input id="PrediccionA_63" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_63" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">Holanda</p>
                        <img src="../images/rayalab/ban-holanda-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_63"></span>
                    <input id="VersusGanador_63" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_63" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_63" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border">
                    <div class="PuntosVersus" id="PuntosVersus_63">     
                        Detalle de puntos<br>
                        - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br>
                        - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    

                    </div>

                    <div id="PuntosVersusTotal_63"></div>
                </td>
            </tr>
        </table>

    </div>









    <!--fin duelos-->
    <div class="clear"></div>
</div>



<!--fin contenedor central-->
<div class="clear"></div>