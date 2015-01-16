<?php

class UsuarioController extends Controller {

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
            array('allow',
                'actions' => array('ajaxCheckLogin'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('view', 'update', 'ajaxPuntos', 'ajaxAddFriend', 'ajaxDeleteFriend', 'addFriend'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAjaxCheckLogin($userName = null) {

        $response = array(
            'status' => 'invalid_user',
            'load_landing' => 'ok'
        );

        if ($userName != null) {
            $ary = CJSON::decode(file_get_contents(Yii::app()->params['baseUrlJson'].'/json/'.Yii::app()->session['project'].'/checkL.js'));
            $userNameEnc = Yii::app()->aesManager->encrypt($userName);
                        
            foreach($ary as $user=>$aryUser){
                
                if($aryUser['u'] == $userNameEnc){
                    $response['status'] = 'valid_user';
                    
                    if ($aryUser['l'] == '0000-00-00 00:00:00') {
                        $response['load_landing'] = 'ok';
                    }else{
                        $response['load_landing'] = 'no';
                    }
                    
                    break;
                }
            }
            
//            $userNameEnc = Yii::app()->aesManager->encrypt($userName);
//            Yii::app()->useDatabase->now();
//            $criteria = new CDbCriteria();
//            $criteria->compare('user', $userNameEnc);
//            $criteria->compare('tipo_estado_usuario_id', '1');
//            $usuario = Usuario::model()->find($criteria);
//
//            if ($usuario != null) {
//                $response['status'] = 'valid_user';
//
//                if ($usuario->last_login_time == '0000-00-00 00:00:00') {
//                    $response['load_landing'] = 'ok';
//                } else {
//                    $response['load_landing'] = 'no';
//                }
//            }
        }

        header('Content-type: text/json');
        header('Content-type: application/json');
        echo CJSON::encode($response);
    }

    /* @var $usuario Usuario */

    public function actionAjaxAddFriend($id) {
        Yii::app()->useDatabase->now();
        
        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
        if ($usuario->amigos_usuario_id != '') {
            $aryAmigosId = explode(',', $usuario->amigos_usuario_id);
        }

        $aryAmigosId[] = $id;
        $usuario->setAttribute('amigos_usuario_id', implode(',', array_unique($aryAmigosId)));
        $usuario->update();

        $usuario = Usuario::model()->findByPk($id);
        echo Yii::app()->aesManager->decrypt($usuario->nombre) . ' ' . Yii::app()->aesManager->decrypt($usuario->apellido_paterno) . ' fue agregado a tu ranking.\nVeras su puntaje despues del próximo partido.';
    }

    public function actionAddFriend($id) {
        Yii::app()->useDatabase->now();
        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
        if ($usuario->amigos_usuario_id != '') {
            $aryAmigosId = explode(',', $usuario->amigos_usuario_id);
        }

        $aryAmigosId[] = $id;
        $usuario->setAttribute('amigos_usuario_id', implode(',', array_unique($aryAmigosId)));
        $usuario->update();

        $usuario = Usuario::model()->findByPk($id);
        $this->redirect(array('/ranking'));
    }

    public function actionAjaxDeleteFriend($id) {
        Yii::app()->useDatabase->now();
        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
        $aryAmigosId = explode(',', $usuario->amigos_usuario_id);

        foreach ($aryAmigosId as $key => $value) {
            if ($value == $id) {
                unset($aryAmigosId[$key]);
            }
        }

        $usuario->setAttribute('amigos_usuario_id', implode(',', array_unique($aryAmigosId)));
        $usuario->update();

        $usuario = Usuario::model()->findByPk($id);
        echo $usuario->nombre . ' ' . $usuario->apellido_paterno . ' fue eliminado a tu ranking.\nSu eliminación se verá reflejada despues del próximo partido.';
    }

    /**
     * 
     * @var Usuario $usuario
     */
    public function actionAjaxPuntos($puntos, $puntosPlenos) {
//        if (!Yii::app()->user->isGuest) {
//            
//            $canUpdate = true;
//            if (Yii::app()->session['project'] == 'dcv') {
//                $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
//                $area_id = $usuario->area_id;
//                $criteria = new CDbCriteria();
//                $criteria->addInCondition('empresa_id', array('2'));
//                $criteria->addInCondition('area_id', array($area_id));
//                $usuario = Usuario::model()->find($criteria);
//                $usuario_id = $usuario->usuario_id;
//                
//                if (Yii::app()->user->id != $usuario_id) {
//                    $canUpdate = false;
//                }
//            } else {
//                $usuario_id = Yii::app()->user->id;
//            }
//            
//            if($canUpdate){
//                
//                $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
//                $usuario->setAttribute('total_puntos', $puntos);
//                $usuario->setAttribute('total_plenos', $puntosPlenos);
//                $usuario->update();               
//            }            
//        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->json($id);
        //$this->normal($id);
    }
    
    private function json($id){
        Yii::app()->useDatabase->now();
        $model = $this->loadModel($id);
        $model->user = Yii::app()->aesManager->decrypt($model->user);

        if (Yii::app()->user->getId() == $model->usuario_id) {
            $showEdit = true;
        } else {
            $showEdit = false;
        }

        if (Yii::app()->user->getId() == $model->usuario_id) {
            $showAddFriend = false;
        } else {

            $usuarioVisita = Usuario::model()->findByPk(Yii::app()->user->getId());
            $aryFriends = explode(',', $usuarioVisita->amigos_usuario_id);

            if (in_array($id, $aryFriends)) {
                $showAddFriend = false;
            } else {
                $showAddFriend = true;
            }
        }
        
        $this->render('view_json', array(
            'model' => $model,
            'showEdit' => $showEdit,
            'showAddFriend' => $showAddFriend
        ));
    }
    
    private function normal($id){
        $usuario = Usuario::model()->findByPk($id);

        $model = $this->loadModel($id);
        $model->user = Yii::app()->aesManager->decrypt($model->user);

        if (Yii::app()->user->getId() == $model->usuario_id) {
            $showEdit = true;
        } else {
            $showEdit = false;
        }

        if (Yii::app()->user->getId() == $model->usuario_id) {
            $showAddFriend = false;
        } else {

            $usuarioVisita = Usuario::model()->findByPk(Yii::app()->user->getId());
            $aryFriends = explode(',', $usuarioVisita->amigos_usuario_id);

            if (in_array($id, $aryFriends)) {
                $showAddFriend = false;
            } else {
                $showAddFriend = true;
            }
        }
        
        
        if(Yii::app()->session['project'] == 'dcv'){
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
        
        
        $numero = 0;
        $criteria = new CDbCriteria();
        $criteria->order = 'nombre DESC';
        $listArea = Area::model()->findAll($criteria);
                
        //todos empresas
        $criteria = new CDbCriteria();
        $criteria->select = 'usuario_id, nombre,apellido_paterno,apellido_materno, imagen, total_puntos';
        $criteria->order = 'total_puntos DESC, total_plenos DESC, usuario_id DESC';
        $criteria->limit = 3;

        $listUsuarioTodos = Usuario::model()->findAll($criteria);
        $listUsuarioRankingTodos = $this->getRanking('todos', $usuario);
        
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
                $showTodos = false;
                $showEmpresa = true;
                break;
            case 'credicorp':
                $tituloEmpresa = 'Ranking Total';
                $tituloPais = 'Ranking '.  ucfirst($usuario->usuario_pais->titulo);
                $tituloArea = 'Ranking';
                $tituloMisAmigos = 'Ranking Amigos';
                $showPais = true;
                $showArea = false;
                $showTodos = true;
                $showEmpresa = false;
                break;
            case 'contract':
                $tituloEmpresa = 'Ranking Total';
                $tituloPais = 'Ranking '.  ucfirst($usuario->usuario_pais->titulo);
                $tituloArea = 'Ranking '.  ucfirst($usuario->area->nombre);
                $tituloMisAmigos = 'Ranking Amigos';
                $showPais = true;
                $showArea = true;
                $showEmpresa = false;
                $showTodos = true;
                break;
               case 'tironi':
                $tituloEmpresa = 'Ranking Empresa';
                $tituloPais = 'Ranking '.  ucfirst($usuario->usuario_pais->titulo);
                $tituloArea = 'Ranking';
                $tituloMisAmigos = 'Ranking Amigos';
                $showPais = false;
                $showArea = false;
                $showTodos = false;
                $showEmpresa = true;
                break;
            case 'anden':
                $tituloEmpresa = 'Ranking Empresa';
                $tituloPais = 'Ranking País';
                $tituloArea = 'Ranking Gerencia ' . $usuario->area->nombre;
                $tituloMisAmigos = 'Ranking Mis Amigos';
                $showPais = false;
                $showArea = false;
                $showTodos = false;
                $showEmpresa = true;
                break;
              case 'aesgener':
                $tituloEmpresa = 'Ranking Empresa';
                $tituloPais = '';
                $tituloArea = 'Ranking ' . $usuario->area->nombre;
                $tituloMisAmigos = 'Mis Amigos';
                $showPais = false;
                $showArea = true;
                $showTodos = false;
                $showEmpresa = true;
                break;
            case 'tmfgroup':
                $tituloEmpresa = 'Ranking TMF Group Chile';
                $tituloPais = '';
                $tituloArea = 'Ranking ' . $usuario->area->nombre;
                $tituloMisAmigos = 'Mis Amigos';
                $showPais = false;
                $showArea = true;
                $showTodos = false;
                $showEmpresa = true;
                break;
            case 'dcv':
                $tituloEmpresa = 'Ranking Empresa';
                $tituloPais = '';
                $tituloArea = 'Ranking ' . $usuario->area->nombre;
                $tituloMisAmigos = 'Mis Amigos';
                $showPais = false;
                $showArea = false;
                $showTodos = false;
                $showEmpresa = false;
                $showGrupos = true;
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
                break;
        }

        $this->render('view', array(
            'model' => $model,
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
            'showEdit' => $showEdit,
            'showAddFriend' => $showAddFriend,
            'tituloEmpresa'=>$tituloEmpresa,
            'tituloPais'=>$tituloPais,
            'tituloArea'=>$tituloArea,
            'tituloMisAmigos'=>$tituloMisAmigos,
            'showPais'=>$showPais,
            'showArea'=>$showArea,
            'showTodos' => $showTodos,
            'showEmpresa' => $showEmpresa,
            'showGrupos'=>$showGrupos
        ));
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

//    public function getRanking($tipo, $usuario, $id) {
//        switch ($tipo) {
//            case 'empresa':
//                $sql = 'SELECT a.rank
//                        FROM (
//                            SELECT @rownum := @rownum + 1 AS rank, usuario_id
//                            FROM usuario, (SELECT @rownum := 0) t
//                            WHERE empresa_id = ' . $usuario->empresa_id . '
//                            ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
//                        ) a
//                        WHERE usuario_id = ' . $id;
//                break;
//            case 'area':
//
//                $sql = 'SELECT a.rank
//                        FROM (
//                            SELECT @rownum := @rownum + 1 AS rank, usuario_id
//                            FROM usuario, (SELECT @rownum := 0) t
//                            WHERE area_id = ' . $usuario->area_id . '
//                            ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
//                        ) a
//                        WHERE usuario_id = ' . $id;
//                break;
//
//            default:
//                break;
//        }
//
//        $userRanking = Yii::app()->db->createCommand($sql)->queryRow();
//
//        $numero = $userRanking['rank'];
//
//        //search user and neighbors
//        if ($numero < 10) {
//
//            $betweenBottom = 4;
//            $betweenTop = 14;
//        } else {
//
//            if ($numero % 10 != 0) {
//                $countBottom = 0;
//                $findBottom = true;
//                $bottom = $numero;
//                while ($findBottom) {
//
//                    if ($bottom % 10 == 0) {
//                        $findBottom = false;
//                    } else {
//                        $countBottom++;
//                        $bottom--;
//                    }
//                }
//
//                $countTop = 0;
//                $findTop = true;
//                $top = $numero;
//                while ($findTop) {
//
//                    if ($top % 10 == 0) {
//                        $findTop = false;
//                    } else {
//                        $countTop++;
//                        $top++;
//                    }
//                }
//
//                $betweenBottom = ($numero - $countBottom);
//                $betweenTop = ($numero + $countTop);
//            } else {
//
//                $betweenBottom = $numero;
//                $betweenTop = $numero + 10;
//            }
//        }
//
//        switch ($tipo) {
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
//            case 'area':
//                $sql = 'SELECT a.usuario_id, a.nombre,apellido_paterno,a.apellido_materno, a.imagen, a.total_puntos,a.total_plenos,a.rank 
//                    FROM (
//                        SELECT @rownum := @rownum + 1 AS rank, usuario_id,nombre,apellido_paterno,apellido_materno, imagen, total_puntos,total_plenos
//                        FROM usuario, (SELECT @rownum := 0) t
//                        WHERE area_id = ' . $usuario->area_id . '
//                        ORDER BY total_puntos DESC, total_plenos DESC, usuario_id DESC
//                    ) a
//                    WHERE rank BETWEEN ' . $betweenBottom . ' AND ' . $betweenTop;
//
//                break;
//            default:
//                break;
//        }
//
//        return Usuario::model()->findAllBySql($sql);
//    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        Yii::app()->useDatabase->now();
        $SessionLog = Yii::app()->user->getId();
        if ($SessionLog == $id) {
            $model = $this->loadModel($id);

            if (isset($_POST['Usuario'])) {

                if (trim($_POST['Usuario']['pass']) == '') {
                    $pass = $model->pass;
                } else {
                    $pass = Yii::app()->aesManager->encrypt($_POST['Usuario']['pass']);
                }

                $model->attributes = $_POST['Usuario'];
                $model->pass = $pass;
                $model->imagen = $_POST['Usuario']['imagen'];

                if ($model->save()){                                       
                    $this->redirect(array('view', 'id' => $model->usuario_id));
                }
                    
            }
        } else {
            $model = $this->loadModel($SessionLog);
            $this->redirect(array('update', 'id' => $SessionLog));
        }

        $model->user = Yii::app()->aesManager->decrypt($model->user);
        $model->pass = '';

        if (Yii::app()->session['project'] == 'bbva') {
            $canEditNickname = false;
        } else {
            $canEditNickname = true;
        }

        $this->render('update', array(
            'model' => $model,
            'canEditNickname' => $canEditNickname
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
