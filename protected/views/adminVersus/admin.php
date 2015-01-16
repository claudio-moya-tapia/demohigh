<?php
/* @var $this AdminVersusController */
/* @var $model Versus */

?>
<!--migas-->
<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > Versus</p>
    <!--fin migas-->
</div>

<h1>Administracion de Versus</h1>
<div class="btn-crear">
    <?php echo CHtml::link('Actualizar puntos', array('/adminUsuario/totalPuntos')); ?><br>
    <?php echo CHtml::link('Actualizar rankings', array('/adminCache/ranking')); ?>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'versus-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'fecha',
        array(
            'name' => 'pais_id_a',
            'value' => '$data->pais_a->nombre',
            'type' => 'text',
        ),
        array(
            'name' => 'pais_id_b',
            'value' => '$data->pais_b->nombre',
            'type' => 'text',
        ),
        'goles_a',
        'goles_b',
        array(
            'name' => 'ganador',
            'value' => '$data->ganador_pais->nombre',
            'type' => 'text',
        ),
        array(
            'class' => 'CButtonColumn',
            'template'=>'{update}',
        ),
    ),
));
?>
