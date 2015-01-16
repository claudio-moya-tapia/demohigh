<?php

class MobileController extends Controller {

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
                'actions' => array('index', 'noticia', 'articulo', 'ranking'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /* @var $versus Versus */

    public function actionIndex() {
        $this->json();
        //$this->normal();
    }
    
    private function json(){
        Yii::app()->useDatabase->now();
        $criteria = new CDbCriteria();
        $criteria->order = 'articulo_id DESC';
        $criteria->compare('estado_articulo_id', '1');
        $listArticulo = Articulo::model()->findAll($criteria);
        
        $this->render('index_json',array(
            'listArticulo' => $listArticulo
        ));
    }

    private function normal(){
        $usuarioLocal = Usuario::model()->findByPk(Yii::app()->user->id);

        //empresa
        $criteria = new CDbCriteria();
        $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
        $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
        $criteria->limit = 3;

        $listUsuario = Usuario::model()->findAll($criteria);
        $usuarioRankingEmpresa = $this->getRankingUser('empresa', $usuarioLocal);

        //area
        $criteria = new CDbCriteria();
        $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
        $criteria->compare('empresa_id', $usuarioLocal->empresa_id);
        $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
        $criteria->limit = 3;

        $listUsuarioArea = Usuario::model()->findAll($criteria);
        $usuarioRankingArea = $this->getRankingUser('area', $usuarioLocal);


        $criteria = new CDbCriteria();
        $criteria->order = 'articulo_id DESC';
        $criteria->compare('estado_articulo_id', '1');
        $listArticulo = Articulo::model()->findAll($criteria);

        $this->render('index', array(
            'usuarioLocal' => $usuarioLocal,
            'usuarioRankingEmpresa' => $usuarioRankingEmpresa,
            'usuarioRankingArea' => $usuarioRankingArea,
            'listUsuario' => $listUsuario,
            'listUsuarioArea' => $listUsuarioArea,
            'listArticulo' => $listArticulo
        ));
    }
    
    public function actionNoticia() {
        Yii::app()->useDatabase->now();
        $criteria = new CDbCriteria();
        $criteria->order = 'articulo_id DESC';
        $criteria->compare('estado_articulo_id', '1');
        $listArticulo = Articulo::model()->findAll($criteria);

        $this->render('noticias', array(
            'listArticulo' => $listArticulo
        ));
    }

    public function actionArticulo($id) {

        $articulo = Articulo::model()->findByPk($id);

        $this->render('articulo', array(
            'articulo' => $articulo
        ));
    }

    public function actionRanking() {
        $this->rankingJson();
        //$this->rankingNormal();
    }
    
    private function rankingJson(){
        $this->render('ranking_json');
    }
    
    private function rankingNormal(){
        Yii::app()->useDatabase->now();
        $usuarioLocal = Usuario::model()->findByPk(Yii::app()->user->id);

        //empresa
        $criteria = new CDbCriteria();
        $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
        $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
        $criteria->limit = 3;

        $listUsuario = Usuario::model()->findAll($criteria);
        $usuarioRankingEmpresa = $this->getRankingUser('empresa', $usuarioLocal);

        //area
        $criteria = new CDbCriteria();
        $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
        $criteria->compare('empresa_id', $usuarioLocal->empresa_id);
        $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
        $criteria->limit = 3;

        $listUsuarioArea = Usuario::model()->findAll($criteria);
        $usuarioRankingArea = $this->getRankingUser('area', $usuarioLocal);

        $this->render('ranking', array(
            'usuarioLocal' => $usuarioLocal,
            'listUsuario' => $listUsuario,
            'listUsuarioArea' => $listUsuarioArea,
            'usuarioRankingEmpresa' => $usuarioRankingEmpresa,
            'usuarioRankingArea' => $usuarioRankingArea,
        ));
    }

    /* @var $usuario Usuario */

    private function getRankingUser($tipo, $usuario) {

        switch ($tipo) {
            case 'empresa':
                $sql = 'SELECT a.rank
                        FROM (
                            SELECT @rownum := @rownum + 1 AS rank, usuario_id
                            FROM usuario, (SELECT @rownum := 0) t
                            ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                        ) a
                        WHERE usuario_id = ' . Yii::app()->user->id;
                break;
            case 'area':

                $sql = 'SELECT a.rank
                        FROM (
                            SELECT @rownum := @rownum + 1 AS rank, usuario_id
                            FROM usuario, (SELECT @rownum := 0) t
                            WHERE empresa_id = ' . $usuario->empresa_id . '
                            ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                        ) a
                        WHERE usuario_id = ' . Yii::app()->user->id;
                break;
            default:
                break;
        }

        $userRanking = Yii::app()->db->createCommand($sql)->queryRow();

        return $userRanking['rank'];
    }

}
