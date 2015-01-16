<?php
/* @var $this AdminGaleriaController */
/* @var $model Galeria */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php 
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'galeria-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); 
    ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

    
    <div class="row">
        <div class="documentoImagen">
            <?php echo CHtml::image(Yii::app()->params['baseUrlImg'] . '/images/empty.gif', 'imagen', array('id' => 'Galeria_img')); ?>
        </div>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'imagen'); ?>
        <?php echo $form->hiddenField($model, 'imagen', array('size' => 60, 'maxlength' => 255)); ?>
        <br />                    
        <div id="queue"></div>
        <input id="DocumentoUpload" name="DocumentoUpload" type="file" />                
    </div>


    <div class="row3 buttons3">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
    </div>
    <div class="clear"></div>

<?php $this->endWidget(); ?>

</div><!-- form -->