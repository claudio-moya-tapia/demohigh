<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
<!--form-->
<div class="cont-form degrade">
    <h1 class="tit">Ingresa con tu usuario para participar.</h1>
    
    <?php echo $form->textField($model, 'username', array('class' => 'mt40', 'placeholder' => 'Email')); ?>
    <?php echo $form->error($model, 'username'); ?>
    
    <?php echo $form->passwordField($model, 'password', array('class' => 'mt40', 'placeholder' => 'Contraseña')); ?>
    <?php echo $form->error($model, 'password'); ?>
  

    
    <div class="btn-ingresar mt40"><?php echo CHtml::submitButton('Login'); ?></div>
   
    <!--fin form-->
</div>
<?php $this->endWidget(); ?>
