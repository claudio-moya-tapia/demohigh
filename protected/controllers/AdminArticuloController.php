<?php

class AdminArticuloController extends Controller {

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
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'createGeneral', 'updateGeneral', 'deleteGeneral'),
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
    
    private function cacheDestacados(){
        Yii::app()->useDatabase->now();
        $project = Yii::app()->session['project'];
        $options = [ 'gs' => [ 'Content-Type' => 'application/javascript', 'acl' => 'public-read', 'read_cache_expiry_seconds'=>300]];
        $ctx = stream_context_create($options);
        
        $ranking = 'jsonNoticiasDestacados';
                
        $criteria = new CDbCriteria();
        $criteria->select = 'articulo_id,titulo,imagen';
        $criteria->compare('tipo_destacado_id', '1');
        $criteria->compare('estado_articulo_id', '1');
        $criteria->order = 'articulo_id DESC';
        $listArticulo = Articulo::model()->findAll($criteria);

        $aryDestacado = array();
        foreach ($listArticulo as $articulo) {
            $url = Yii::app()->params['baseUrl'] . '/noticia/' . $articulo->articulo_id . '?' . $articulo->titulo;
            $img = Yii::app()->params['baseUrlImg'] . $articulo->imagen;
            $titulo = $articulo->titulo;

            $aryDestacado[] = array(
                'url'=>$url,
                'img'=>$img,
                'titulo'=>$titulo
            );
        }
                        
        if($_SERVER['HTTP_HOST'] == '192.168.1.49'){
            //Local
            $basePath = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/'.$project.'/'.$ranking.'_tmp.js';
            $basePathFinal = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/'.$project.'/'.$ranking.'.js';
                        
        }else{
            //Google
            $basePath = Yii::app()->params['baseUrlGs'].'/json/'.$project.'/'.$ranking.'_tmp.js';            
            $basePathFinal = Yii::app()->params['baseUrlGs'].'/json/'.$project.'/'.$ranking.'.js';            
        }
        
        file_put_contents($basePath, 'var '.$ranking.' = '.CJSON::encode($aryDestacado).';');

        rename($basePath, $basePathFinal, $ctx);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->layout = 'main_admin';
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {
            $model = new Articulo;
            if (isset($_POST['Articulo'])) {
                $model->attributes = $_POST['Articulo'];

                $fechaCreacion = new DateTime('NOW');
                $model->fecha_creacion = $fechaCreacion->format('Y-m-d H:i:s');
                $model->fecha_actualizacion = $fechaCreacion->format('Y-m-d H:i:s');

                if ($model->save()){
                    $this->cacheDestacados();
                    $this->redirect(array('admin'));
                }
                    
            }

            $this->render('create', array(
                'model' => $model,
            ));
        }else {
            header('Location: ' . '../home');
        }
    }

    public function actionDeleteGeneral() {
        $arrayBase = Yii::app()->params['dataBases'];

        foreach ($arrayBase as $key => $value) {
            $this->deleteNoticia($key, $value['dbname']);
        }
    }

    public function deleteNoticia($proyect, $base) {

        $host = Yii::app()->params['dataBases'][$proyect]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);

        echo $sql = '
        DELETE FROM ' . $base . '.articulo WHERE origen_id != 0;';
    }

    public function actionCreateGeneral() {
        $this->layout = 'main_admin';
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if ($usuario->tipo_usuario_id == 3) {
            $model = new Articulo;
            if (isset($_POST['Articulo'])) {
                $model->attributes = $_POST['Articulo'];
                $fechaCreacion = new DateTime('NOW');
                $model->fecha_creacion = $fechaCreacion->format('Y-m-d H:i:s');
                $model->fecha_actualizacion = $fechaCreacion->format('Y-m-d H:i:s');

                if ($model->save()) {
                    $arrayBase = Yii::app()->params['dataBases'];
                    unset($arrayBase['rayalab']);

                    foreach ($arrayBase as $key => $value) {
                        $this->noticias($model, $key, $value['dbname']);
                    }

                    $this->redirect(array('admin'));
                }
            }

            $this->render('create_general', array(
                'model' => $model,
            ));
        } else {
            //header('Location: ' . '../home');
        }
    }

    public function actionUpdateGeneral($id) {

        $this->layout = 'main_admin';
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if ($usuario->tipo_usuario_id == 3) {
            $model = $this->loadModel($id);
            if (isset($_POST['Articulo'])) {
                $model->attributes = $_POST['Articulo'];
                $model->setAttribute('texto', $_POST['Articulo']['texto']);
                $model->setAttribute('bajada', $_POST['Articulo']['bajada']);
                $model->setAttribute('titulo', $_POST['Articulo']['titulo']);
                $model->setAttribute('imagen', $_POST['Articulo']['imagen']);
                if ($model->save()) {
                    $arrayBase = Yii::app()->params['dataBases'];
                    unset($arrayBase['rayalab']);
                    foreach ($arrayBase as $key => $value) {
                        $this->noticiasUpdate($model, $key, $value['dbname']);
                    }
                }

                $this->redirect(array('admin'));
            }

            $this->render('update_general', array(
                'model' => $model,
            ));
        } else {
            //header('Location: ' . '../home');
        }
    }

    private function noticias($model, $proyect, $base) {

        //$proyect = Yii::app()->session['project'];
        $host = Yii::app()->params['dataBases'][$proyect]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);
        $noticia = new Articulo();
        $fechaCreacion = new DateTime('NOW');
        $noticia->fecha_actualizacion = $fechaCreacion->format('Y-m-d H:i:s');
        $noticia->fecha_creacion = $fechaCreacion->format('Y-m-d H:i:s');
        $noticia->tipo_destacado_id = 1;
        $noticia->estado_articulo_id = 2;
        $noticia->texto = $model->texto;
        $noticia->bajada = $model->bajada;
        $noticia->titulo = $model->titulo;
        $noticia->imagen = $model->imagen;
        $noticia->orden = $model->orden;
        $noticia->origen_id = $model->articulo_id;
        $noticia->insert();
    }

    private function noticiasUpdate($model, $proyect, $base) {

        echo '<br>$base '.$base;
        echo '<br>proyect '.$proyect;
        echo '<br>articulo_id '.$model->articulo_id;
        
        $host = Yii::app()->params['dataBases'][$proyect]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        
        echo '<br>$host '.$host;
        echo '<br>$username '.$username;
        echo '<br>$psw '.$psw;
        
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);

        $criteria = new CDbCriteria();
        $criteria->compare('origen_id', $model->articulo_id);
        $noticia = Articulo::model()->find($criteria);
        $noticia->setAttribute('texto', $model->texto);
        $noticia->setAttribute('bajada', $model->bajada);
        $noticia->setAttribute('titulo', $model->titulo);
        $noticia->setAttribute('imagen', $model->imagen);
        $noticia->update();
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->layout = 'main_admin';
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {
            $model = $this->loadModel($id);
            if (isset($_POST['Articulo'])) {
                $model->attributes = $_POST['Articulo'];

                if ($model->save()){
                    $this->cacheDestacados();
                    $this->redirect(array('admin'));
                }
                    
            }

            $this->render('update', array(
                'model' => $model,
                'usuario' => $usuario,
            ));
        }else {
            header('Location: ' . '../../home');
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {

        $model = $this->loadModel($id);
        $model->setAttribute('estado_articulo_id', 3);

        if ($model->save())
            $this->redirect(array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->layout = 'main_admin';
        $usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        if ($usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 3) {
            $model = new Articulo('search');

            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Articulo'])) {
                $model->attributes = $_GET['Articulo'];
            }

            $this->render('admin', array(
                'model' => $model,
                'usuario' => $usuario,
            ));
        } else {
            header('Location: ' . '../home');
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Articulo the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Articulo::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Articulo $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'articulo-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
