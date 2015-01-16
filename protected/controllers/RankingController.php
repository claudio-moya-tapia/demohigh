<?php

class RankingController extends Controller {

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
                'actions' => array('index', 'search', 'ajaxList','top100','top100cuartosyoctavos'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAjaxList() {

        $memcache = new Memcache;
        $memcache->addserver('localhost');
        
        $key = 'test';
        $data = $memcache->get($key);
        if ($data === false) {

            $data = new DateTime('NOW');

            $memcache->set($key, $data, false, 30);
        }


//        $date = new DateTime('NOW');
//
//        $id = 'poando';
//
//        $value = Yii::app()->cache->get($id);
//        if ($value === false) {
//            $value = $date->format('Y-m-d H:m:s');
//            Yii::app()->cache->set($id, $value, 30);
//        }
//
//        echo $value;
//        
//        $sql = 'SELECT 
//                    @rownum := @rownum + 1 AS rank, 
//                    usuario_id, total_puntos, imagen, empresa_id, area_id, amigos_usuario_id
//                FROM usuario, (SELECT @rownum := 0) t  
//                ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC';
//        $aryRankingUsers = Yii::app()->db->createCommand($sql)->queryAll();
//        $aryRanking = array();
//        
//        foreach ($aryRankingUsers as $ranking){
//            $aryRanking[] = array(
//                'usuario_id'=>$ranking['usuario_id'],
//                'empresa_id'=>$ranking['empresa_id'],
//                'area_id'=>$ranking['area_id'],
//                'amigos_usuario_id'=>$ranking['amigos_usuario_id'],
//                'total_puntos'=>$ranking['total_puntos'],
//                'rank'=>$ranking['rank'],
//                'url'=>$ranking['rank'],
//                'avatar'=>CHtml::link(CHtml::image(Yii::app()->params['baseUrlImg'].$ranking['imagen'],'Perfil'), array('usuario/'.$ranking['usuario_id']),array('class'=>'')),
//                'nombre'=>Yii::app()->aesManager->decrypt($ranking['nombre']).' '.Yii::app()->aesManager->decrypt($ranking['apellido_paterno']),
//            );
//        }
//                
//        header('Content-type: text/json');
//        header('Content-type: application/json');
//        echo CJSON::encode($aryRanking);
    }

    /* @var $usuario Usuario */

    public function actionIndex() {

        //$this->normal();
        $this->json();
        
    }
    
    private function json(){
        $this->render('index_json');
    }
    
    private function normal(){
        
        $numero = 0;
        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);

        if (Yii::app()->session['project'] == 'dcv') {
            $area_id = $usuario->area_id;
            $criteria = new CDbCriteria();
            $criteria->addInCondition('empresa_id', array('2'));
            $criteria->addInCondition('area_id', array($area_id));
            $usuario = Usuario::model()->find($criteria);

            $criteria = new CDbCriteria();
            $criteria->order = 'nombre DESC';
            $liArea = Area::model()->findAll($criteria);

            //grupos empresas
            $criteria = new CDbCriteria();
            $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
            $criteria->addInCondition('empresa_id', array('2'));
            $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
            $criteria->limit = 3;

            $usuario_id_grupo = $usuario->usuario_id;
            $listUsuarioGrupos = Usuario::model()->findAll($criteria);
            $listUsuarioRankingGrupos = $this->getRanking('grupos', $usuario);
        }

        $criteria = new CDbCriteria();
        $criteria->order = 'nombre DESC';
        $liArea = Area::model()->findAll($criteria);

        //todos empresas
        $criteria = new CDbCriteria();
        $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
        $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
        $criteria->limit = 3;

        $listUsuarioTodos = Usuario::model()->findAll($criteria);
        $listUsuarioRankingTodos = $this->getRanking('todos', $usuario);

        //$listUsuarioTodos obtener datos de ranking_usuario top 0,3
        //recorrercon foreach ranking_usuario y crear nuevo array conmodelo usuario
        //$listUsuarioRankingTodos obtener datos de ranking_usuario top 3,14
        //recorrercon foreach ranking_usuario y crear nuevo array conmodelo usuario
        //empresa
        $criteria = new CDbCriteria();
        $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
        $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';        
        $criteria->limit = 3;

        $listUsuario = Usuario::model()->findAll($criteria);
        $listUsuarioRanking = $this->getRanking('empresa', $usuario);

        //pais
        $criteria = new CDbCriteria();
        $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
        $criteria->compare('usuario_pais_id', $usuario->usuario_pais_id);
        $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
        $criteria->limit = 3;

        $listUsuarioPais = Usuario::model()->findAll($criteria);
        $listUsuarioRankingPais = $this->getRanking('pais', $usuario);
        //area
        $criteria = new CDbCriteria();
        $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
        $criteria->compare('area_id', $usuario->area_id);
        $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
        $criteria->limit = 3;

        $listUsuarioArea = Usuario::model()->findAll($criteria);
        $listUsuarioRankingArea = $this->getRanking('area', $usuario);

        //amigos
        $aryAmigosId = explode(',', $usuario->amigos_usuario_id);
        $criteria = new CDbCriteria();
        $criteria->order = 'nombre';
        $listArea = CHtml::listData(Area::model()->findAll($criteria), 'area_id', 'nombre');
        if (count($aryAmigosId) > 1) {

            $criteria = new CDbCriteria();
            $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
            $criteria->addInCondition('usuario_id', $aryAmigosId);
            $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
            $criteria->limit = 3;

            $listUsuarioAmigos = Usuario::model()->findAll($criteria);
            $listUsuarioRankingAmigos = $this->getRanking('amigos', $usuario);
        } else {
            $listUsuarioAmigos = array();
            $listUsuarioRankingAmigos = array();
        }

        $showGrupos = false;

        switch (Yii::app()->session['project']) {
            case 'bbva':
                $tituloEmpresa = 'Grupo BBVA';
                $tituloPais = 'División';
                $tituloArea = 'Area';
                $tituloMisAmigos = 'Mis Amigos';
                $showPais = true;
                $showArea = true;
                $showTodos = false;
                $showEmpresa = true;
                $showAmigos = true;
                break;
            case 'santander':
                $tituloEmpresa = 'Ranking Santander';
                $tituloPais = '';
                $tituloArea = 'Ranking ' . $usuario->area->nombre;
                $tituloMisAmigos = 'Mis Amigos';
                $showPais = false;
                $showArea = true;
                $showTodos = false;
                $showEmpresa = true;
                $showAmigos = true;
                break;
            case 'skchile':
                $tituloEmpresa = 'Ranking Empresa';
                $tituloPais = 'Ranking País';
                $tituloArea = 'Ranking ' . $usuario->area->nombre;
                $tituloMisAmigos = 'Ranking Mis Amigos';
                $showPais = false;
                $showArea = false;
                $showTodos = false;
                $showEmpresa = true;
                $showAmigos = true;
                break;
            case 'cchc':
                $tituloEmpresa = 'Ranking Empresa';
                $tituloPais = 'Ranking País';
                $tituloArea = 'Ranking ' . $usuario->area->nombre;
                $tituloMisAmigos = 'Ranking Mis Amigos';
                $showPais = false;
                $showArea = false;
                $showTodos = false;
                $showEmpresa = true;
                $showAmigos = true;
                break;
            case 'afphabitat':
                $tituloEmpresa = 'Ranking Empresa';
                $tituloPais = 'Ranking País';
                $tituloArea = 'Ranking Gerencia ' . $usuario->area->nombre;
                $tituloMisAmigos = 'Ranking Mis Amigos';
                $showPais = false;
                $showArea = true;
                $showTodos = false;
                $showEmpresa = true;
                $showAmigos = true;
                break;
            case 'cristal':
                $tituloEmpresa = 'Ranking Total CCU';
                $tituloPais = 'Ranking País';
                $tituloArea = 'Ranking UEN CCU';
                $tituloMisAmigos = 'Ranking Mis Amigos';
                $showPais = false;
                $showArea = true;
                $showTodos = false;
                $showEmpresa = true;
                $showAmigos = true;
                break;
            case 'credicorp':
                $tituloEmpresa = 'Ranking Total';
                $tituloPais = 'Ranking ' . ucfirst($usuario->usuario_pais->titulo);
                $tituloArea = 'Ranking';
                $tituloMisAmigos = 'Ranking Amigos';
                $showPais = true;
                $showArea = false;
                $showTodos = true;
                $showEmpresa = false;
                $showAmigos = true;
                break;
            case 'contract':
                $tituloEmpresa = 'Ranking Total';
                $tituloPais = 'Ranking ' . ucfirst($usuario->usuario_pais->titulo);
                $tituloArea = 'Ranking ' . ucfirst($usuario->area->nombre);
                $tituloMisAmigos = 'Ranking Amigos';
                $showPais = true;
                $showArea = true;
                $showEmpresa = false;
                $showTodos = true;
                $showAmigos = true;
                break;
            case 'tironi':
                $tituloEmpresa = 'Ranking Empresa';
                $tituloPais = '';
                $tituloArea = 'Ranking ' . $usuario->area->nombre;
                $tituloMisAmigos = 'Mis Amigos';
                $showPais = false;
                $showArea = false;
                $showTodos = false;
                $showEmpresa = true;
                $showAmigos = false;
                break;
            case 'aesgener':
                $tituloEmpresa = 'Ranking Empresa ' . $usuario->empresa->nombre;
                $tituloPais = '';
                $tituloArea = 'Ranking ' . $usuario->area->nombre;
                $tituloMisAmigos = 'Mis Amigos';
                $showPais = false;
                $showArea = true;
                $showTodos = false;
                $showEmpresa = true;
                $showAmigos = true;
                break;
            case 'anden':
                $tituloEmpresa = 'Ranking Empresa';
                $tituloPais = 'Ranking País';
                $tituloArea = 'Ranking Gerencia ' . $usuario->area->nombre;
                $tituloMisAmigos = 'Ranking Mis Amigos';
                $showPais = false;
                $showArea = true;
                $showTodos = false;
                $showEmpresa = true;
                $showAmigos = true;
                break;
            case 'dcv':
                $tituloEmpresa = 'Ranking Empresa';
                $tituloPais = 'Ranking País';
                $tituloArea = 'Ranking Gerencia ' . $usuario->area->nombre;
                $tituloMisAmigos = 'Ranking Mis Amigos';
                $showPais = false;
                $showArea = false;
                $showTodos = false;
                $showGrupos = true;
                $showEmpresa = false;
                $showAmigos = false;
                break;
            default:
                $tituloEmpresa = 'Ranking Empresa';
                $tituloPais = 'Ranking País';
                $tituloArea = 'Ranking ' . $usuario->area->nombre;
                $tituloMisAmigos = 'Ranking Mis Amigos';
                $showPais = false;
                $showArea = true;
                $showTodos = false;
                $showEmpresa = true;
                $showAmigos = true;
                break;
        }

        $this->render('index', array(
            'liArea' => $liArea,
            'usuario_id_grupo' => $usuario_id_grupo,
            'listUsuarioGrupos' => $listUsuarioGrupos,
            'listUsuarioRankingGrupos' => $listUsuarioRankingGrupos,
            'listUsuarioTodos' => $listUsuarioTodos,
            'listUsuarioRankingTodos' => $listUsuarioRankingTodos,
            'listUsuario' => $listUsuario,
            'listUsuarioRanking' => $listUsuarioRanking,
            'listUsuarioArea' => $listUsuarioArea,
            'listUsuarioRankingArea' => $listUsuarioRankingArea,
            'listUsuarioAmigos' => $listUsuarioAmigos,
            'listUsuarioRankingAmigos' => $listUsuarioRankingAmigos,
            'listUsuarioPais' => $listUsuarioPais,
            'listUsuarioRankingPais' => $listUsuarioRankingPais,
            'listArea' => $listArea,
            'tituloEmpresa' => $tituloEmpresa,
            'tituloPais' => $tituloPais,
            'tituloArea' => $tituloArea,
            'tituloMisAmigos' => $tituloMisAmigos,
            'showPais' => $showPais,
            'showArea' => $showArea,
            'showTodos' => $showTodos,
            'showEmpresa' => $showEmpresa,
            'showAmigos' => $showAmigos,
            'showGrupos' => $showGrupos
        ));
    }
    
    public function actionTop100(){
        //$this->normalTop100();
        $this->jsonTop100();
    }
    
    private function jsonTop100(){
        $this->render('top100_json');
    }
    
    public function actionTop100cuartosyoctavos(){        
        $this->render('top100cuartosyoctavos_json');
    }
    
    private function normalTop100(){
        if (Yii::app()->session['project'] == 'dcv') {
            //todos empresas
            $criteria = new CDbCriteria();
            $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
            $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
            $criteria->compare('empresa_id', '2');
            $criteria->limit = 100;
        }else{
            //todos empresas
            $criteria = new CDbCriteria();
            $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
            $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
            $criteria->limit = 100;
        }
        
        $listUsuarioTodos = Usuario::model()->findAll($criteria);
        
        $this->render('top100',array(
            'listUsuarioTodos'=>$listUsuarioTodos
        ));
    }

    /* @var $usuario Usuario */

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
                            ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                        ) a
                        WHERE usuario_id = ' . Yii::app()->user->id;
                break;

//            case 'empresa':
//                $sql = 'SELECT a.rank
//                        FROM (
//                            SELECT @rownum := @rownum + 1 AS rank, usuario_id
//                            FROM usuario, (SELECT @rownum := 0) t
//                            WHERE empresa_id = ' . $usuario->empresa_id . '
//                            ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
//                        ) a
//                        WHERE usuario_id = ' . Yii::app()->user->id;
//                break;
            case 'empresa':
                $sql = 'SELECT a.rank
                        FROM (
                            SELECT @rownum := @rownum + 1 AS rank, usuario_id
                            FROM usuario, (SELECT @rownum := 0) t                            
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
                        ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                    ) a
                    WHERE rank BETWEEN ' . $betweenBottom . ' AND ' . $betweenTop;

                break;
            case 'empresa':
                $sql = 'SELECT a.usuario_id, a.nombre,apellido_paterno,a.apellido_materno, a.imagen, a.total_puntos,a.total_plenos,a.rank 
                    FROM (
                        SELECT @rownum := @rownum + 1 AS rank, usuario_id,nombre,apellido_paterno,apellido_materno, imagen, total_puntos,total_plenos
                        FROM usuario, (SELECT @rownum := 0) t                        
                        ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                    ) a
                    WHERE rank BETWEEN ' . $betweenBottom . ' AND ' . $betweenTop;

                break;
//            case 'empresa':
//                $sql = 'SELECT a.usuario_id, a.nombre,apellido_paterno,a.apellido_materno, a.imagen, a.total_puntos,a.total_plenos,a.rank 
//                    FROM (
//                        SELECT @rownum := @rownum + 1 AS rank, usuario_id,nombre,apellido_paterno,apellido_materno, imagen, total_puntos,total_plenos
//                        FROM usuario, (SELECT @rownum := 0) t
//                        WHERE empresa_id = ' . $usuario->empresa_id . '
//                        ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
//                    ) a
//                    WHERE rank BETWEEN ' . $betweenBottom . ' AND ' . $betweenTop;
//
//                break;
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

}
