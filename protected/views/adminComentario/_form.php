<?php
/* @var $this AdminComentarioController */
/* @var $model Comentario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comentario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model,'articulo_id'); ?>
        <?php echo $form->hiddenField($model,'usuario_id'); ?>
        <?php echo $form->hiddenField($model,'fecha_creacion'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'texto'); ?>
		<?php echo $form->textArea($model,'texto',array('cols'=>60,'rows'=>10)); ?>
		<?php echo $form->error($model,'texto'); ?>
	</div>

	<div class="row3 buttons3">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Guardar'); ?>
	</div>
        <div class="clear"></div>

<?php $this->endWidget(); ?>

</div><!-- form -->