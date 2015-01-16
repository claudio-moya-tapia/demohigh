
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

<!--tabs-->
<ul class="tabs">
    <li class="degrade"><?php echo CHtml::link('Fase de grupos', array('/jugar'), array('class' => 'degrade', 'select' => Yii::app()->controller->action->id == 'index')); ?> </li>
    <li class="degrade select"><?php echo CHtml::link('4tos y 8vos de final', array('/jugar/cuartosoctavos'), array('class' => 'degrade', 'select' => Yii::app()->controller->action->id == 'cuartosoctavos')); ?> </li>
    <li class="degrade"><?php echo CHtml::link('Fase final', array('/jugar/final'), array('class' => 'degrade', 'select' => Yii::app()->controller->action->id == 'final')); ?> </li></li>
<!--fin tabs-->
</ul>


<div class="clear"></div>


<!--duelos-->
<div class="cont-duelos">

    <div class="fila1">

        <table class="tabla-grupos" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>Partido</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
            <tr>
                <td>
                    <label>
                        <img src="../images/rayalab/ban-chile-grupos.jpg"/>
                        <p class="left">A</p>
                        <input id="PrediccionA_49" class="margin-right5" maxlength="2" type="text" value="" name="PrediccionA[]">                        
                    </label>
                    <label>
                        <input id="PrediccionB_49" maxlength="2" type="text" value="" name="PrediccionB[]">
                        <p class="right margin-right5">B</p>
                        <img src="../images/rayalab/ban-mexico-grupos.jpg" />
                    </label>
                </td>
                <td>
                    <span id="VersusResultado_49"></span>
                    <input id="VersusGanador_49" type="hidden" value="0" name="VersusGanador[]">
                    <input id="ResultadoA_49" type="hidden" value="0" name="ResultadoA[]">
                    <input id="ResultadoB_49" type="hidden" value="0" name="ResultadoB[]">           
                </td>
                <td class="no-border"></td>
            </tr>
            <tr>
                <td class="no-bordeb">
                    <label>
                        <img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/>
                        <p class="left">Brasil</p>
                        <input class="margin-right5" />
                    </label>
                    <label>
                        <input />
                        <p class="right margin-right5">Brasil</p>
                        <img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/>
                    </label>
                </td>
                <td class="no-bordeb"></td>
                <td class="no-bordeb no-border"></td>
            </tr>
        </table>

        <table class="tabla-grupos" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>Partido</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
            <tr>
                <td>
                    <label><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/><p class="left">Brasil</p><input class="margin-right5" /></label><label><input /><p class="right margin-right5">Brasil</p><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg" /></label>
                </td>
                <td></td>
                <td class="no-border"></td>
            </tr>
            <tr>
                <td class="no-bordeb"><label><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/><p class="left">Brasil</p><input class="margin-right5" /></label><label><input /><p class="right margin-right5">Brasil</p><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/></label></td>
                <td class="no-bordeb"></td>
                <td class="no-bordeb no-border"></td>
            </tr>
        </table>

        <table class="tabla-grupos" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>Partido</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
            <tr>
                <td>
                    <label><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/><p class="left">Brasil</p><input class="margin-right5" /></label><label><input /><p class="right margin-right5">Brasil</p><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg" /></label>
                </td>
                <td></td>
                <td class="no-border"></td>
            </tr>
            <tr>
                <td class="no-bordeb"><label><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/><p class="left">Brasil</p><input class="margin-right5" /></label><label><input /><p class="right margin-right5">Brasil</p><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/></label></td>
                <td class="no-bordeb"></td>
                <td class="no-bordeb no-border"></td>
            </tr>
        </table>

        <table class="tabla-grupos" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>Partido</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
            <tr>
                <td>
                    <label><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/><p class="left">Brasil</p><input class="margin-right5" /></label><label><input /><p class="right margin-right5">Brasil</p><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg" /></label>
                </td>
                <td></td>
                <td class="no-border"></td>
            </tr>
            <tr>
                <td class="no-bordeb"><label><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/><p class="left">Brasil</p><input class="margin-right5" /></label><label><input /><p class="right margin-right5">Brasil</p><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/></label></td>
                <td class="no-bordeb"></td>
                <td class="no-bordeb no-border"></td>
            </tr>
        </table>

    </div>



    <div class="fila2">

        <table class="tabla-grupos mt1" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>Partido</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
            <tr>
                <td>
                    <label><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/><p class="left">Brasil</p><input class="margin-right5" /></label><label><input /><p class="right margin-right5">Brasil</p><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg" /></label>
                </td>
                <td></td>
                <td class="no-border"></td>
            </tr>
            <tr>
                <td class="no-bordeb"><label><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/><p class="left">Brasil</p><input class="margin-right5" /></label><label><input /><p class="right margin-right5">Brasil</p><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/></label></td>
                <td class="no-bordeb"></td>
                <td class="no-bordeb no-border"></td>
            </tr>
        </table>

        <table class="tabla-grupos mt2" cellpadding="0" cellspacing="0">
            <tr>
                <th><p>Partido</p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
            <tr>
                <td>
                    <label><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/><p class="left">Brasil</p><input class="margin-right5" /></label><label><input /><p class="right margin-right5">Brasil</p><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg" /></label>
                </td>
                <td></td>
                <td class="no-border"></td>
            </tr>
            <tr>
                <td class="no-bordeb"><label><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/><p class="left">Brasil</p><input class="margin-right5" /></label><label><input /><p class="right margin-right5">Brasil</p><img src="http://192.168.1.49/yii/project/mundialero_v4_dev/images/rayalab/ban-brasil-grupos.jpg"/></label></td>
                <td class="no-bordeb"></td>
                <td class="no-bordeb no-border"></td>
            </tr>
        </table>

    </div>









    <!--fin duelos-->
    <div class="clear"></div>
</div>



<!--fin contenedor central-->
<div class="clear"></div>