<?php

class HomeController extends Controller {

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
                'actions' => array('index'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /* @var $versus Versus */

    public function actionIndex() {
        if (Yii::app()->mobileDetected->ismobile()) {
            $this->redirect(array('/mobile'));
        } else {
            //$this->homePC(); //DEJAR VALIDACION TWITTER
            $this->homePCJson();
        }
    }

    private function homePCJson() {        
        $this->render('index_json');
    }

    private function homePC() {

        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);

        $showTwitter = true;
        $showGrupos = false;
        //project settings
        switch (Yii::app()->session['project']) {
            case 'bbva':
                $tituloEmpresa = 'Grupo BBVA';
                $tituloPais = 'División';
                $tituloArea = 'Area';
                $tituloMisAmigos = 'Mis Amigos';
                $showPais = false;
                $showArea = true;
                $showTodos = false;
                $showEmpresa = true;
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
                break;
            case 'cristal':
                $tituloEmpresa = 'Ranking Total CCU';
                $tituloPais = 'Ranking País';
                $tituloArea = 'Ranking UEN CCU';
                $tituloMisAmigos = 'Ranking Mis Amigos';
                $showPais = false;
                $showArea = true;
                $showTwitter = false;
                $showTodos = false;
                $showEmpresa = true;
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
                break;
            case 'contract':
                $tituloEmpresa = 'Ranking Total';
                $tituloPais = 'Ranking ' . ucfirst($usuario->usuario_pais->titulo);
                $tituloArea = 'Ranking ' . ucfirst($usuario->area->nombre);
                $tituloMisAmigos = 'Ranking Amigos';
                $showPais = true;
                $showArea = false;
                $showTodos = true;
                $showEmpresa = false;
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
                break;
            case 'dcv':
                $tituloEmpresa = 'Ranking Empresa';
                $tituloPais = 'Ranking País';
                $tituloArea = 'Ranking Gerencia ' . $usuario->area->nombre;
                $tituloMisAmigos = 'Ranking Mis Amigos';
                $showPais = false;
                $showArea = false;
                $showTodos = false;
                $showEmpresa = false;
                $showGrupos = true;
                break;
            case 'euroamerica':
                $tituloEmpresa = 'Ranking Empresa';
                $tituloPais = 'Ranking País';
                $tituloArea = 'Ranking Area';
                $tituloMisAmigos = 'Ranking Mis Amigos';
                $showPais = false;
                $showArea = true;
                $showTodos = false;
                $showEmpresa = true;
                $showTwitter = false;
                break;
            default:
                $tituloEmpresa = 'Ranking Empresa';
                $tituloPais = 'Ranking País';
                $tituloArea = 'Ranking Area';
                $tituloMisAmigos = 'Ranking Mis Amigos';
                $showPais = false;
                $showArea = true;
                $showTodos = false;
                $showEmpresa = true;
                break;
        }

        $aryRanking = array();

        if (Yii::app()->session['project'] == 'dcv') {
            $area_id = $usuario->area_id;
            $criteria = new CDbCriteria();
            $criteria->addInCondition('empresa_id', array('2'));
            $criteria->addInCondition('area_id', array($area_id));
            $usuario = Usuario::model()->find($criteria);

            //grupos empresas
            $criteria = new CDbCriteria();
            $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
            $criteria->addInCondition('empresa_id', array('2'));
            $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
            $criteria->limit = 3;

            $usuario_id_grupo = $usuario->usuario_id;
            $listUsuarioGrupos = Usuario::model()->findAll($criteria);
            $listUsuarioRankingGrupos = $this->getRanking('grupos', $usuario);
            $usuarioRankingGrupos = $this->getRankingUser('grupos', $usuario);
        }

        //todos empresas
        if ($showTodos) {
            $listUsuarioTodos = $this->getListUsuarioTodos();
            $listUsuarioRankingTodos = $this->getListUsuarioRankingTodos($usuario);
            $usuarioRankingTodos = $this->getRankingUser('todos', $usuario);
        }

        //empresa
        if ($showEmpresa) {
            $listUsuario = $this->getListUsuario();
            $listUsuarioRanking = $this->getListUsuarioRanking($usuario);
            $usuarioRankingEmpresa = $this->getRankingUser('empresa', $usuario);
        }

        //pais
        if ($showPais) {
            $listUsuarioPais = $this->getListUsuarioPais($usuario);
            $listUsuarioRankingPais = $this->getListUsuarioRankingPais($usuario);
            $usuarioRankingPais = $this->getRankingUser('pais', $usuario);
        }

        //area
        if ($showArea) {
            $listUsuarioArea = $this->getListUsuarioArea($usuario);
            $listUsuarioRankingArea = $this->getListUsuarioRankingArea($usuario);
            $usuarioRankingArea = $this->getRankingUser('area', $usuario);
        }

//        $criteria = new CDbCriteria();
//        $criteria->order = 'fecha ASC';
//        $listVersus = Versus::model()->findAll($criteria);
//        
        $this->render('index', array(
//            'listVersus'=>$listVersus,
            'usuarioRankingEmpresa' => $usuarioRankingEmpresa,
            'usuarioRankingTodos' => $usuarioRankingTodos,
            'usuarioRankingGrupos' => $usuarioRankingGrupos,
            'usuarioRankingArea' => $usuarioRankingArea,
            'usuarioRankingPais' => $usuarioRankingPais,
            'usuarioLocal' => $usuario,
            'usuario_id_grupo' => $usuario_id_grupo,
            'listUsuarioGrupos' => $listUsuarioGrupos,
            'listUsuarioRankingGrupos' => $listUsuarioRankingGrupos,
            'listUsuarioTodos' => $listUsuarioTodos,
            'listUsuarioRankingTodos' => $listUsuarioRankingTodos,
            'listUsuario' => $listUsuario,
            'listUsuarioRanking' => $listUsuarioRanking,
            'listUsuarioArea' => $listUsuarioArea,
            'listUsuarioRankingArea' => $listUsuarioRankingArea,
            'listUsuarioPais' => $listUsuarioPais,
            'listUsuarioRankingPais' => $listUsuarioRankingPais,
            'tituloEmpresa' => $tituloEmpresa,
            'tituloPais' => $tituloPais,
            'tituloArea' => $tituloArea,
            'tituloMisAmigos' => $tituloMisAmigos,
            'showPais' => $showPais,
            'showArea' => $showArea,
            'showEmpresa' => $showEmpresa,
            'showTodos' => $showTodos,
            'showTwitter' => $showTwitter,
            'showGrupos' => $showGrupos
        ));
    }

    private function getListUsuarioRankingArea($usuario) {
        $memcache = new Memcache;
        $memcache->addserver('localhost');
        $cacheKey = Yii::app()->session['project'];
        $key = $cacheKey . '.home.listUsuarioRankingArea.' . Yii::app()->user->id;

        $listUsuarioRankingArea = $memcache->get($key);
        if ($listUsuarioRankingArea === false) {
            $listUsuarioRankingArea = $this->getRanking('area', $usuario);
            $memcache->set($key, $listUsuarioRankingArea, false, 300);
        }

        return $listUsuarioRankingArea;
    }

    private function getListUsuarioArea($usuario) {
        $memcache = new Memcache;
        $memcache->addserver('localhost');
        $cacheKey = Yii::app()->session['project'];
        $key = $cacheKey . '.home.listUsuarioArea.' . $usuario->area_id;

        $listUsuarioArea = $memcache->get($key);
        if ($listUsuarioArea === false) {
            $criteria = new CDbCriteria();
            $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
            $criteria->compare('area_id', $usuario->area_id);
            $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
            $criteria->limit = 3;

            $listUsuarioArea = Usuario::model()->findAll($criteria);
            $memcache->set($key, $listUsuarioArea, false, 300);
        }

        return $listUsuarioArea;
    }

    private function getListUsuarioRankingPais($usuario) {
        $memcache = new Memcache;
        $memcache->addserver('localhost');
        $cacheKey = Yii::app()->session['project'];
        $key = $cacheKey . '.home.listUsuarioRankingPais.' . Yii::app()->user->id;

        $listUsuarioRankingPais = $memcache->get($key);
        if ($listUsuarioRankingPais === false) {
            $listUsuarioRankingPais = $this->getRanking('pais', $usuario);
            $memcache->set($key, $listUsuarioRankingPais, false, 300);
        }

        return $listUsuarioRankingPais;
    }

    private function getListUsuarioPais($usuario) {
        $memcache = new Memcache;
        $memcache->addserver('localhost');
        $cacheKey = Yii::app()->session['project'];
        $key = $cacheKey . '.home.listUsuarioPais.' . $usuario->usuario_pais_id;

        $listUsuarioPais = $memcache->get($key);
        if ($listUsuarioPais === false) {
            $criteria = new CDbCriteria();
            $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
            $criteria->compare('usuario_pais_id', $usuario->usuario_pais_id);
            $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
            $criteria->limit = 3;

            $listUsuarioPais = Usuario::model()->findAll($criteria);
            $memcache->set($key, $listUsuarioPais, false, 300);
        }

        return $listUsuarioPais;
    }

    private function getListUsuarioRanking($usuario) {
        $memcache = new Memcache;
        $memcache->addserver('localhost');
        $cacheKey = Yii::app()->session['project'];
        $key = $cacheKey . '.home.listUsuarioRanking.' . Yii::app()->user->id;

        $listUsuarioRanking = $memcache->get($key);
        if ($listUsuarioRanking === false) {
            $listUsuarioRanking = $this->getRanking('empresa', $usuario);
            $memcache->set($key, $listUsuarioRanking, false, 300);
        }

        return $listUsuarioRanking;
    }

    private function getListUsuario() {
        $memcache = new Memcache;
        $memcache->addserver('localhost');
        $cacheKey = Yii::app()->session['project'];
        $key = $cacheKey . '.home.listUsuario';

        $listUsuario = $memcache->get($key);
        if ($listUsuario === false) {
            $criteria = new CDbCriteria();
            $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
            $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
            $criteria->limit = 3;

            $listUsuario = Usuario::model()->findAll($criteria);
            $memcache->set($key, $listUsuario, false, 300);
        }

        return $listUsuario;
    }

    private function getListUsuarioRankingTodos($usuario) {
        $memcache = new Memcache;
        $memcache->addserver('localhost');
        $cacheKey = Yii::app()->session['project'];
        $key = $cacheKey . '.home.listUsuarioRankingTodos.' . Yii::app()->user->id;

        $listUsuarioRankingTodos = $memcache->get($key);
        if ($listUsuarioRankingTodos === false) {
            $listUsuarioRankingTodos = $this->getRanking('todos', $usuario);
            $memcache->set($key, $listUsuarioRankingTodos, false, 300);
        }

        return $listUsuarioRankingTodos;
    }

    private function getListUsuarioTodos() {
        $memcache = new Memcache;
        $memcache->addserver('localhost');
        $cacheKey = Yii::app()->session['project'];
        $key = $cacheKey . '.home.listUsuarioTodos';

        $listUsuarioTodos = $memcache->get($key);
        if ($listUsuarioTodos === false) {
            $criteria = new CDbCriteria();
            $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
            $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
            $criteria->limit = 3;

            $listUsuarioTodos = Usuario::model()->findAll($criteria);
            $memcache->set($key, $listUsuarioTodos, false, 300);
        }

        return $listUsuarioTodos;
    }

//    private function homePC() {
//
//        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
//
//        if(Yii::app()->session['project'] == 'dcv'){
//            $area_id = $usuario->area_id;
//            $criteria = new CDbCriteria();
//            $criteria->addInCondition('empresa_id', array('2'));
//            $criteria->addInCondition('area_id', array($area_id));
//            $usuario = Usuario::model()->find($criteria);
//                        
//            $criteria = new CDbCriteria();
//            $criteria->order = 'nombre DESC';
//            $liArea = Area::model()->findAll($criteria);
//
//            //grupos empresas
//            $criteria = new CDbCriteria();
//            $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
//            $criteria->addInCondition('empresa_id', array('2'));
//            $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
//            $criteria->limit = 3;
//
//            $usuario_id_grupo = $usuario->usuario_id;
//            $listUsuarioGrupos = Usuario::model()->findAll($criteria);
//            $listUsuarioRankingGrupos = $this->getRanking('grupos', $usuario);                        
//        }
//
//        //todos empresas
//        $criteria = new CDbCriteria();
//        $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
//        $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
//        $criteria->limit = 3;
//
//        $listUsuarioTodos = Usuario::model()->findAll($criteria);
//        $listUsuarioRankingTodos = $this->getRanking('todos', $usuario);
//
//        //empresa
//        $criteria = new CDbCriteria();
//        $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
//        $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';        
//        $criteria->limit = 3;
//
//        $listUsuario = Usuario::model()->findAll($criteria);
//        $listUsuarioRanking = $this->getRanking('empresa', $usuario);
//
//        //pais
//        $criteria = new CDbCriteria();
//        $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
//        $criteria->compare('usuario_pais_id', $usuario->usuario_pais_id);
//        $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
//        $criteria->limit = 3;
//
//        $listUsuarioPais = Usuario::model()->findAll($criteria);
//        $listUsuarioRankingPais = $this->getRanking('pais', $usuario);
//        //area
//        $criteria = new CDbCriteria();
//        $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
//        $criteria->compare('area_id', $usuario->area_id);
//        $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
//        $criteria->limit = 3;
//
//        $listUsuarioArea = Usuario::model()->findAll($criteria);
//        $listUsuarioRankingArea = $this->getRanking('area', $usuario);
//        $listUsuarioRankingTodos = $this->getRanking('todos', $usuario);
//
//        //$listVersus = Versus::model()->findAll();
//                
//        $showTwitter = true;
//        $showGrupos = false;
//        //project settings
//        switch (Yii::app()->session['project']) {
//            case 'bbva':
//                $tituloEmpresa = 'Grupo BBVA';
//                $tituloPais = 'División';
//                $tituloArea = 'Area';
//                $tituloMisAmigos = 'Mis Amigos';
//                $showPais = false;
//                $showArea = true;
//                $showTodos = false;
//                $showEmpresa = true;
//                break;
//            case 'santander':
//                $tituloEmpresa = 'Ranking Santander';
//                $tituloPais = '';
//                $tituloArea = 'Ranking ' . $usuario->area->nombre;
//                $tituloMisAmigos = 'Mis Amigos';
//                $showPais = false;
//                $showArea = true;
//                $showTodos = false;
//                $showEmpresa = true;
//                break;
//            case 'skchile':
//                $tituloEmpresa = 'Ranking Empresa';
//                $tituloPais = 'Ranking País';
//                $tituloArea = 'Ranking ' . $usuario->area->nombre;
//                $tituloMisAmigos = 'Ranking Mis Amigos';
//                $showPais = false;
//                $showArea = false;
//                $showTodos = false;
//                $showEmpresa = true;
//                break;
//            case 'cchc':
//                $tituloEmpresa = 'Ranking Empresa';
//                $tituloPais = 'Ranking País';
//                $tituloArea = 'Ranking ' . $usuario->area->nombre;
//                $tituloMisAmigos = 'Ranking Mis Amigos';
//                $showPais = false;
//                $showArea = false;
//                $showTodos = false;
//                $showEmpresa = true;
//                break;
//            case 'afphabitat':
//                $tituloEmpresa = 'Ranking Empresa';
//                $tituloPais = 'Ranking País';
//                $tituloArea = 'Ranking Gerencia ' . $usuario->area->nombre;
//                $tituloMisAmigos = 'Ranking Mis Amigos';
//                $showPais = false;
//                $showArea = true;
//                $showTodos = false;
//                $showEmpresa = true;
//                break;
//            case 'cristal':
//                $tituloEmpresa = 'Ranking Total CCU';
//                $tituloPais = 'Ranking País';
//                $tituloArea = 'Ranking UEN CCU';
//                $tituloMisAmigos = 'Ranking Mis Amigos';
//                $showPais = false;
//                $showArea = true;
//                $showTwitter = false;
//                $showTodos = false;
//                $showEmpresa = true;
//                break;
//            case 'credicorp':
//                $tituloEmpresa = 'Ranking Total';
//                $tituloPais = 'Ranking ' . ucfirst($usuario->usuario_pais->titulo);
//                $tituloArea = 'Ranking';
//                $tituloMisAmigos = 'Ranking Amigos';
//                $showPais = true;
//                $showArea = false;
//                $showTodos = true;
//                $showEmpresa = false;
//                break;
//            case 'contract':
//                $tituloEmpresa = 'Ranking Total';
//                $tituloPais = 'Ranking ' . ucfirst($usuario->usuario_pais->titulo);
//                $tituloArea = 'Ranking ' . ucfirst($usuario->area->nombre);
//                $tituloMisAmigos = 'Ranking Amigos';
//                $showPais = true;
//                $showArea = false;                
//                $showTodos = true;
//                $showEmpresa = false;
//                break;
//            case 'tironi':
//                $tituloEmpresa = 'Ranking Empresa';
//                $tituloPais = '';
//                $tituloArea = 'Ranking ' . $usuario->area->nombre;
//                $tituloMisAmigos = 'Mis Amigos';
//                $showPais = false;
//                $showArea = false;
//                $showTodos = false;
//                $showEmpresa = true;
//                break;
//            case 'aesgener':
//                $tituloEmpresa = 'Ranking Empresa ' . $usuario->empresa->nombre;
//                $tituloPais = '';
//                $tituloArea = 'Ranking ' . $usuario->area->nombre;
//                $tituloMisAmigos = 'Mis Amigos';
//                $showPais = false;
//                $showArea = true;
//                $showTodos = false;
//                $showEmpresa = true;
//                break;
//            case 'anden':
//                $tituloEmpresa = 'Ranking Empresa';
//                $tituloPais = 'Ranking País';
//                $tituloArea = 'Ranking Gerencia ' . $usuario->area->nombre;
//                $tituloMisAmigos = 'Ranking Mis Amigos';
//                $showPais = false;
//                $showArea = true;
//                $showTodos = false;
//                $showEmpresa = true;
//                break;
//            case 'dcv':
//                $tituloEmpresa = 'Ranking Empresa';
//                $tituloPais = 'Ranking País';
//                $tituloArea = 'Ranking Gerencia ' . $usuario->area->nombre;
//                $tituloMisAmigos = 'Ranking Mis Amigos';
//                $showPais = false;
//                $showArea = false;
//                $showTodos = false;
//                $showEmpresa = false;
//                $showGrupos = true;
//                break;
//            default:
//                $tituloEmpresa = 'Ranking Empresa';
//                $tituloPais = 'Ranking País';
//                $tituloArea = 'Ranking Area';
//                $tituloMisAmigos = 'Ranking Mis Amigos';
//                $showPais = false;
//                $showArea = true;
//                $showTodos = false;
//                $showEmpresa = true;
//                break;
//        }
//        
//        
//        $usuarioRankingEmpresa = $this->getRankingUser('empresa', $usuario);
//        $usuarioRankingTodos = $this->getRankingUser('todos', $usuario);
//        $usuarioRankingGrupos = $this->getRankingUser('grupos', $usuario);
//        $usuarioRankingArea = $this->getRankingUser('area', $usuario);
//        
//        $this->render('index', array(
//            'readyOnly' => $readyOnly,
//            'usuarioRankingEmpresa'=>$usuarioRankingEmpresa,
//            'usuarioRankingTodos'=>$usuarioRankingTodos,
//            'usuarioRankingGrupos'=>$usuarioRankingGrupos,
//            'usuarioRankingArea'=>$usuarioRankingArea,
//            //'listVersus' => $listVersus,
//            'usuarioLocal' => $usuario,
//            'usuario_id_grupo' => $usuario_id_grupo,
//            'listUsuarioGrupos' => $listUsuarioGrupos,
//            'listUsuarioRankingGrupos' => $listUsuarioRankingGrupos,
//            'listUsuarioTodos' => $listUsuarioTodos,
//            'listUsuarioRankingTodos' => $listUsuarioRankingTodos,
//            'listUsuario' => $listUsuario,
//            'listUsuarioRanking' => $listUsuarioRanking,
//            'listUsuarioArea' => $listUsuarioArea,
//            'listUsuarioRankingArea' => $listUsuarioRankingArea,
//            'listUsuarioPais' => $listUsuarioPais,
//            'listUsuarioRankingPais' => $listUsuarioRankingPais,
//            'tituloEmpresa' => $tituloEmpresa,
//            'tituloPais' => $tituloPais,
//            'tituloArea' => $tituloArea,
//            'tituloMisAmigos' => $tituloMisAmigos,
//            'showPais' => $showPais,
//            'showArea' => $showArea,
//            'showEmpresa' => $showEmpresa,
//            'showTodos' => $showTodos,
//            'showTwitter' => $showTwitter,
//            'showGrupos'=>$showGrupos
//        ));
//    }

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

    public function actionRanking() {

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
            case 'grupos':
                $sql = 'SELECT a.rank
                        FROM (
                            SELECT @rownum := @rownum + 1 AS rank, usuario_id
                            FROM usuario, (SELECT @rownum := 0) t
                            WHERE empresa_id = 2
                            ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
                        ) a
                        WHERE usuario_id = ' . Yii::app()->user->id;
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
                            WHERE area_id = ' . $usuario->area_id . '
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
            default:
                break;
        }

        $userRanking = Yii::app()->db->createCommand($sql)->queryRow();


        return $userRanking['rank'];
    }

}
