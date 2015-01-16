<?php
class AdminCacheController extends Controller {

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
                'actions' => array('index','ranking','ajaxRanking','noticias','ajaxNoticias','versus','usuario','versusno'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionUsuario(){
        
        $arrayBase = Yii::app()->params['dataBases'];
                
        foreach ($arrayBase as $project => $base) {
            $this->updateUsuario($project,$base['dbname']);
        }
    }
    
    private function updateUsuario($project,$base){
        $host = Yii::app()->params['dataBases'][$project]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);
        
        $options = [ 'gs' => [ 'Content-Type' => 'application/javascript', 'acl' => 'public-read', 'read_cache_expiry_seconds'=>300]];
        $ctx = stream_context_create($options);
        
        $ranking = 'checkL';
        
        $sql = 'SELECT user as u, last_login_time as l FROM usuario WHERE tipo_estado_usuario_id = 1;';        
                
        if($_SERVER['HTTP_HOST'] == '192.168.1.49'){
            //Local
            $basePath = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/'.$project.'/'.$ranking.'_tmp.js';
            $basePathFinal = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/'.$project.'/'.$ranking.'.js';
                        
        }else{
            //Google
            $basePath = Yii::app()->params['baseUrlGs'].'/json/'.$project.'/'.$ranking.'_tmp.js';            
            $basePathFinal = Yii::app()->params['baseUrlGs'].'/json/'.$project.'/'.$ranking.'.js';            
        }
        
        file_put_contents($basePath, CJSON::encode(Yii::app()->db->createCommand($sql)->queryAll()));

        rename($basePath, $basePathFinal, $ctx);
    }
    
    /* @var $versus Versus */
    public function actionVersus(){
        $this->layout = 'main_admin';
        
        $options = [ 'gs' => [ 'Content-Type' => 'application/javascript', 'acl' => 'public-read', 'read_cache_expiry_seconds'=>300]];
        $ctx = stream_context_create($options);
        
        $ranking = 'jsonVersus';
        
        $dbname = Yii::app()->params['dataBases'][Yii::app()->session['project']]['dbname'];
        $host = Yii::app()->params['dataBases'][Yii::app()->session['project']]['connectionString'] . $dbname;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);
        
        $criteria = new CDbCriteria();
        $criteria->order = 'fecha ASC';
        $listVersus = Versus::model()->findAll($criteria);
        
        $aryVersus = array();
        foreach($listVersus as $versus){
            
            if($versus->pais_a->pais_id != 0){
                $aryVersus[] = array(
                    'versus_id'=>$versus->versus_id,
                    'fecha'=>$versus->fecha,
                    'grupo_id'=>$versus->pais_a->grupo_id,
                    'grupo_nombre'=>$versus->pais_a->grupo->nombre,
                    'pais_a_nombre'=>$versus->pais_a->nombre,
                    'pais_a_id'=>$versus->pais_a->pais_id,
                    'pais_a_imagen_big'=>Yii::app()->params['baseUrl'].'/images/rayalab/'.$versus->pais_a->imagen_big,
                    'pais_a_imagen_small'=>Yii::app()->params['baseUrl'].'/images/rayalab/'.$versus->pais_a->imagen_small,
                    'goles_a'=>$versus->goles_a,
                    'pais_b_nombre'=>$versus->pais_b->nombre,
                    'pais_b_id'=>$versus->pais_b->pais_id,
                    'pais_b_imagen_big'=>Yii::app()->params['baseUrl'].'/images/rayalab/'.$versus->pais_b->imagen_big,
                    'pais_b_imagen_small'=>Yii::app()->params['baseUrl'].'/images/rayalab/'.$versus->pais_b->imagen_small,
                    'goles_b'=>$versus->goles_b,
                    'ganador'=>$versus->ganador,
                    'canplay'=>$versus->canplay,
                );
            }
        }
                
        if($_SERVER['HTTP_HOST'] == '192.168.1.49'){
            //Local
            $basePath = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/'.$ranking.'_tmp.js';
            $basePathFinal = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/'.$ranking.'.js';
                        
        }else{
            //Google
            $basePath = Yii::app()->params['baseUrlGs'].'/json/'.$ranking.'_tmp.js';            
            $basePathFinal = Yii::app()->params['baseUrlGs'].'/json/'.$ranking.'.js';            
        }
                
        file_put_contents($basePath, 'var '.$ranking.' = '.CJSON::encode($aryVersus).';');

        rename($basePath, $basePathFinal, $ctx);
        
        $this->redirect(array('ranking'));
    }
    
    /* @var $versus Versus */
    public function actionVersusno(){
        $this->layout = 'main_admin';
        
        $options = [ 'gs' => [ 'Content-Type' => 'application/javascript', 'acl' => 'public-read', 'read_cache_expiry_seconds'=>300]];
        $ctx = stream_context_create($options);
        
        $ranking = 'jsonVersus';
        
        $dbname = Yii::app()->params['dataBases'][Yii::app()->session['project']]['dbname'];
        $host = Yii::app()->params['dataBases'][Yii::app()->session['project']]['connectionString'] . $dbname;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);
        
        $criteria = new CDbCriteria();
        $criteria->order = 'fecha ASC';
        $listVersus = Versus::model()->findAll($criteria);
        
        $aryVersus = array();
        foreach($listVersus as $versus){
            
            if($versus->pais_a->pais_id != 0){
                $aryVersus[] = array(
                    'versus_id'=>$versus->versus_id,
                    'fecha'=>$versus->fecha,
                    'grupo_id'=>$versus->pais_a->grupo_id,
                    'grupo_nombre'=>$versus->pais_a->grupo->nombre,
                    'pais_a_nombre'=>$versus->pais_a->nombre,
                    'pais_a_id'=>$versus->pais_a->pais_id,
                    'pais_a_imagen_big'=>Yii::app()->params['baseUrl'].'/images/rayalab/'.$versus->pais_a->imagen_big,
                    'pais_a_imagen_small'=>Yii::app()->params['baseUrl'].'/images/rayalab/'.$versus->pais_a->imagen_small,
                    'goles_a'=>$versus->goles_a,
                    'pais_b_nombre'=>$versus->pais_b->nombre,
                    'pais_b_id'=>$versus->pais_b->pais_id,
                    'pais_b_imagen_big'=>Yii::app()->params['baseUrl'].'/images/rayalab/'.$versus->pais_b->imagen_big,
                    'pais_b_imagen_small'=>Yii::app()->params['baseUrl'].'/images/rayalab/'.$versus->pais_b->imagen_small,
                    'goles_b'=>$versus->goles_b,
                    'ganador'=>$versus->ganador,
                    'canplay'=>$versus->canplay,
                );
            }
        }
        
        if($_SERVER['HTTP_HOST'] == '192.168.1.49'){
            //Local
            $basePath = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/'.$ranking.'_tmp.js';
            $basePathFinal = 'C:/AppServ/www/yii/project/mundialero_v4_dev/json/'.$ranking.'.js';
                        
        }else{
            //Google
            $basePath = Yii::app()->params['baseUrlGs'].'/json/'.$ranking.'_tmp.js';            
            $basePathFinal = Yii::app()->params['baseUrlGs'].'/json/'.$ranking.'.js';            
        }
                
        file_put_contents($basePath, 'var '.$ranking.' = '.CJSON::encode($aryVersus).';');

        rename($basePath, $basePathFinal, $ctx);        
    }

    public function actionRanking(){
        $this->layout = 'main_admin';
        $this->render('ranking');
    }
    
    public function actionNoticias(){
        $this->render('noticias');
    }
    
    /* @var $usuario Usuario */
    public function actionIndex() {
        
        $options = [ 'gs' => [ 'Content-Type' => 'application/javascript', 'acl' => 'public-read', 'read_cache_expiry_seconds'=>300]];
        $ctx = stream_context_create($options);
        
        $arrayBase = Yii::app()->params['dataBases'];
        
        $ranking = 'jsonRankingTotal';
        
        foreach ($arrayBase as $project => $base) {
            //$this->updateJson($project,$base['dbname'],$ranking, $ctx);
        }
    }
    
    private function ajaxRankingOctavos($project=null,$base=null){
                
        $options = [ 'gs' => [ 'Content-Type' => 'application/javascript', 'acl' => 'public-read', 'read_cache_expiry_seconds'=>300]];
        $ctx = stream_context_create($options);
        
        $ranking = 'jsonRankingOctavos';
        
        $host = Yii::app()->params['dataBases'][$project]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);
        
        $sql = 'SELECT usuario_id
                FROM prediccion
                WHERE
                versus_id > 48
                GROUP BY usuario_id
                ORDER BY usuario_id ASC';
        
        $prediccionUsuarioId = '';
        foreach (Yii::app()->db->createCommand($sql)->queryAll() as $value) {
            $prediccionUsuarioId .= $value['usuario_id'].",";
        }
        $prediccionUsuarioId = rtrim($prediccionUsuarioId, ',');

        $sql = 'SELECT 
                    usuario_id as ui,nombre as nm,apellido_paterno as ap,total_puntos_octavos as tp,total_plenos_octavos as pl,
                    imagen as im,usuario_pais_id as pi,empresa_id as ei,area_id as ai,amigos_usuario_id as fi
                FROM usuario
                WHERE 
                    usuario_id IN ('.$prediccionUsuarioId.')
                ORDER BY 
                    tp DESC, pl DESC, ui DESC;';
        $aryUsuario = Yii::app()->db->createCommand($sql)->queryAll();
        
        for($i=0;$i<count($aryUsuario);$i++){
            $aryUsuario[$i]['nm'] = ucwords(Yii::app()->aesManager->decrypt($aryUsuario[$i]['nm']));
            $aryUsuario[$i]['ap'] = ucwords(Yii::app()->aesManager->decrypt($aryUsuario[$i]['ap']));
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
        
        file_put_contents($basePath, 'var '.$ranking.' = '.CJSON::encode($aryUsuario).';');

        rename($basePath, $basePathFinal, $ctx);
    }
    
    public function actionAjaxRanking($project=null,$base=null){
        
        if($project == 'cristal'){
            $this->ajaxRankingOctavos($project,$base);
        }
        
        $start = microtime(true);
        
        $options = [ 'gs' => [ 'Content-Type' => 'application/javascript', 'acl' => 'public-read', 'read_cache_expiry_seconds'=>300]];
        $ctx = stream_context_create($options);
        
        $ranking = 'jsonRankingTotal';
        
        $host = Yii::app()->params['dataBases'][$project]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);
        
        $sql = 'SELECT usuario_id
                FROM prediccion
                GROUP BY usuario_id
                ORDER BY usuario_id ASC';
        
        $prediccionUsuarioId = '';
        foreach (Yii::app()->db->createCommand($sql)->queryAll() as $value) {
            $prediccionUsuarioId .= $value['usuario_id'].",";
        }
        $prediccionUsuarioId = rtrim($prediccionUsuarioId, ',');

        $sql = 'SELECT 
                    usuario_id as ui,nombre as nm,apellido_paterno as ap,total_puntos as tp,total_plenos as pl,
                    imagen as im,usuario_pais_id as pi,empresa_id as ei,area_id as ai,amigos_usuario_id as fi
                FROM usuario
                WHERE 
                    usuario_id IN ('.$prediccionUsuarioId.')
                ORDER BY 
                    tp DESC, pl DESC, ui DESC;';
        $aryUsuario = Yii::app()->db->createCommand($sql)->queryAll();
        
        for($i=0;$i<count($aryUsuario);$i++){
            $aryUsuario[$i]['nm'] = ucwords(Yii::app()->aesManager->decrypt($aryUsuario[$i]['nm']));
            $aryUsuario[$i]['ap'] = ucwords(Yii::app()->aesManager->decrypt($aryUsuario[$i]['ap']));
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
        
        file_put_contents($basePath, 'var '.$ranking.' = '.CJSON::encode($aryUsuario).';');

        rename($basePath, $basePathFinal, $ctx);
        
        $status = 'Actualizado';
        
        $response = new stdClass();
        $response->status = $status;
        $response->time = round((microtime(true) - $start),2).'segs';
                
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo CJSON::encode($response);        
    }
    
    public function actionAjaxNoticias($project=null,$base=null){
        $start = microtime(true);
        
        $options = [ 'gs' => [ 'Content-Type' => 'application/javascript', 'acl' => 'public-read', 'read_cache_expiry_seconds'=>300]];
        $ctx = stream_context_create($options);
        
        $ranking = 'jsonNoticiasDestacados';
        
        $host = Yii::app()->params['dataBases'][$project]['connectionString'] . $base;
        $username = Yii::app()->params['dataBaseConfig']['user'];
        $psw = Yii::app()->params['dataBaseConfig']['pass'];
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = $host;
        Yii::app()->db->username = $username;
        Yii::app()->db->password = $psw;
        Yii::app()->db->setActive(true);
        
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
        
        $status = 'Actualizado';
        
        $response = new stdClass();
        $response->status = $status;
        $response->time = round((microtime(true) - $start),2).'segs';
                
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo CJSON::encode($response);        
    }
}