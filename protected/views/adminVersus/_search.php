<?php
/* @var $this AdminVersusController */
/* @var $model Versus */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'versus_id'); ?>
		<?php echo $form->textField($model,'versus_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pais_id_a'); ?>
		<?php echo $form->textField($model,'pais_id_a'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pais_id_b'); ?>
		<?php echo $form->textField($model,'pais_id_b'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'goles_a'); ?>
		<?php echo $form->textField($model,'goles_a'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'goles_b'); ?>
		<?php echo $form->textField($model,'goles_b'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ganador'); ?>
		<?php echo $form->textField($model,'ganador'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->