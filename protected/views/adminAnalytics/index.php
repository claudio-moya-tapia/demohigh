<?php
/* @var $this AdminAnalyticsController */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['baseUrl']; ?>/assets/static/gridview/styles.css" />
<div class="migas">
    <p><?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > Analytics</p>
    <!--fin migas-->
</div>

<h1>Usuarios</h1>
<div id="usuario-grid" class="grid-view">
    <table class="items">
        <thead>
            <tr>                
                <th>Han ingresado</th>
                <th>NO han ingresado</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $usuariosHanIngresado; ?></td>
                <td><?php echo $usuariosNOHanIngresado; ?></td>
                <td><?php echo $usuariosTotal; ?></td>
            </tr>     
            <tr>
                <td><div class="btn-crear"><?php echo CHtml::link('Descargar excel', array('/adminAnalytics/descargarUserLogin')); ?></div></td>
                <td><div class="btn-crear"><?php echo CHtml::link('Descargar excel', array('/adminAnalytics/descargarUserLoginNo')); ?></div></td>
                <td></td>
            </tr> 
        </tbody>
    </table>
</div>

<h1>Paginas vistas</h1>
<div id="usuario-grid" class="grid-view">
<?php echo $table; ?>
</div>