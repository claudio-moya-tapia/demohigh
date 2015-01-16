<?php
/* @var $this AdminEstadoSistemaController */
/* @var $model EstadoSistema */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'estado-sistema-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'estado_id'); ?>
                <?php echo CHtml::activeDropDownList($model, 'estado_id', array('0'=>'Desactivado','1'=>'Activado')); ?>
		<?php echo $form->error($model,'estado_id'); ?>
	</div>

	<div class="row3 buttons3">
		<?php echo CHtml::submitButton('Guardar'); ?>
	</div>
  
        <div class="clear"></div>
        
<?php $this->endWidget(); ?>

</div><!-- form -->