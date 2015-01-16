<?php

require_once 'Aes.php';
require_once 'AesCtrl.php';

class LoginFormShared extends CApplicationComponent {

    private function isValidUser($userName) {
        
        $ary = CJSON::decode(file_get_contents(Yii::app()->params['baseUrlJson'].'/json/'.Yii::app()->session['project'].'/checkL.js'));
        $userNameEnc = Yii::app()->aesManager->encrypt($userName);

        $valid = false;
        foreach($ary as $user=>$aryUser){

            if($aryUser['u'] == $userNameEnc){
                $valid = true;
                break;
            }
        }
        
        return $valid;

//        $userNameEnc = Yii::app()->aesManager->encrypt($userName);
//        
//        Yii::app()->useDatabase->now();
//
//        $criteria = new CDbCriteria();
//        $criteria->compare('user', $userNameEnc);
//        $criteria->compare('tipo_estado_usuario_id', '1');
//        $usuario = Usuario::model()->find($criteria);
//
//        if ($usuario == null) {
//            return false;
//        } else {
//            return true;
//        }
    }

    private function isNewUser($userName) {
        
        $ary = CJSON::decode(file_get_contents(Yii::app()->params['baseUrlJson'].'/json/'.Yii::app()->session['project'].'/checkL.js'));
        $userNameEnc = Yii::app()->aesManager->encrypt($userName);
        $valid = false;
        foreach($ary as $user=>$aryUser){

            if($aryUser['u'] == $userNameEnc){
                
                if ($aryUser['l'] == '0000-00-00 00:00:00') {
                    $valid = true;
                }else{
                    $valid = false;
                }

                break;
            }
        }
        
        return $valid;
        
//        Yii::app()->useDatabase->now();
//
//        $criteria = new CDbCriteria();
//        $criteria->select = 'last_login_time';
//        $criteria->compare('user', Yii::app()->aesManager->encrypt($userName));
//        $criteria->compare('tipo_estado_usuario_id', '1');
//        $usuario = Usuario::model()->find($criteria);
//
//        if ($usuario != null) {
//
//            if ($usuario->last_login_time == '0000-00-00 00:00:00') {
//                return true;
//            } else {
//                return false;
//            }
//        } else {
//            return false;
//        }
    }

    private function setNewUserPass($userName, $password) {
        Yii::app()->useDatabase->now();
        
        $criteria = new CDbCriteria();
        $criteria->select = 'usuario_id';
        $criteria->compare('user', Yii::app()->aesManager->encrypt($userName));
        $criteria->compare('pass', Yii::app()->aesManager->encrypt($userName));
        $criteria->compare('tipo_estado_usuario_id', '1');

        $usuario = Usuario::model()->find($criteria);
        $usuario->pass = Yii::app()->aesManager->encrypt($password);
        
//        if(Yii::app()->controller->id == 'bancochile'){
//            $usuario->total_puntos = 10;
//        }
        
        $usuario->update();
    }

    public function create($classController) {
        $model = new LoginForm;
        $loginError = false;

        if (isset($_POST['LoginForm'])) {

            $session = new CHttpSession;
            $session->open();

            $userName = AesCtr::decrypt($_POST['LoginForm']['username'], $session['token'], 256);
            $password = AesCtr::decrypt($_POST['LoginForm']['password'], $session['token'], 256);
            $passwordConfirm = AesCtr::decrypt($_POST['LoginForm']['passwordConfirm'], $session['token'], 256);

            if ($this->isValidUser($userName)) {

                $showLanding = false;
                if ($this->isNewUser($userName)) {
                    $this->setNewUserPass($userName, $password);                    
                    $showLanding = true;
                }

                $model->username = Yii::app()->aesManager->encrypt($userName);
                $model->password = Yii::app()->aesManager->encrypt($password);
                
                Yii::app()->useDatabase->now();
                
                if ($model->validate() && $model->login()) {
                    $session = new CHttpSession;
                    $session->open();
                    $session['project'] = Yii::app()->controller->id;
                    $session['layout'] = 'main_' . Yii::app()->controller->id;

                    $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
                    $session['tipo_usuario_id'] = $usuario->tipo_usuario_id;
                    $session['pn'] = ucwords($usuario->usuario_pais->titulo);
                    $session['pi'] = $usuario->usuario_pais_id;
                    $session['ei'] = $usuario->empresa_id;
                    $session['ai'] = $usuario->area_id;
                    $session['an'] = ucwords($usuario->area->nombre);
                    
//                    if(Yii::app()->user->id == 1){
//                        $classController->redirect(array('/home'));
//                    }else{
//                        $session = new CHttpSession;
//                        $session->destroy();
//                        
//                        echo 'Estamos mejorando el servicio de Mundialero.<br>Volvemos pronto.';
//                        exit();
//                    }
                    
                    if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {

                        if ($showLanding) {
                            Yii::app()->cacheUsers->now();
                            $classController->redirect(array('/landing'));
                        } else {
                            $classController->redirect(array('/home'));
                        }
                    } else {
                        //usuario normal                        
                        $estadoSistema = EstadoSistema::model()->find();
                        if ($estadoSistema->estado_id == 1) {

                            if ($showLanding) {
                                Yii::app()->cacheUsers->now();
                                $classController->redirect(array('/landing'));
                            } else {
                                $classController->redirect(array('/home'));
                            }
                        } else {
                            $session = new CHttpSession;
                            $session->destroy();
                            echo CHtml::image('images/standby.jpg');                         
                            exit();
                            //$classController->redirect(array('/site/offline'));
                        }
                    }
                    
                }else{
                    $loginError = true;
                }
                
            }else{
                $loginError = true;
            }
            
            
        } else {
            $session = new CHttpSession;
            $session->destroy();
        }

        $session = new CHttpSession;
        $session->open();
        $session['project'] = Yii::app()->controller->id;

        $DateTime = new DateTime('NOW');
        $token = $DateTime->format('Y-m-d H:i:s') . microtime(true) . rand() . Yii::app()->controller->id;

        $session['token'] = crypt($token);

        if ($session['project'] == 'bbva') {
            $tituloRut = 'Número de empleado';
            $loginEjemplo = 'Ejemplo: h123456';
            $legend = '';
        } else if ($session['project'] == 'credicorp'){
            $tituloRut = 'Ingresa tu Rut/dni/matricula';
            $loginEjemplo = 'Ejemplo: 123456789';
            $legend = '';
        } else {
            $tituloRut = 'Ingresar Rut';
            $loginEjemplo = 'Ejemplo: 123456789';
            $legend = '';
        }

        if ($session['project'] == 'santander') {
            $render = '/site/login_santander';
        } else {
            $render = '/site/login';
        }
        
        if($loginError){
            $legend = 'Login error';
            
            if($session['project'] == 'anden'){
                $legend = '¿No recuerdas tu contraseña? Solicítala a andenenlinea@metro.cl';
            }
            
            if($session['project'] == 'afphabitat'){
                $legend = 'Si olvidaste tu clave, envía un correo a comunicacionesinternas2@afphabitat.cl';
            }
            
            if($session['project'] == 'falabella'){
                $legend = 'Prueba con tu Rut sin codigo verificador.';
            }
            
            if($session['project'] == 'ripley'){
                $legend = '¿No recuerdas tu contraseña? Solicítala enviando tu rut a g-comunicaciones@ripley.cl';
            }
        }

        $classController->render($render, array(
            'model' => $model,
            'token' => $session['token'],
            'tituloRut' => $tituloRut,
            'loginEjemplo' => $loginEjemplo,
            'legend' => $legend
        ));
    }

}

?>