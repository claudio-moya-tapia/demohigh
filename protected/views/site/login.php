<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
Yii::app()->clientScript->registerCssFile(Yii::app()->params['baseUrl'] . '/css/login.css');
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions'=>array('autocomplete'=>'off')
));

    echo CHtml::hiddenField('LoginForm[token]', $token,array('id'=>'LoginForm_token'));
?>

<div id="loadingBox" style="
    width: 110px;
    height: 20px;
    background-color: white;
    position: fixed;
    top: 0px;
    margin-left: 410px;
    font-family: Arial;
    font-size: 12px;
    padding: 10px;
    border-width: 1px;
    border-style: dashed;
    border-color: lightgray;
    font-weight: bold;
    display: none;
    z-index:99999;
    "><img src="images/ajax-loader.gif"> <span id="loadingMsg">Cargando</span></div>


<div class="cont-landing">

    <div class="paso2">
        <p class="tit">Ingresa</p>
        <p class="p">
            <label class="label"><?php echo $tituloRut; ?></label>
            <span class="userEjemplo"><?php echo $loginEjemplo; ?></span> </br> 
            <input type="text" class="input" id="userName" name="userNameLogin" value="" autocomplete="off" />
            <input type="password" id="userNameEnc" name="LoginForm[username]" value="" style="display: none"  />
            <span id="msgUserName" style="display: none"></span>            
        </p>
        <span class="label"><?php echo $legend; ?></span>
        <a class="sig" href="#" id="btnSiguiente">Siguiente</a>        
        <p class="p" id="boxPass" style="display: none;">
            <label class="label">Contrase&ntilde;a</label>
            <input type="password" class="input" id="userPass" name="userPassLogin" value="" />
            <input type="password" class="input" id="userPassEnc" name="LoginForm[password]" value="" style="display: none" />
            
            <span id="msgUserPass" style="display: none"></span>
        </p>
        <p class="p" id="boxPassConfirm" style="display: none;">
            <label class="label">Repetir contrase&ntilde;a</label>
            <input type="password" class="input" id="userPassConfirm" name="LoginForm[passwordConfirm]" value="" />
            <span id="msgPassConfirm" style="display: none"></span>
        </p>
        <div class="clear"></div>
        <a class="a" href="#;" id="btnPassForget" style="display: none">&iquest;Olvidaste tu contrase&ntilde;a?</a>        
        <a class="sig" href="#" id="btnIngresar" style="display: none">Ingresar</a>       
        
    </div>
    
    
    
    <div class="paso2" id="pasoIngresando" style="display: none">
        <p class="tit">Ingresando a Mundialero...</p>
    </div>

</div>

<?php $this->endWidget(); ?>