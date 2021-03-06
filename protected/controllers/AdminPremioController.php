<?php

class AdminPremioController extends Controller {

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->layout = 'main_admin';
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3)
        {        
                $model = new Premio;
                if (isset($_POST['Premio'])) {
                    $model->attributes = $_POST['Premio'];

                    $fechaCreacion = new DateTime('NOW');
                    $model->fecha_creacion = $fechaCreacion->format('Y-m-d H:i:s');

                    if ($model->save())
                        $this->redirect(array('admin'));
                }

                $this->render('create', array(
                    'model' => $model,
                ));
        }else{
            header('Location: '.'../home');
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->layout = 'main_admin';
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3)
        {
                $model = $this->loadModel($id);
                if (isset($_POST['Premio'])) {
                    $model->attributes = $_POST['Premio'];
                    if ($model->save())
                        $this->redirect(array('admin'));
                }

                $this->render('update', array(
                    'model' => $model,
                ));
        }else
        {
            header('Location: '.'../../home');
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->layout = 'main_admin';
         $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3)
        {
                    $model = new Premio('search');
                    $model->unsetAttributes();  // clear any default values
                    if (isset($_GET['Premio']))
                        $model->attributes = $_GET['Premio'];

                    $this->render('admin', array(
                        'model' => $model,
                    ));
        }else
        {
            header('Location: '.'../home');
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Premio the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Premio::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Premio $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'premio-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
