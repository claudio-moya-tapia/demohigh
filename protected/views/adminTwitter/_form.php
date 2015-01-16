<?php
/* @var $this AdminTwitterController */
/* @var $model Twitter */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'twitter-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_creacion'); ?>
		<?php echo $model->fecha_creacion; ?>
                <?php echo $form->hiddenField($model,'texto',array('size'=>60,'maxlength'=>140)); ?>
		<?php echo $form->error($model,'fecha_creacion'); ?>
	</div>

	<div class="row">	
            <?php echo $form->labelEx($model,'usuario'); ?>
		<?php echo $model->usuario->nombre.' '.$model->usuario->apellido_paterno; ?>		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'texto'); ?>
		<?php echo $form->textField($model,'texto',array('size'=>60,'maxlength'=>140)); ?>
		<?php echo $form->error($model,'texto'); ?>
	</div>

	<div class="row3 buttons3">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
        </div>
        <div class="clear"></div>

<?php $this->endWidget(); ?>

</div><!-- form -->