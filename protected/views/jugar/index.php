<?php
/* @var $this JugarController */
/* @var $versus Versus */
?>

<!--migas-->
<div class="migas">
    <p>Estás en: <a href="home">Home</a> > Jugar</p>
    <!--fin migas-->
</div>

<h1>Las predicciones quedan grabadas automáticamente al ser ingresadas.</h1>

<!--tabs-->
<ul class="tabs">
    <li class="degrade"><?php echo CHtml::link('Fase de grupos', array('/jugar'), array('class' => 'degrade', 'select' => Yii::app()->controller->action->id == 'index')); ?> </li>
    <li class="degrade select"><?php echo CHtml::link('4tos y 8vos de final', array('/jugar/cuartosoctavos'), array('class' => 'degrade', 'select' => Yii::app()->controller->action->id == 'cuartosoctavos')); ?> </li>    
<!--fin tabs-->
</ul>


<div class="clear"></div>

<!--grupos-->
<div class="cont-grupos degrade">

    <?php foreach ($listGrupos as $grupoNombre => $aryVersus) { ?>

        <!--tabla grupos-->
        <table class="tabla-grupos" cellpadding="0" cellspacing="0">           
            <tr>
                <th><p><?php echo $grupoNombre; ?></p></th>
            <th><p><span>Resultado</span></p></th>
            <th><p><span>Puntos</span></p></th>
            </tr>
            <?php foreach ($aryVersus['versus'] as $versus) { ?>
                <tr>
                    <td>
                        <?php echo CHtml::hiddenField('Versus[]', $versus->versus_id); ?>
                        <label>
                            <?php echo CHtml::image('images/rayalab/' . $versus->pais_a->imagen_small, $versus->pais_a->nombre, array('class' => 'margin-right5')); ?>                            
                            <p class="left"><?php echo $versus->pais_a->nombre; ?></p>
                            <?php echo CHtml::textField('PrediccionA[]', '', array('id' => 'PrediccionA_' . $versus->versus_id, 'class' => 'margin-right5','maxlength'=>2)); ?>                            
                        </label>
                        <label>
                            <?php echo CHtml::textField('PrediccionB[]', '', array('id' => 'PrediccionB_' . $versus->versus_id,'maxlength'=>2)); ?>                            
                            <p class="right margin-right5"><?php echo $versus->pais_b->nombre; ?></p>
                            <?php echo CHtml::image('images/rayalab/' . $versus->pais_b->imagen_small, $versus->pais_b->nombre); ?> 
                        </label>
                    </td>
                    <td>
                        <span id="VersusResultado_<?php echo $versus->versus_id; ?>"></span>
                        <?php
//                        if ($versus->ganador) {
//                            echo $versus->goles_a . ' - ' . $versus->goles_b;
//                            echo CHtml::hiddenField('ResultadoA[]', $versus->goles_a, array('id' => 'ResultadoA_' . $versus->versus_id));
//                            echo CHtml::hiddenField('ResultadoB[]', $versus->goles_b, array('id' => 'ResultadoB_' . $versus->versus_id));
//                        }                        
                        echo CHtml::hiddenField('VersusGanador[]', 0, array('id' => 'VersusGanador_' . $versus->versus_id));
                        echo CHtml::hiddenField('ResultadoA[]', 0, array('id' => 'ResultadoA_' . $versus->versus_id));
                        echo CHtml::hiddenField('ResultadoB[]', 0, array('id' => 'ResultadoB_' . $versus->versus_id));
                        ?>
                    </td>
                    <td class="no-border">

                        <div class="PuntosVersus" id="PuntosVersus_<?php echo $versus->versus_id; ?>">     
                            Detalle de puntos<br />
                            - Al ganador: <span class="PuntosGanador" style="font-weight: bold"></span><br />
                            - Goles del Equipo 1: <span class="PuntosGolesGanador" style="font-weight: bold"></span><br />
                            - Goles del Equipo 2: <span class="PuntosGolesPerdedor" style="font-weight: bold"></span>    
                            
                        </div>

                        <div id="PuntosVersusTotal_<?php echo $versus->versus_id; ?>"></div>

                    </td>
                </tr>
            <?php } ?>            
            <!--fin tabla grupos-->
        </table>

        <!--tabla posiciones-->
        <table class="tabla-posiciones" id="tablaPosicionGrupo_<?php echo $aryVersus['grupo_id']; ?>" cellpadding="0" cellspacing="0">
            <tr>
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
            <?php foreach ($aryVersus['tabla_posiciones'] as $pais_id) { ?>
                <tr id="tablaPosicion_<?php echo $pais_id; ?>" class="tablaGrupo_<?php echo $aryVersus['grupo_id']; ?>">
                    <td>
                        <?php echo CHtml::image('images/rayalab/' . $aryTabla[$pais_id]['bandera'], $aryTabla[$pais_id]['nombre']); ?>                    
                        <p><?php echo $aryTabla[$pais_id]['nombre']; ?></p>
                    </td>
                    <td id="PJ_<?php echo $pais_id; ?>">0</td>
                    <td id="PG_<?php echo $pais_id; ?>">0</td>
                    <td id="PE_<?php echo $pais_id; ?>">0</td>
                    <td id="PP_<?php echo $pais_id; ?>">0</td>
                    <td id="GF_<?php echo $pais_id; ?>">0</td>
                    <td id="GC_<?php echo $pais_id; ?>">0</td>
                    <td id="DIF_<?php echo $pais_id; ?>">0</td>
                    <td id="PTS_<?php echo $pais_id; ?>">0</td>
                </tr>
            <?php } ?>
            <!--fin tabla posiciones-->
        </table>
        <div class="clear"></div>
        <div class="input-total"><input id="grupoPuntosTotal_<?php echo $aryVersus['grupo_id']; ?>" value="Total" /></div>
        <!--tabla grupos fin -->
    <?php } ?>


    <!--fin grupos-->
    <div class="clear"></div>
</div>

<!--fin contenedor central-->
<div class="clear"></div>