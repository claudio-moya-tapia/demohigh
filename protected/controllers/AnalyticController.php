<?php

class AnalyticController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /* @var $usuario Usuario */

    public function actionCreate($url = null) {
        $this->layout = null;

        if ($url != null) {
            Yii::app()->useDatabase->now();
            $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
//            
//            $dateStart = new DateTime('2014-06-14');
//            $dateEnd = new DateTime('2014-07-13');
            $dateNow = new DateTime('NOW');
//            
//            $analytics = 'analytics';
//            
//            if($dateNow >= $dateStart){
//                
//                if($dateNow <= $dateEnd){                    
//                    $analytics .= '_'.$dateNow->format('Y-m-d');                    
//                }                
//            }
//            
            $sql = "INSERT INTO analytics (fecha_creacion, url, usuario_id, nombre_completo, empresa_id, empresa_nombre, area_id, area_nombre) ";
            $sql .= "VALUES ('" . $dateNow->format('Y-m-d H:i:s') . "', '" . $url . "', '" . $usuario->usuario_id . "','" . $usuario->nombre . " " . $usuario->apellido_paterno . "', '" . $usuario->empresa_id . "', '" . $usuario->empresa->nombre . "', '" . $usuario->area_id . "', '" . $usuario->area->nombre . "');";

            Yii::app()->db->createCommand($sql)->query();
            $response = 'ok';
           
        }else{
            $response = 'error';
        }
        
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo CJSON::encode(array('response' => $response));
    }
}