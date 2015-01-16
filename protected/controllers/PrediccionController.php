<?php

class PrediccionController extends Controller {

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
                'actions' => array('ajaxList', 'ajaxUpdate'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    /* @var $prediccion Prediccion */
    public function actionAjaxList() {
        if (!Yii::app()->user->isGuest) {
            Yii::app()->useDatabase->now();
            if (Yii::app()->session['project'] == 'dcv') {

                $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
                $area_id = $usuario->area_id;
                $criteria = new CDbCriteria();
                $criteria->addInCondition('empresa_id', array('2'));
                $criteria->addInCondition('area_id', array($area_id));
                $usuario = Usuario::model()->find($criteria);
                $usuario_id = $usuario->usuario_id;
            } else {
                $usuario_id = Yii::app()->user->id;
            }

            $criteria = new CDbCriteria();
            $criteria->compare('usuario_id', $usuario_id);
            $criteria->order = 'versus_id ASC, fecha_actualizacion ASC';
            $listPrediccion = Prediccion::model()->findAll($criteria);
            
            $listPrediccionFix = array();
            foreach($listPrediccion as $prediccion){
                $listPrediccionFix[$prediccion->versus_id] = $prediccion;
            }

            echo CJSON::encode($listPrediccionFix);
        }
    }

    public function actionAjaxUpdate($id = null, $goles_a = null, $goles_b = null) {


        if (!Yii::app()->user->isGuest) {
            Yii::app()->useDatabase->now();
            $response = 'ok';

            if (Yii::app()->session['project'] == 'dcv') {
                $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
                $area_id = $usuario->area_id;
                $criteria = new CDbCriteria();
                $criteria->addInCondition('empresa_id', array('2'));
                $criteria->addInCondition('area_id', array($area_id));
                $usuario = Usuario::model()->find($criteria);
                $usuario_id = $usuario->usuario_id;

                if (Yii::app()->user->id != $usuario_id) {
                    $response = 'error-grupo';
                }
            } else {
                $usuario_id = Yii::app()->user->id;
            }

            if ($response == 'ok') {
                $dateNow = new DateTime('NOW');
        
                 //check 5 mins time
                $versus = Versus::model()->findByPk($id);

                $canPlayStatus = $versus->canplay;

//                $versusFecha = new DateTime($versus->fecha);
//
//                //check dates
//                if ($dateNow->format('Y-m-d') < $versusFecha->format('Y-m-d')) {                    
//                    $canPlayStatus = true;
//                }
//                
//                if ($versusFecha->format('Y-m-d') == $dateNow->format('Y-m-d')) {
//                    
//                    $hoursToMinsItem = $versusFecha->format('H') * 60;
//                    $hoursToMinsNow = $dateNow->format('H') * 60;
//                    $minDiff = ($hoursToMinsNow + $dateNow->format('i')) - ($hoursToMinsItem + $versusFecha->format('i'));
//                    $hourDiff = floor($minDiff / 60);
//
//                    if ($hourDiff < 0) {
//                        //hora anterior   
//                        if ($minDiff < 0) {
//
//                            if ($minDiff >= -5) {
//                                $canPlayStatus = false;
//                            }
//                        }
//                    }
//
//                    if ($hourDiff == 0) {
//                        //misma hora
//                        $canPlayStatus = false;
//                    }
//
//                    if ($hourDiff > 0) {
//                        //hora superada
//                        $canPlayStatus = false;
//                    }
//                }
//
//                if ($dateNow->format('Y-m-d') > $versusFecha->format('Y-m-d')) {                    
//                    $canPlayStatus = false;
//                }

                if ($canPlayStatus == 1) {

                    $criteria = new CDbCriteria();
                    $criteria->compare('usuario_id', Yii::app()->user->id);
                    $criteria->compare('versus_id', $id);
                    $criteria->order = 'fecha_actualizacion DESC';
                    $criteria->limit = '1';
                    $prediccion = Prediccion::model()->find($criteria);

                    $isNewRecord = false;
                    if ($prediccion == null) {
                        $prediccion = new Prediccion();
                        $isNewRecord = true;                     
                    }

                    $prediccion->fecha_actualizacion = $dateNow->format('Y-m-d H:i:s');
                    $prediccion->usuario_id = Yii::app()->user->id;
                    $prediccion->versus_id = $id;

                    if ($goles_a != null) {
                        $prediccion->goles_a = $goles_a;
                    } else {
                        $prediccion->goles_a = $prediccion->goles_a;
                    }

                    if ($goles_b != null) {
                        $prediccion->goles_b = $goles_b;
                    } else {
                        $prediccion->goles_b = $prediccion->goles_b;
                    }

                    if($isNewRecord){                        
                        $prediccion->insert();
                    }else{
                        $prediccion->update();
                    }                    

                    $response = 'ok';
                } else {
                    $response = 'out-of-time';
                }
            }
            
            echo $response;
        }        
    }
}
