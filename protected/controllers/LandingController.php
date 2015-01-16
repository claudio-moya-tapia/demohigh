<?php

class LandingController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations            
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'ajaxInsert'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /* @var $versus Versus */

    public function actionIndex() {
        Yii::app()->useDatabase->now();
        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);

        if (Yii::app()->session['project'] != 'bbva') {
            $email = trim(Yii::app()->aesManager->decrypt($usuario->email));
            $nombre = trim(Yii::app()->aesManager->decrypt($usuario->nombre));
            $apellido_paterno = trim(Yii::app()->aesManager->decrypt($usuario->apellido_paterno));

            if (strlen($email) == 0) {
                $nickname = $nombre . '.' . $apellido_paterno;
            } else {
                list($nickname, $emailhost) = explode('@', $email);
            }

            $usuario->nickname = $nickname;
            $usuario->update();
        }
        
        $textoGif1 = 'Mundialero es un juego de predicciones, donde participar&aacute;s por estar al tope del ranking.';
        $textoGif2 = 'En la secci&oacute;n JUGAR debes PRONOSTICAR los resultados de cada partido. Tienes hasta 5 minutos antes de cada partido para ingresar tu predicci&oacute;n.';              
        $textoGif4 = 'Durante el mundial iremos premiando a los mejores. Revisa la política de premios en la sección PREMIOS.';
        
        switch (Yii::app()->session['project']) {
            case 'brotecicafal':
                $displayPaso4 = 'none';
                $displayPaso5 = 'block';
                $showEligeAvatar = false;
                break;
            case 'skc':
                $displayPaso4 = 'none';
                $displayPaso5 = 'block';
                $showEligeAvatar = false;
                break;
            case 'skcberge':
                $displayPaso4 = 'none';
                $displayPaso5 = 'block';
                $showEligeAvatar = false;
                break;
            case 'gruposiglo':
                $displayPaso4 = 'none';
                $displayPaso5 = 'block';
                $showEligeAvatar = false;
                break;
            case 'credicorp':
                $displayPaso4 = 'block';
                $displayPaso5 = 'none';
                $showEligeAvatar = true;
                $textoGif4 = 'Finalizado el Mundial se premiará a los mejores a nivel Regional y Local. Para mayor información revisa la lista de premios.';
                break;
            case 'dcv':
                $displayPaso4 = 'block';
                $displayPaso5 = 'none';
                $showEligeAvatar = true;
                $textoGif1 = 'El Mundialero es un juego de predicciones, donde participarás por equipo para estar al tope del ranking.';
                $textoGif2 = 'En la sección jugar, el líder del equipo deberá ingresar el pronóstico de resultados de cada partido. Tendrán hasta 5 minutos antes del inicio de cada partido, para ingresar sus predicciones.';
                break;
            default:
                $displayPaso4 = 'block';
                $displayPaso5 = 'none';
                $showEligeAvatar = true;
                break;
        }

        $listUsuarioPais = CHtml::listData(UsuarioPais::model()->findAll(), 'usuario_pais', 'titulo');

        $this->render('index', array(
            'usuario' => $usuario,
            'listUsuarioPais' => $listUsuarioPais,
            'displayPaso4'=>$displayPaso4,
            'displayPaso5'=>$displayPaso5,
            'textoGif1'=>$textoGif1,
            'textoGif2'=>$textoGif2,
            'textoGif4'=>$textoGif4
        ));
    }

    public function actionAjaxInsert() {
        Yii::app()->useDatabase->now();
        $nickname = $_GET['nickname'];
        $img = $_GET['img'];

        $updateMoreFields = $_GET['updateMoreFields'];
        $usuario_pais_id = $_GET['usuario_pais_id'];
        $usuarioNombres = $_GET['usuarioNombres'];
        $usuarioApellidoPaterno = $_GET['usuarioApellidoPaterno'];
        $usuarioApellidoMaterno = $_GET['usuarioApellidoMaterno'];
        $usuarioRut = $_GET['usuarioRut'];

        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
        $usuario->setAttribute('imagen', $img);
        $usuario->setAttribute('nickname', $nickname);

        if ($updateMoreFields == 'si') {
            $usuario->setAttribute('usuario_pais_id', $usuario_pais_id);
            $usuario->setAttribute('nombre', Yii::app()->aesManager->encrypt($usuarioNombres));
            $usuario->setAttribute('apellido_paterno', Yii::app()->aesManager->encrypt($usuarioApellidoPaterno));
            $usuario->setAttribute('apellido_materno', Yii::app()->aesManager->encrypt($usuarioApellidoMaterno));
            $usuario->setAttribute('rut', Yii::app()->aesManager->encrypt($usuarioRut));
        }

        $usuario->update();        
    }

}
