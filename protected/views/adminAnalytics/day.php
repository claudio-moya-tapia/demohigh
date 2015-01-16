<?php
/* @var $this AdminAnalyticsController */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['baseUrl']; ?>/assets/static/gridview/styles.css" />
<div class="migas">
    <p>
        <?php echo CHtml::link('Admin Panel', array('/adminPanel')); ?> > 
        <?php echo CHtml::link('Analytics', array('/adminAnalytics')); ?> > 
        <?php echo CHtml::link('Fecha '.$fecha, array('/adminAnalytics/day/?fecha='.$fecha)); ?> > 
        <?php echo $info; ?>
    </p>
    <!--fin migas-->
</div>
<div class="btn-crear">
    <?php echo CHtml::link('Descargar Excel', array('/adminAnalytics/day/?fecha='.$fecha.'&descargar=excel')); ?>
</div>
<div id="usuario-grid" class="grid-view">
<?php echo $table; ?>
</div>