<?php
/* @var $this AdminVersusController */
/* @var $model Versus */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'versus-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); echo $model->fecha; ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pais_id_a'); ?>
		<?php echo $form->hiddenField($model,'pais_id_a'); echo $model->pais_a->nombre; ?>
		<?php echo $form->error($model,'pais_id_a'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pais_id_b'); ?>
		<?php echo $form->hiddenField($model,'pais_id_b'); echo $model->pais_b->nombre; ?>
		<?php echo $form->error($model,'pais_id_b'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'goles_a'); ?>
		<?php echo $form->textField($model,'goles_a'); ?>
		<?php echo $form->error($model,'goles_a'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'goles_b'); ?>
		<?php echo $form->textField($model,'goles_b'); ?>
		<?php echo $form->error($model,'goles_b'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ganador'); ?>
                <?php echo CHtml::activeDropDownList($model,'ganador',array(
                    '0'=>'',
                    $model->pais_id_a=>$model->pais_a->nombre,
                    $model->pais_id_b=>$model->pais_b->nombre
                )); ?>
		
		<?php echo $form->error($model,'ganador'); ?>
	</div>
    
        <div class="row">
		<?php echo 'Pueden cambiar pronosticos:'; ?>
                <?php echo CHtml::activeDropDownList($model,'canplay',array(
                    '0'=>'NO',
                    '1'=>'SI'
                )); ?>
		<?php echo $form->error($model,'canplay'); ?>
	</div>

	<div class="row3 buttons3">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>
        <div class="clear"></div>

<?php $this->endWidget(); ?>

</div><!-- form -->