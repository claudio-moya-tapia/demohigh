<?php

class AdminRankingController extends Controller {

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
                'users' => array('admin'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update','setRanking'),
                'users' => array('admin'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('admin'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->layout = 'main_admin';
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->layout = 'main_admin';
        $model = new Usuario;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Usuario'])) {
            $model->attributes = $_POST['Usuario'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->usuario_id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->layout = 'main_admin';
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Usuario'])) {
            $model->attributes = $_POST['Usuario'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->usuario_id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->layout = 'main_admin';
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->layout = 'main_admin';
        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);

        $criteria = new CDbCriteria();
        $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
        $criteria->order = 'total_puntos DESC, total_plenos DESC';
        $criteria->compare('empresa_id', $usuario->empresa_id);
        $criteria->limit = 14;
        $listUsuarioEmpresa = Usuario::model()->findAll($criteria);

        $criteria = new CDbCriteria();
        $criteria->order = 'nombre DESC';
        $listUsuarioArea = Area::model()->findAll($criteria);
        $listUsuarioAreaComplete = array();
        $i = 0;
        foreach ($listUsuarioArea as $item) {

            $criteria = new CDbCriteria();
            $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
            $criteria->order = 'total_puntos DESC, total_plenos DESC';
            $criteria->compare('area_id', $item->area_id);
            $criteria->limit = 14;
            $list = Usuario::model()->findAll($criteria);
            $listUsuarioAreaComplete[] = $list;
            $i++;
        }

        $this->render('index', array(
            'listUsuarioEmpresa' => $listUsuarioEmpresa,
            'listUsuarioArea' => $listUsuarioArea,
            'listUsuarioAreaComplete' => $listUsuarioAreaComplete,
        ));
    }
    public function actionSetRanking() {
            $this->layout = 'main_admin';
            $empresas = Empresa::model()->findAll();
            $sql =  'truncate table ranking_usuario';
            Yii::app()->db->createCommand($sql)->execute();
            foreach ($empresas as $itemEmpresa) {
                
            $criteria = new CDbCriteria();
            $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos, empresa_id, area_id, usuario_pais_id';
            $criteria->order = 'total_puntos DESC, total_plenos DESC';
            $criteria->compare('empresa_id', $itemEmpresa->empresa_id);
            $criteria->limit = 3;
            
            
            $listUsuarioEmpresa = Usuario::model()->findAll($criteria);
              
                    foreach ($listUsuarioEmpresa as $itemUsuarios) {
                   
                      $sql =  'Insert Into ranking_usuario (usuario_id,nombre, apellido_paterno, apellido_materno, imagen, total_puntos, empresa_id ,area_id , usuario_pais_id , tipo_ranking_id) VALUES ("'.$itemUsuarios->usuario_id.'","'.$itemUsuarios->nombre.'","'.$itemUsuarios->apellido_paterno.'","'.$itemUsuarios->apellido_materno.'","'.$itemUsuarios->imagen.'","'.$itemUsuarios->total_puntos.'","'.$itemUsuarios->empresa_id.'","'.$itemUsuarios->area_id.'","'.$itemUsuarios->usuario_pais_id.'","1")';
                       Yii::app()->db->createCommand($sql)->execute();
                               
                        
                    }
                
            }
            exit();

        }

        
        
        
        
    public function getRanking($tipo, $usuario) {
        
        switch ($tipo) {
            case 'grupos':
                $sql = 'SELECT a.rank
                        FROM (
                            SELECT @rownum := @rownum + 1 AS rank, usuario_id
                            FROM usuario, (SELECT @rownum := 0) t  
                            WHERE empresa_id = 2
                            ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                        ) a
                        WHERE usuario_id = ' . $usuario->usuario_id;
                break;
            case 'todos':
                $sql = 'SELECT a.rank
                        FROM (
                            SELECT @rownum := @rownum + 1 AS rank, usuario_id
                            FROM usuario, (SELECT @rownum := 0) t  
                            WHERE empresa_id != 0 
                            ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                        ) a
                        WHERE usuario_id = ' . Yii::app()->user->id;
                break;
            
            case 'empresa':
                $sql = 'SELECT a.rank
                        FROM (
                            SELECT @rownum := @rownum + 1 AS rank, usuario_id
                            FROM usuario, (SELECT @rownum := 0) t
                            WHERE empresa_id = ' . $usuario->empresa_id . '
                            ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                        ) a
                        WHERE usuario_id = ' . Yii::app()->user->id;
                break;

            case 'pais':
                $sql = 'SELECT a.rank
                        FROM (
                            SELECT @rownum := @rownum + 1 AS rank, usuario_id
                            FROM usuario, (SELECT @rownum := 0) t
                            WHERE usuario_pais_id = ' . $usuario->usuario_pais_id . '
                            ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                        ) a
                        WHERE usuario_id = ' . Yii::app()->user->id;
                break;
            case 'area':

                $sql = 'SELECT a.rank
                        FROM (
                            SELECT @rownum := @rownum + 1 AS rank, usuario_id
                            FROM usuario, (SELECT @rownum := 0) t
                            WHERE area_id = ' . $usuario->area_id . '
                            ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                        ) a
                        WHERE usuario_id = ' . Yii::app()->user->id;
                break;
            case 'amigos':

                $sql = 'SELECT a.rank
                        FROM (
                            SELECT @rownum := @rownum + 1 AS rank, usuario_id
                            FROM usuario, (SELECT @rownum := 0) t
                            WHERE usuario_id IN (' . $usuario->amigos_usuario_id . ')
                            ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                        ) a
                        WHERE usuario_id = ' . Yii::app()->user->id;
                break;
            default:
                break;
        }

        $userRanking = Yii::app()->db->createCommand($sql)->queryRow();

        $numero = $userRanking['rank'];


        //search user and neighbors
        if ($numero < 10) {

            $betweenBottom = 4;
            $betweenTop = 14;
        } else {

            if ($numero % 10 != 0) {
                $countBottom = 0;
                $findBottom = true;
                $bottom = $numero;
                while ($findBottom) {

                    if ($bottom % 10 == 0) {
                        $findBottom = false;
                    } else {
                        $countBottom++;
                        $bottom--;
                    }
                }

                $countTop = 0;
                $findTop = true;
                $top = $numero;
                while ($findTop) {

                    if ($top % 10 == 0) {
                        $findTop = false;
                    } else {
                        $countTop++;
                        $top++;
                    }
                }

                $betweenBottom = ($numero - $countBottom);
                $betweenTop = ($numero + $countTop);
            } else {

                $betweenBottom = $numero;
                $betweenTop = $numero + 10;
            }
        }

        switch ($tipo) {
            case 'grupos':
                $sql = 'SELECT a.usuario_id, a.nombre,apellido_paterno,a.apellido_materno, a.imagen, a.total_puntos,a.total_plenos,a.rank 
                    FROM (
                        SELECT @rownum := @rownum + 1 AS rank, usuario_id,nombre,apellido_paterno,apellido_materno, imagen, total_puntos,total_plenos
                        FROM usuario, (SELECT @rownum := 0) t
                        WHERE empresa_id = 2
                        ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                    ) a
                    WHERE rank BETWEEN ' . $betweenBottom . ' AND ' . $betweenTop;

                break;
            case 'todos':
                $sql = 'SELECT a.usuario_id, a.nombre,apellido_paterno,a.apellido_materno, a.imagen, a.total_puntos,a.total_plenos,a.rank 
                    FROM (
                        SELECT @rownum := @rownum + 1 AS rank, usuario_id,nombre,apellido_paterno,apellido_materno, imagen, total_puntos,total_plenos
                        FROM usuario, (SELECT @rownum := 0) t
                        WHERE empresa_id != 0
                        ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                    ) a
                    WHERE rank BETWEEN ' . $betweenBottom . ' AND ' . $betweenTop;

                break;
            case 'empresa':
                $sql = 'SELECT a.usuario_id, a.nombre,apellido_paterno,a.apellido_materno, a.imagen, a.total_puntos,a.total_plenos,a.rank 
                    FROM (
                        SELECT @rownum := @rownum + 1 AS rank, usuario_id,nombre,apellido_paterno,apellido_materno, imagen, total_puntos,total_plenos
                        FROM usuario, (SELECT @rownum := 0) t
                        WHERE empresa_id = ' . $usuario->empresa_id . '
                        ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                    ) a
                    WHERE rank BETWEEN ' . $betweenBottom . ' AND ' . $betweenTop;

                break;
            case 'pais':
                $sql = 'SELECT a.usuario_id, a.nombre,apellido_paterno,a.apellido_materno, a.imagen, a.total_puntos,a.total_plenos,a.rank 
                    FROM (
                        SELECT @rownum := @rownum + 1 AS rank, usuario_id,nombre,apellido_paterno,apellido_materno, imagen, total_puntos,total_plenos
                        FROM usuario, (SELECT @rownum := 0) t
                        WHERE usuario_pais_id = ' . $usuario->usuario_pais_id . '
                        ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                    ) a
                    WHERE rank BETWEEN ' . $betweenBottom . ' AND ' . $betweenTop;

                break;
            case 'area':
                $sql = 'SELECT a.usuario_id, a.nombre,apellido_paterno,a.apellido_materno, a.imagen, a.total_puntos,a.total_plenos,a.rank 
                    FROM (
                        SELECT @rownum := @rownum + 1 AS rank, usuario_id,nombre,apellido_paterno,apellido_materno, imagen, total_puntos,total_plenos
                        FROM usuario, (SELECT @rownum := 0) t
                        WHERE area_id = ' . $usuario->area_id . '
                        ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                    ) a
                    WHERE rank BETWEEN ' . $betweenBottom . ' AND ' . $betweenTop;

                break;
            case 'amigos':
                $sql = 'SELECT a.usuario_id, a.nombre,apellido_paterno,a.apellido_materno, a.imagen, a.total_puntos,a.total_plenos,a.rank 
                    FROM (
                        SELECT @rownum := @rownum + 1 AS rank, usuario_id,nombre,apellido_paterno,apellido_materno, imagen, total_puntos,total_plenos
                        FROM usuario, (SELECT @rownum := 0) t
                        WHERE usuario_id IN (' . $usuario->amigos_usuario_id . ')
                        ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                    ) a
                    WHERE rank BETWEEN ' . $betweenBottom . ' AND ' . $betweenTop;

                break;
            default:
                break;
        }

        return Usuario::model()->findAllBySql($sql);
    }
    
    
    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->layout = 'main_admin';
        $model = new Usuario('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Usuario']))
            $model->attributes = $_GET['Usuario'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Usuario the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $this->layout = 'main_admin';
        $model = Usuario::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Usuario $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'usuario-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
