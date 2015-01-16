<?php

class AdminComentarioController extends Controller {

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
                'actions' => array('create', 'update','delete','admin'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {

            $this->layout = 'main_admin';
            $model = $this->loadModel($id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Comentario'])) {
                $model->attributes = $_POST['Comentario'];
                if ($model->save())
                    $this->redirect(array('admin'));
            }

            $this->render('update', array(
                'model' => $model,
            ));
        } else {
            header('Location: ' . '../home');
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {

            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }else {
            header('Location: ' . '../home');
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {

            $this->layout = 'main_admin';
            $dataProvider = new CActiveDataProvider('Comentario');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        } else {
            header('Location: ' . '../home');
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {

            $this->layout = 'main_admin';
            $model = new Comentario('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Comentario']))
                $model->attributes = $_GET['Comentario'];

            $this->render('admin', array(
                'model' => $model,
            ));
        } else {
            header('Location: ' . '../home');
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Comentario the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $this->layout = 'main_admin';
        $model = Comentario::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Comentario $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'comentario-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
