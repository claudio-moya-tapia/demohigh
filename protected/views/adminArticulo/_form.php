<?php
/* @var $this AdminArticuloController */
/* @var $model Articulo */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'articulo-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>
        <?php echo $form->errorSummary($model); ?>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'tipo_destacado_id'); ?>        
        <?php echo CHtml::activeDropDownList($model, 'tipo_destacado_id', array('1'=>'Destacado','2'=>'No destacado')); ?>
        <?php echo $form->error($model, 'tipo_destacado_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'estado_articulo_id'); ?>        
        <?php echo CHtml::activeDropDownList($model, 'estado_articulo_id', array('1'=>'Publicado','2'=>'No Publicado','3'=>'Eliminado')); ?>
        <?php echo $form->error($model, 'estado_articulo_id'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'titulo'); ?>
        <?php echo $form->textField($model, 'titulo', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'titulo'); ?>
    </div>    
        
    <div class="row">
        <?php echo $form->labelEx($model,'bajada'); ?>
        <div style="width: 400px;">
            <?php echo $form->textArea($model,'bajada',array('rows'=>6,'cols'=>50,'maxlength'=>255)); ?>
        </div>
        <?php echo $form->error($model,'bajada'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'texto'); ?>
        <div style="width: 400px;">            
            <?php echo $form->textArea($model, 'texto', array('rows' => 6, 'cols' => 50)); ?>
        </div>        
        <?php echo $form->error($model, 'texto'); ?>
    </div>
    
    
    <div class="row">
        <div class="documentoImagen">
            <?php echo CHtml::image(Yii::app()->params['baseUrlImg'] . '/images/empty.gif', 'imagen', array('id' => 'Articulo_img')); ?>
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