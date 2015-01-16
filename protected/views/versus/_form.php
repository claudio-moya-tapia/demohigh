<?php
/* @var $this VersusController */
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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pais_id_a'); ?>                
		<?php echo $form->textField($model,'pais_id_a'); ?>
		<?php echo $form->error($model,'pais_id_a'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pais_id_b'); ?>
		<?php echo $form->textField($model,'pais_id_b'); ?>
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
		<?php echo $form->textField($model,'ganador'); ?>
		<?php echo $form->error($model,'ganador'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->