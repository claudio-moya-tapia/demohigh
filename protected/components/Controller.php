<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function beforeAction($action) {

        if (parent::beforeAction($action)) {
            
            if(Yii::app()->controller->id != 'adminAnalytics'){

                if (Yii::app()->session['project'] != '') {
                    $proyect = Yii::app()->session['project'];

                } else {
                    $proyect = Yii::app()->controller->id;

                    if (Yii::app()->params['enviroment'] == 'prod') {
                        //detector subdominios
                        list($controllerId) = explode('.mundialero.cl', $_SERVER['HTTP_HOST']);

                        if ($controllerId != 'www') {
                            Yii::app()->user->logout();
                            $this->redirect('http://www.mundialero.cl/' . $controllerId);
                        }
                    }
                }


                if (Yii::app()->mobileDetected->ismobile()) {               
                    $mobile = 1;
                    $css = $proyect . 'mobile';
                    $this->layout = 'main_mobile';

                } else {
                    $mobile = 0;
                    $css = $proyect;
                    $this->layout = Yii::app()->params['dataBases'][$proyect]['layout'];
                }

    //            $dbname = Yii::app()->params['dataBases'][$proyect]['dbname'];
    //            $host = Yii::app()->params['dataBases'][$proyect]['connectionString'] . $dbname;
    //            $username = Yii::app()->params['dataBaseConfig']['user'];
    //            $psw = Yii::app()->params['dataBaseConfig']['pass'];
    //
    //            Yii::app()->setComponent('db', Yii::createComponent(array(
    //                        'class' => 'CDbConnection',
    //                        'connectionString' => $host,
    //                        'emulatePrepare' => true,
    //                        'username' => $username,
    //                        'password' => $psw,
    //                        'charset' => 'utf8',
    //                        'enableProfiling' => true,
    //                        'enableParamLogging' => true
    //            )));

                $dateTime = new DateTime('NOW');
                $systemUpdateTime = '?'.file_get_contents(Yii::app()->params['baseUrlJson'].'/json/systemUpdateTime.js?'.$dateTime->format('YmdHis'));

                Yii::app()->clientScript->registerCssFile(Yii::app()->params['baseUrl'] . '/css/' . $css . '.css'.$systemUpdateTime);

                Yii::app()->clientScript->registerCoreScript('jquery');

                Yii::app()->clientScript->registerCssFile(Yii::app()->params['baseUrl'] . '/js/uploadify/uploadify.css');
                Yii::app()->clientScript->registerCssFile(Yii::app()->params['baseUrl'] . '/js/jquery-te/jquery-te-1.4.0.css');
                Yii::app()->clientScript->registerCssFile(Yii::app()->params['baseUrl'] . '/js/agile/agile_carousel.css');

                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrlJson'] .'/json/'.$proyect. '/jsonRankingTotal.js'.$systemUpdateTime);
                if($proyect == 'cristal'){
                    Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrlJson'] .'/json/'.$proyect. '/jsonRankingOctavos.js'.$systemUpdateTime);
                }

                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrlJson'] .'/json/'.$proyect. '/jsonNoticiasDestacados.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrlJson'] .'/json/jsonVersus.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrlJson'] .'/js/rankingHelper.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrlJson'] .'/js/usuarioModel.js'.$systemUpdateTime);

                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/uploadify/jquery.uploadify.min.js');
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/easing/jquery.easing.1.3.js');
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/jquery-te/jquery-te-1.4.0.min.js');
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/agile/agile_carousel.alpha.js');
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/graffi/jquery.history.js');
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/graffi/jquery.galleriffic.js');
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/graffi/jquery.opacityrollover.js');

                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/config.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/controller.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/analytic.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/shared.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/documento.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/prediccion.js'.$systemUpdateTime);

                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/landing.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/home.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/mobile.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/jugar.js'.$systemUpdateTime);            
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/pais.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/grupo.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/versus.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/usuario.js'.$systemUpdateTime);            
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/ranking.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/buscar.js'.$systemUpdateTime);            
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/like.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/likegaleria.js'.$systemUpdateTime);

                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/twitter.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/site.js'.$systemUpdateTime);            
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/noticia.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/premio.js'.$systemUpdateTime);
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/calendario.js'.$systemUpdateTime);            
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/galeria.js'.$systemUpdateTime);


                if (preg_match("/admin/i", Yii::app()->controller->id)) {
                    Yii::app()->useDatabase->now();
                    Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/' . strtolower(Yii::app()->controller->id) . '.js'.$systemUpdateTime);
                }

    //            Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/adminpanel.js');
    //            Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/adminanalytics.js');
    //            Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/admincache.js');
    //            Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/adminversus.js');
    //            Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/adminarticulo.js');
    //            Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/adminpremio.js');
    //            Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/adminusuario.js');
    //            Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/admintwitter.js');
    //            Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/admincomentario.js');
    //            Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/adminranking.js');
    //            Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/admingaleria.js');
    //            Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/adminestadosistema.js');

                //Js clientes
                Yii::app()->clientScript->registerScriptFile(Yii::app()->params['baseUrl'] . '/js/' . $proyect . '.js'.$systemUpdateTime);

                Yii::app()->clientScript->registerScript('config', 'Config.baseUrl = "' . Yii::app()->params['baseUrl'] . '";');
                Yii::app()->clientScript->registerScript('configImg', 'Config.baseUrlImg = "' . Yii::app()->params['baseUrlImg'] . '";');
                Yii::app()->clientScript->registerScript('configMobile', 'Config.isMobile = ' . $mobile . ';');
                Yii::app()->clientScript->registerScript('configProject', 'Config.project = "' . Yii::app()->session['project'] . '";');

                if(Yii::app()->user->id != 0){
                    Yii::app()->clientScript->registerScript('configUserId', 'Config.user.id = ' . Yii::app()->user->id . ';');
                    Yii::app()->clientScript->registerScript('configUserPi', 'Config.user.pi = ' . Yii::app()->session['pi'] . ';');
                    Yii::app()->clientScript->registerScript('configUserPn', 'Config.user.pn = "' . Yii::app()->session['pn'] . '";');
                    Yii::app()->clientScript->registerScript('configUserEi', 'Config.user.ei = ' . Yii::app()->session['ei'] . ';');
                    Yii::app()->clientScript->registerScript('configUserEn', 'Config.user.en = "' . Yii::app()->session['en'] . '";');
                    Yii::app()->clientScript->registerScript('configUserAi', 'Config.user.ai = ' . Yii::app()->session['ai'] . ';');
                    Yii::app()->clientScript->registerScript('configUserAn', 'Config.user.an = "' . Yii::app()->session['an'] . '";');
                    Yii::app()->clientScript->registerScript('sharedSetVersus', 'Shared.setVersus();');
                }

                $jsClassName = str_replace('Controller', '', get_class(Yii::app()->getController()));
                $jsObjectName = lcfirst($jsClassName);

                Yii::app()->clientScript->registerScript(Yii::app()->controller->id . '_init', 'var ' . $jsObjectName . ' = new ' . $jsClassName . '();');
                Yii::app()->clientScript->registerScript(Yii::app()->controller->id, $jsObjectName . '.' . Yii::app()->controller->action->id . '();');
            }
            return true;
        }

        return false;
    }

}
