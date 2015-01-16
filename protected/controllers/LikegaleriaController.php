<?php

class LikegaleriaController extends Controller {

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
                'actions' => array('getLike', 'setLike'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionSetLike($id) {
        Yii::app()->useDatabase->now();
        $usr = Usuario::model()->findByPk(Yii::app()->user->id);
        if ($id != '0') {

            $criteria = new CDbCriteria;
            $criteria->compare('usuario_id', $usr->usuario_id);
            $criteria->compare('galeria_id', $id);
            $ComprobarLike = LikeGaleria::model()->findAll($criteria);
            if (count($ComprobarLike) == 0) {
                $fechaCreacion = new DateTime('NOW');
                $likeGaleria = new LikeGaleria();
                $likeGaleria->fecha_creacion = $fechaCreacion->format('Y-m-d H:i:s');
                $likeGaleria->galeria_id = $id;
                $likeGaleria->usuario_id = $usr->usuario_id;
                $likeGaleria->insert();
            } else {
                $criteria = new CDbCriteria;
                $criteria->compare('usuario_id', $usr->usuario_id);
                $criteria->compare('galeria_id', $id);
                LikeGaleria::model()->deleteAll($criteria);
            }

            $criteria = new CDbCriteria;
            $criteria->compare('galeria_id', $id);
            $listLike = LikeGaleria::model()->findAll($criteria);
            $Con = count($listLike);
            $arr = array('count' => $Con);
            echo CJSON::encode($arr);
        } else {
            
            $sqlGaleria = 'select * from galeria Order by galeria_id asc limit 1';
            $galeria = Yii::app()->db->createCommand($sqlGaleria)->queryAll();
            
            $criteria = new CDbCriteria;
            $criteria->compare('usuario_id', $usr->usuario_id);
            $criteria->compare('galeria_id', $galeria[0]['galeria_id']);
            $ComprobarLike = LikeGaleria::model()->findAll($criteria);
            if (count($ComprobarLike) == 0) {
                $fechaCreacion = new DateTime('NOW');
                $likeGaleria = new LikeGaleria();
                $likeGaleria->fecha_creacion = $fechaCreacion->format('Y-m-d H:i:s');
                $likeGaleria->galeria_id = $galeria[0]['galeria_id'];
                $likeGaleria->usuario_id = $usr->usuario_id;
                $likeGaleria->insert();
            } else {
                $criteria = new CDbCriteria;
                $criteria->compare('usuario_id', $usr->usuario_id);
                $criteria->compare('galeria_id', $galeria[0]['galeria_id']);
                LikeGaleria::model()->deleteAll($criteria);
            }

            $criteria = new CDbCriteria;
            $criteria->compare('galeria_id', $galeria[0]['galeria_id']);
            $listLike = LikeGaleria::model()->findAll($criteria);
            $Con = count($listLike);
            $arr = array('count' => $Con);
            echo CJSON::encode($arr);
        }
    }

    public function actionGetLike($id) {
        Yii::app()->useDatabase->now();
        if($id != '0'){
            
            $criteria = new CDbCriteria;
            $criteria->compare('galeria_id', $id);
            $listLike = LikeGaleria::model()->findAll($criteria);
            $Con = count($listLike);
            $arr = array('count' => $Con);
            echo CJSON::encode($arr);
            
        }else{
            
            $sqlGaleria = 'select * from galeria Order by galeria_id asc limit 1';
            $galeria = Yii::app()->db->createCommand($sqlGaleria)->queryAll();
            

            
            $criteria = new CDbCriteria;
            $criteria->compare('galeria_id', $galeria[0]['galeria_id']);
            $listLike = LikeGaleria::model()->findAll($criteria);
            $Con = count($listLike);
            $arr = array('count' => $Con);
            echo CJSON::encode($arr);
        }
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('LikeGaleria');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function loadModel($id) {
        $model = LikeGaleria::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param LikeGaleria $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'like-galeria-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
