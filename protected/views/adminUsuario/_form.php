<?php
/* @var $this AdminUsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'usuario-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>
    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'rut').' / Login'; ?>
        <?php echo $form->textField($model, 'user', array('size' => 255, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'user'); ?>
    </div>
    <?php if(!$model->isNewRecord){ ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'pass'); ?>
            <?php echo $form->passwordField($model, 'pass', array('size' => 255, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'pass'); ?>
        </div>
    <?php }else{ ?>
    
        <div class="row">
            <?php echo $form->labelEx($model, 'pass'); ?>
            <?php echo 'Contraseña generada automatica por sistema, es el mismo valor de Rut.'; ?>
            <?php echo $form->error($model, 'pass'); ?>
        </div>
    <?php } ?>
       
     <div class="row">
        <?php echo $form->labelEx($model, 'rut'); ?>
        <?php echo $form->textField($model, 'rut', array('size' => 255, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'rut'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'nombre'); ?>
        <?php echo $form->textField($model, 'nombre', array('size' => 255, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'nombre'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'apellido_paterno'); ?>
        <?php echo $form->textField($model, 'apellido_paterno', array('size' => 255, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'apellido_paterno'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'apellido_materno'); ?>
        <?php echo $form->textField($model, 'apellido_materno', array('size' => 255, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'apellido_materno'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'nickname'); ?>
        <?php echo $form->textField($model, 'nickname', array('size' => 255, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'nickname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 255, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'area_id'); ?>
        <?php echo CHtml::activeDropDownList($model, 'area_id', $listArea, array('prompt' => '(Seleccione)')); ?>		
        <?php echo $form->error($model, 'area_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'tipo_estado_usuario_id'); ?>
        <?php echo CHtml::activeDropDownList($model, 'tipo_estado_usuario_id', $listTipoEstado, array('prompt' => '(Seleccione)')); ?>		
        <?php echo $form->error($model, 'tipo_estado_usuario_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'tipo_usuario_id'); ?>
        <?php echo CHtml::activeDropDownList($model, 'tipo_usuario_id', $listTipoUsuario, array('prompt' => '(Seleccione)')); ?>		
        <?php echo $form->error($model, 'tipo_usuario_id'); ?>
    </div>

    <div class="row">


        <div>
            <?php echo CHtml::image(Yii::app()->params['baseUrl'] . '/images/empty.gif', 'imagen', array('id' => 'Usuario_img')); ?>            
        </div>                

        <br />
        <div>      
            <div id="queue"></div>
            <input id="DocumentoUpload" name="DocumentoUpload" type="file" />
        </div>



        <?php echo $form->hiddenField($model, 'imagen', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div  class="row3 buttons3">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
    </div>
    <div class="clear"></div>
    <?php $this->endWidget(); ?>

</div><!-- form -->